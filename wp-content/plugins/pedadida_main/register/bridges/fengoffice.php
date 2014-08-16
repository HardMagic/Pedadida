<?php

if($wpdb->get_var("SHOW TABLES LIKE 'fo_contacts'") == 'fo_contacts') 
{
    
$fengdate = date("Y-m-d H:i:s");
$passmd5 = md5(mt_rand());
$passmd52 = '235zs' . md5($passmd5);


    $wpdb->insert( 
	'fo_contacts', 
	array( 
	    'first_name' => $info->first_name, 
		'surname' => $info->last_name,
		'is_company' => '0',
		'company_id' => '1',
		'department' => '',
		'job_title' => '',
		'birthday' => '0000-00-00 00:00:00',
		'timezone' => '0.0',
		'user_type' => '3',
		'is_active_user' => '0',
		'token' => $passmd5,
		'salt' => $passmd52,
		'twister' => $passmd52,
		'display_name' => $info->first_name . ' ' . $info->last_name,
		'permission_group_id' => '12',
		'username' => $info->user_login,
		'contact_passwords_id' => '0',
		'picture_file' => '',
		'avatar_file' => '',
		'comments' => '',
		'last_login' => $fengdate,
		'last_visit' => $fengdate,
		'last_activity' => $fengdate,
		'personal_member_id' => '0',
		'disabled' => '0',
		'default_billing_id' => '0'
		
	));

    foreach(
        $wpdb->get_results(
        "SELECT * FROM fo_contacts WHERE username LIKE' . $info->user_login . ';")
        as $key => $row
        ){
            $user_id_feng = $row->object_id;
        }
        
    
    $wpdb->insert( 
    	'fo_contact_permission_groups', 
    	array( 
    	    'contact_id' => $user_id_feng, 
    		'permission_group_id' => '12'
    	));
    
    $x=3;
    while($x<=10) {
      $wpdb->insert( 
    	'fo_contact_member_permissions', 
    	array( 
            'permission_group_id' => '12',
    		'member_id' => $user_id_feng, 
    		'object_type_id' => $x,
    		'can_write' => '1', 
    		'can_delete' => '0' 
    	));
    $x++;
    } 
    
    $wpdb->insert( 
    	'fo_contact_passwords', 
    	array( 
    	    'contact_id' => $user_id_feng, 
    		'password' => $passmd5,
    		'password_date' => ''
    	));
    	
    
    $wpdb->insert( 
    	'fo_members', 
    	array(  
    	    'dimension_id' => '1', 
    		'object_type_id' => '20',
    		'parent_member_id' => '1',
    		'depth' => '2',
    		'name' => 'manual',
    		'object_id' => $user_id_feng,
    		'color' => '1',
    		'archived_on' => '0000-00-00 00:00:00',
    		'archived_by_id' => '0'
    	));
    
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
    

}

