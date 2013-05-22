<?php

/**
 * Add permissions for timeslots, templates and reports in persons dimension
 * @author Alvaro Torterola <alvaro.torterola@fengoffice.com>
 */
function core_dimensions_update_1_2() {
	DB::execute("
		INSERT INTO ".TABLE_PREFIX."dimension_object_type_contents (dimension_id, dimension_object_type_id, content_object_type_id, is_required, is_multiple)
		 SELECT (SELECT id FROM ".TABLE_PREFIX."dimensions WHERE code = 'feng_persons'), (SELECT id FROM ".TABLE_PREFIX."object_types WHERE name='person'), ot.id, 0, 1
		 FROM ".TABLE_PREFIX."object_types ot WHERE ot.type IN ('located')
		ON DUPLICATE KEY UPDATE dimension_id=dimension_id;
	");
	
	DB::execute("
		INSERT INTO ".TABLE_PREFIX."dimension_object_type_contents (dimension_id, dimension_object_type_id, content_object_type_id, is_required, is_multiple)
		 SELECT (SELECT id FROM ".TABLE_PREFIX."dimensions WHERE code = 'feng_persons'), (SELECT id FROM ".TABLE_PREFIX."object_types WHERE name='company'), ot.id, 0, 1
		 FROM ".TABLE_PREFIX."object_types ot WHERE ot.type IN ('located')
		ON DUPLICATE KEY UPDATE dimension_id=dimension_id;
	");
	
	DB::execute("
		INSERT INTO `".TABLE_PREFIX."contact_member_permissions` (`permission_group_id`, `member_id`, `object_type_id`, `can_write`, `can_delete`)
		 SELECT `c`.`permission_group_id`, `m`.`id`, `ot`.`id`, (`c`.`object_id` = `m`.`object_id`) as `can_write`, (`c`.`object_id` = `m`.`object_id`) as `can_delete`
		 FROM `".TABLE_PREFIX."contacts` `c` JOIN `".TABLE_PREFIX."members` `m`, `".TABLE_PREFIX."object_types` `ot`
		 WHERE `c`.`is_company`=0
		 	AND `c`.`user_type`!=0
		 	AND `ot`.`type` IN ('located')
		 	AND `m`.`dimension_id` IN (SELECT `id` FROM `".TABLE_PREFIX."dimensions` WHERE `code` = 'feng_persons')
		 	AND `c`.`object_id` = `m`.`object_id`
		ON DUPLICATE KEY UPDATE member_id=member_id;
	");
}

function core_dimensions_update_2_3() {
	DB::execute("
		UPDATE ".TABLE_PREFIX."dimensions SET permission_query_method='not_mandatory' WHERE code='feng_persons';
	");
}

function core_dimensions_update_3_4() {
	DB::execute("
		INSERT INTO `".TABLE_PREFIX."config_options` (`category_name`, `name`, `value`, `config_handler_class`, `is_system`, `option_order`) VALUES
			('system', 'hide_people_vinculations', '1', 'BoolConfigHandler', 1, 0)
		ON DUPLICATE KEY UPDATE name=name;
	");
}

function core_dimensions_update_4_5() {
	DB::execute("
		INSERT INTO `".TABLE_PREFIX."contact_member_permissions` (`permission_group_id`, `member_id`, `object_type_id`, `can_write`, `can_delete`)
		 SELECT `c`.`permission_group_id`, `m`.`id` as member_id, `ot`.`id` as object_type_id, 1, 1
		 FROM `".TABLE_PREFIX."contacts` `c` JOIN `".TABLE_PREFIX."members` `m`, `".TABLE_PREFIX."object_types` `ot`
		 WHERE `c`.`object_id`=m.object_id
		   AND `c`.`permission_group_id` > 0
		 	AND `ot`.`type` IN ('located')
		 	AND `m`.`dimension_id` IN (SELECT `id` FROM `".TABLE_PREFIX."dimensions` WHERE `code` = 'feng_persons')
		ON DUPLICATE KEY UPDATE ".TABLE_PREFIX."contact_member_permissions.member_id=".TABLE_PREFIX."contact_member_permissions.member_id;
	");
}

function core_dimensions_update_5_6() {
	DB::execute('
		UPDATE '.TABLE_PREFIX.'dimensions SET options = \'{"useLangs":true,"defaultAjax":{"controller":"dashboard", "action": "main_dashboard"},"quickAdd":{"formAction":"?c=contact&a=quick_add"}}\'
		WHERE code = \'feng_persons\';
	');
}