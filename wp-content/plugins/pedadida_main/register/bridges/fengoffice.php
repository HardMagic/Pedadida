<?php

if($wpdb->get_var("SHOW TABLES LIKE 'fo_contacts'") == 'fo_contacts') 
{
    
$fengdate = date("Y-m-d H:i:s");
$passmd5 = md5(mt_rand());
$passmd52 = '235zs' . md5($passmd5);
	
	 $wpdb->insert( 
    	'fo_objects', 
    	array( 
    	    'object_type_id' => '15', 
    		'name' => $info->user_login,
    		'created_on' =>  $fengdate,
    		'created_by_id' => '2',
    		'updated_on' =>  $fengdate,
    		'updated_by_id' => '2',
    		'trashed_on' => '0000-00-00 00:00:00',
    		'trashed_by_id' => '0',
    		'archived_on' => '0000-00-00 00:00:00',
    		'archived_by_id' => '0'
    	));

	$object_id_feng = $wpdb->get_var("SELECT id FROM fo_objects WHERE name = '$info->user_login' ");
   
	$wpdb->insert( 
    	'fo_permission_groups', 
    	array( 
    		'name' => $info->user_login . ' Personal',
    		'contact_id' =>  $object_id_feng,
    		'is_context' => '0',
    		'plugin_id' => 'NULL',
    		'parent_id' => '0',
    		'type' => 'permission_groups'
    	));
		
	$user_id_group = $wpdb->get_var("SELECT id FROM fo_permission_groups WHERE contact_id = '$object_id_feng' ");
		
	 $wpdb->insert( 
    	'fo_members', 
    	array(  
    	    'dimension_id' => '1', 
    		'object_type_id' => '20',
    		'parent_member_id' => '0',
    		'depth' => '1',
    		'name' => $info->user_login,
    		'object_id' => $object_id_feng,
    		'color' => '1',
    		'archived_on' => '0000-00-00 00:00:00',
    		'archived_by_id' => '0'
    	));
    
	$member_id = $wpdb->get_var("SELECT id FROM fo_members WHERE object_id = '$object_id_feng' ");
	
	$wpdb->insert( 
	'fo_contacts', 
	array( 
		'object_id' => $object_id_feng, 
	    'first_name' => $info->first_name, 
		'surname' => $info->last_name,
		'is_company' => '0',
		'company_id' => '0',
		'department' => '',
		'job_title' => '',
		'birthday' => '0000-00-00 00:00:00',
		'timezone' => '0.0',
		'user_type' => '12',
		'is_active_user' => '0',
		'token' => $passmd5,
		'salt' => $passmd52,
		'twister' => $passmd52,
		'display_name' => $info->first_name . ' ' . $info->last_name,
		'permission_group_id' => $user_id_group,
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
	
	
    $wpdb->insert( 
    	'fo_contact_permission_groups', 
    	array( 
    	    'contact_id' => $object_id_feng, 
    		'permission_group_id' => $user_id_group
    	));
    
 
     
   
	
	
	$arr = array(3,4,5,6,9,10,11,12,13,15,16,17,18,19,22);
	foreach ($arr as &$value) {
		 $wpdb->insert( 
			'fo_contact_member_permissions', 
			array( 
				'permission_group_id' => $user_id_group,
				'member_id' => $member_id, 
				'object_type_id' => $value,
				'can_write' => '1', 
				'can_delete' => '1' 
			));
	}
	
	foreach ($arr as &$value) {
		 $wpdb->insert( 
			'fo_contact_member_permissions', 
			array( 
				'permission_group_id' => '14',
				'member_id' => $member_id, 
				'object_type_id' => $value,
				'can_write' => '1', 
				'can_delete' => '1' 
			));
	}
	
    
    $wpdb->insert( 
    	'fo_contact_passwords', 
    	array( 
    	    'contact_id' => $object_id_feng, 
    		'password' => $passmd5,
    		'password_date' => ''
    	));
    	
	$members = array(1, 2); 
	foreach ($members as &$value) {
	$wpdb->insert( 
		'fo_object_members', 
		array( 
			'object_id' => $object_id_feng, 
			'member_id' => $value,
			'is_optimization' => '0'
		));
		}
		
    $wpdb->insert( 
		'fo_object_members', 
		array( 
			'object_id' => $object_id_feng, 
			'member_id' => $member_id,
			'is_optimization' => '1'
		));

   

}

