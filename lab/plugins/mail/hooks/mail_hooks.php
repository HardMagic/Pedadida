<?php
Hook::register('mail');

function mail_allowed_subscribers($object, &$contacts) {
	if ($object instanceof MailContent) {
		$person_dim = Dimensions::findByCode('feng_persons');
		$person_dim_id = $person_dim instanceof Dimension ? $person_dim->getId() : "0";
		$sql = "SELECT member_id FROM ".TABLE_PREFIX."object_members om INNER JOIN ".TABLE_PREFIX."members m ON m.id=om.member_id
			WHERE om.object_id = ".$object->getId()." AND om.is_optimization=0 AND m.dimension_id NOT IN (".$person_dim_id.")";
		$member_ids_res = DB::executeAll($sql);
		
		$member_ids = array();
		foreach ($member_ids_res as $row) {
			if (trim($row['member_id']) != "") $member_ids[] = $row['member_id'];
		}
		
		if (!$member_ids || count($member_ids) == 0) {
			$contacts = array(logged_user());
		}
	}
}

function mail_delete_member($member){
    DB::executeAll("UPDATE ".TABLE_PREFIX."mail_accounts SET member_id=0 WHERE member_id = '".$member->getId()."'");
}