<?php
/* 

Variables to be used

$user_id = ID
$info->user_login = User Name
$info->email = Email
$info->first_name = First Name
$info->last_name = Last Name


INSERT INTO `prana_shama`.`fo_contact_permission_groups` (`contact_id`, `permission_group_id`) VALUES ('', '');

INSERT INTO `prana_shama`.`fo_contact_member_permissions` (`permission_group_id`, `member_id`,
`object_type_id`, `can_write`, `can_delete`) VALUES ('345235', '', '', '0', '0') ON DUPLICATE KEY UPDATE ();

INSERT INTO `prana_shama`.`fo_contact_passwords` (`id`, `contact_id`, `password`, `password_date`) VALUES (NULL, '', '', '');

INSERT INTO `prana_shama`.`fo_contacts` (`object_id`, `first_name`, `surname`, `is_company`, `company_id`, `department`, `job_title`, 
`birthday`, `timezone`, `user_type`, `is_active_user`, `token`, `salt`, `twister`, `display_name`, `permission_group_id`, `username`, 
`contact_passwords_id`, `picture_file`, `avatar_file`, `comments`, `last_login`, `last_visit`, `last_activity`, `personal_member_id`, 
`disabled`, `default_billing_id`) VALUES (NULL, '', '', '0', '2', NULL, NULL, NULL, '0.0', '0', '0', '', '', '', NULL, '', '', '',
NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0');


INSERT INTO `prana_shama`.`fo_objects` (`id`, `object_type_id`, `name`, `created_on`, `created_by_id`, `updated_on`, `updated_by_id`, 
`trashed_on`, `trashed_by_id`, `archived_on`, `archived_by_id`) VALUES (NULL, '', 'nn', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00',
NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL);


INSERT INTO `prana_shama`.`fo_members` (`id`, `dimension_id`, `object_type_id`, `parent_member_id`, `depth`, `name`, `object_id`, `color`, 
`archived_on`, `archived_by_id`) VALUES (NULL, '4', '4', '2', '', '4', '4', '0', '0000-00-00 00:00:00', NULL);


INSERT INTO `prana_shama`.`fo_contact_dimension_permissions` (`permission_group_id`, 
`dimension_id`, `permission_type`) VALUES ('234', '', NULL);

*/

if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'fo_contacts'"))==1) 
{
    
    $wpdb->insert( 
    	'fo_contact_permission_groups', 
    	array( 
    	    'contact_id' => $user_id, 
    		'permission_group_id' => '17'
    	));
    
    $x=3;
    while($x<=10) {
      $wpdb->replace( 
    	'fo_contact_member_permissions', 
    	array( 
            'permission_group_id' => '17',
    		'member_id' => $user_id, 
    		'object_type_id' => $x,
    		'can_write' => '1', 
    		'can_delete' => '0' 
    	));
    $x++;
    } 
    
    $passmd5 = md5(mt_rand());
    
    $wpdb->insert( 
    	'fo_contact_passwords', 
    	array( 
    	    'id' => $user_id, 
    	    'contact_id' => $user_id, 
    		'password' => $passmd5,
    		'password_date' => ''
    	));
    	
    
    $wpdb->insert( 
    	'fo_members', 
    	array( 
    	    'id' => $user_id, 
    	    'dimension_id' => '1', 
    		'object_type_id' => '20',
    		'parent_member_id' => '1',
    		'depth' => '2',
    		'name' => 'manual',
    		'object_id' => $user_id,
    		'color' => '1',
    		'archived_on' => '0000-00-00 00:00:00',
    		'archived_by_id' => '0'
    	));
    
    $fengdate = date("Y-m-d H:i:s");
    
    $wpdb->insert( 
    	'fo_objects', 
    	array( 
    	    'object_type_id' => '15', 
    		'name' => $info->user_login,
    		'created_on' =>  $fengdate,
    		'created_by_id' => '0',
    		'updated_on' =>  $fengdate,
    		'updated_by_id' => '0',
    		'trashed_on' => '0000-00-00 00:00:00',
    		'trashed_by_id' => '0',
    		'archived_on' => '0000-00-00 00:00:00',
    		'archived_by_id' => '0'
    	));
    

            $wpdb->insert( 
    	'fo_contacts', 
    	array( 
    	    'object_id' => $user_id, 
    	    'first_name' => $user_id, 
    		'surname' => 'manual',
    		'is_company' => 'manual',
    		'company_id' => 'manual',
    		'department' => 'manual',
    		'job_title' => 'manual',
    		'birthday' => 'manual',
    		'timezone' => 'manual',
    		'user_type' => 'manual',
    		'is_active_user' => 'manual',
    		'token' => 'manual',
    		'salt' => 'manual',
    		'twister' => 'manual',
    		'display_name' => 'manual',
    		'permission_group_id' => 'manual',
    		'contact_passwords_id' => 'manual',
    		'picture_file' => 'manual',
    		'avatar_file' => 'manual',
    		'comments' => 'manual',
    		'last_login' => 'manual',
    		'last_visit' => 'manual',
    		'last_activity' => 'manual',
    		'personal_member_id' => 'manual',
    		'disabled' => 'manual',
    		'default_billing_id' => 'manual'
    		
    	));
/*
        foreach( $wpdb->get_results("SELECT * FROM your_table_name WHERE id LIKE' . $id . ';") as $key => $row) {
        // each column in your row will be accessible like this
        $my_column = $row->column_name;}
*/

}

