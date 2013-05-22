<?php
chdir(dirname(__FILE__));
header("Content-type: text/plain");
define("CONSOLE_MODE", true);
include "init.php";
Env::useHelper('format');

define('SCRIPT_MEMORY_LIMIT', 1024 * 1024 * 1024); // 1 GB

@set_time_limit(0);
ini_set('memory_limit', ((SCRIPT_MEMORY_LIMIT / (1024*1024))+50).'M');


DB::execute("CREATE TABLE IF NOT EXISTS `fixed_objects` (
  `object_id` INTEGER UNSIGNED,
  PRIMARY KEY (`object_id`)
) ENGINE = InnoDB;");
$drop_tmp_table = true;

$object_ids = Objects::instance()->findAll(array('id' => true, 'conditions' => 'id NOT IN (SELECT object_id FROM fixed_objects)'));

$processed_objects = array();
$i = 0;
$msg = "";
echo "\nObjects to process: " . count($object_ids) . "\n-----------------------------------------------------------------";

foreach ($object_ids as $object_id) {
	$object = Objects::findObject($object_id);
	if ($object instanceof ContentDataObject) {
		$object->addToSharingTable();
	}
	$processed_objects[] = $object_id;
	$i++;
	$memory_limit_exceeded = memory_get_usage(true) > SCRIPT_MEMORY_LIMIT;
	
	if ($i % 100 == 0 || $memory_limit_exceeded) {
		echo "\n$i objects processed. Mem usage: " . format_filesize(memory_get_usage(true));
		if (count($processed_objects) > 0) {
			DB::execute("INSERT INTO fixed_objects (object_id) VALUES (".implode('),(', $processed_objects).");");
			$processed_objects = array();
		}
		ob_flush();
		
		if ($memory_limit_exceeded) {
			$msg = "Memory limit exceeded: " . format_filesize(memory_get_usage(true));
			$drop_tmp_table = false;
			break;
		}
	}
}

echo "\n-----------------------------------------------------------------\nFinished: $i objects processed. $msg\n";
if (count($processed_objects) > 0) {
	DB::execute("INSERT INTO fixed_objects (object_id) VALUES (".implode('),(', $processed_objects).");");
	$processed_objects = array();
	if ($drop_tmp_table) {
		DB::execute("DROP TABLE `fixed_objects`;");
	}
}