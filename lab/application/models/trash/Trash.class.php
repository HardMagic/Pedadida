<?php
class Trash {
	function purge_trash() {
		ini_set('memory_limit', '512M');
		Env::useHelper("permissions");
		$days = config_option("days_on_trash");
		$count = 0;
		if ($days > 0) {
			$date = DateTimeValueLib::now()->add("d", -$days);
			
			$sql = "SELECT o.id FROM ".TABLE_PREFIX."objects o LEFT JOIN ".TABLE_PREFIX."mail_contents mc ON mc.object_id=o.id WHERE
			trashed_by_id > 0 AND trashed_on < '".$date->toMySQL()."' AND NOT COALESCE(mc.is_deleted, false) LIMIT 1000";
			
			$objects = array_flat(DB::executeAll($sql));
			
			foreach ($objects as $object_id) {
				$concrete_object = Objects::findObject($object_id);
				if (!$concrete_object instanceof ContentDataObject) continue;
				if ($concrete_object instanceof MailContent && $concrete_object->getIsDeleted()) continue;
				try {
					DB::beginWork();
					if ($concrete_object instanceof MailContent) {
						$concrete_object->delete(false);
					} else {
						$concrete_object->delete();
					}
					ApplicationLogs::createLog($concrete_object, ApplicationLogs::ACTION_DELETE);
					
					DB::commit();
					$count++;
				} catch (Exception $e) {
					DB::rollback();
					Logger::log("Error delting object in purge_trash: " . $e->getMessage(), Logger::ERROR);
				}
			}
		}
		return $count;
	}
}
?>