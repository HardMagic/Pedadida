<?php
/* 

Variables to be used

$user_id = ID
$info->user_login = User Name
$info->email = Email
$info->first_name = First Name
$info->last_name = Last Name

INSERT INTO `prana_shama`.`fo_contacts` (`object_id`, `first_name`, `surname`, `is_company`, `company_id`, `department`, `job_title`, 
`birthday`, `timezone`, `user_type`, `is_active_user`, `token`, `salt`, `twister`, `display_name`, `permission_group_id`, `username`, 
`contact_passwords_id`, `picture_file`, `avatar_file`, `comments`, `last_login`, `last_visit`, `last_activity`, `personal_member_id`, 
`disabled`, `default_billing_id`) VALUES (NULL, '', '', '0', '2', NULL, NULL, NULL, '0.0', '0', '0', '', '', '', NULL, '', '', '',
NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0');


INSERT INTO `prana_shama`.`fo_objects` (`id`, `object_type_id`, `name`, `created_on`, `created_by_id`, `updated_on`, `updated_by_id`, 
`trashed_on`, `trashed_by_id`, `archived_on`, `archived_by_id`) VALUES (NULL, '', 'nn', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00',
NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL);
*/

$wpdb->insert( 
    	'mdl_users', 
    	array( 
    	    'id' => $user_id, 
    		'auth' => 'manual', 
    		'confirmed' => '1', 
    		'mnethostid' => '1', 
    		'username' => $info->user_login, 
    		'password' => $info->user_pass, 
    		'firstname' => $info->first_name, 
    		'lastname' => $info->last_name, 
    		'email' => $info->user_email 
    	));
    

