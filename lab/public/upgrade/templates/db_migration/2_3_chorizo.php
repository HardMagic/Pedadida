-- <?php echo $table_prefix ?> fo_
-- <?php echo $default_charset ?> DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
-- <?php echo $default_collation ?> collate utf8_unicode_ci
-- <?php echo $engine ?> InnoDB

INSERT INTO `<?php echo $table_prefix ?>contact_config_options` (`category_name`, `name`, `default_value`, `config_handler_class`, `is_system`, `option_order`, `dev_comment`) VALUES 
	('task panel', 'reminders_tasks', 'reminder_email,1,1440', 'StringConfigHandler', '0', '23', NULL),
 	('task panel', 'add_task_autoreminder', '0', 'BoolConfigHandler', '0', '21', NULL),
 	('task panel', 'add_self_task_autoreminder', '1', 'BoolConfigHandler', '0', '22', NULL), 	
 	('task panel', 'add_task_default_reminder', '1', 'BoolConfigHandler', '0', '20', NULL),
	('calendar panel', 'add_event_autoreminder', '1', 'BoolConfigHandler', '0', '0', NULL),
	('calendar panel', 'autoassign_events', '0', 'BoolConfigHandler', '0', '0', NULL),
	('calendar panel', 'event_send_invitations', '1', 'BoolConfigHandler', '0', '0', NULL),
	('calendar panel', 'event_subscribe_invited', '1', 'BoolConfigHandler', '0', '0', NULL),
	('mails panel', 'mails_per_page', '50', 'IntegerConfigHandler', '0', '0', NULL),
	('general', 'access_member_after_add', '1', 'BoolConfigHandler', '0', '1300', NULL),
	('general', 'access_member_after_add_remember', '0', 'BoolConfigHandler', '0', '1301', NULL),
	('general', 'sendEmailNotification', '1', 'BoolConfigHandler', '1', '0', 'Send email notification to new user'),
 	('general', 'viewContactsChecked', '1', 'BoolConfigHandler', '1', '0', 'in people panel is view contacts checked'),
 	('general', 'viewUsersChecked', '0', 'BoolConfigHandler', '0', '0', 'in people panel is view users checked'),
 	('general', 'viewCompaniesChecked', '1', 'BoolConfigHandler', '1', '0', 'in people panel is view companies checked'),
	('general', 'contacts_per_page', '50', 'IntegerConfigHandler', '0', '1200', NULL)
ON DUPLICATE KEY UPDATE name=name;

INSERT INTO `<?php echo $table_prefix ?>config_options` (`category_name`,`name`,`value`,`config_handler_class`,`is_system`) VALUES
	('general', 'can_assign_tasks_to_companies', '1', 'BoolConfigHandler', '0'),
	('general', 'use_object_properties', '0', 'BoolConfigHandler', '0')
ON DUPLICATE KEY UPDATE name=name;
UPDATE `<?php echo $table_prefix ?>config_options` SET `value` = if ((SELECT count(*) FROM <?php echo $table_prefix ?>object_properties)>0, 1, 0) WHERE `name`='use_object_properties';
UPDATE `<?php echo $table_prefix ?>config_options` SET `value` = '1' WHERE `name`='can_assign_tasks_to_companies';
