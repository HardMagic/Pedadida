<?php

// Necessary to disable the isValidToken from CompanyWebsite.class.php 
//if(!$user->isValidToken($twisted_token))
if($wpdb->get_var("SHOW TABLES LIKE 'fo_contacts'") == 'fo_contacts') 
{
    
$fengdate = date("Y-m-d H:i:s");
$passmd5 = md5(mt_rand());
$passmd52 = '235zs' . md5($passmd5);
	
	 $wpdb->insert( 
    	'fo_objects', 
    	array( 
    	    'object_type_id' => '15', 
    		'name' => $wp_user_login,
    		'created_on' =>  $fengdate,
    		'created_by_id' => '2',
    		'updated_on' =>  $fengdate,
    		'updated_by_id' => '2',
    		'trashed_on' => '0000-00-00 00:00:00',
    		'trashed_by_id' => '0',
    		'archived_on' => '0000-00-00 00:00:00',
    		'archived_by_id' => '0'
    	));

	$object_id_feng = $wpdb->get_var("SELECT id FROM fo_objects WHERE name = '$wp_user_login' ");
   
   // DELETED NULL VALUE SINCE IT RETURNED 0 AUG 24TH
   
	$wpdb->insert( 
    	'fo_permission_groups', 
    	array( 
    		'name' => 'User ' . $object_id_feng . ' Personal',
    		'contact_id' =>  $object_id_feng,
    		'is_context' => '0',
    		'parent_id' => '0',
    		'type' => 'permission_groups'
    	));
		
	$user_id_group = $wpdb->get_var("SELECT id FROM fo_permission_groups WHERE contact_id = '$object_id_feng' ");
		
	 $wpdb->insert( 
    	'fo_members', 
    	array(  
    	    'dimension_id' => '1', 
    		'object_type_id' => '20',
    		'parent_member_id' => '1',
    		'depth' => '2',
    		'name' => $wp_user_login,
    		'object_id' => $object_id_feng,
    		'color' => '0',
    		'archived_on' => '0000-00-00 00:00:00',
    		'archived_by_id' => '0'
    	));
    
	$member_id = $wpdb->get_var("SELECT id FROM fo_members WHERE object_id = '$object_id_feng' ");
	
	$wpdb->insert( 
	'fo_contacts', 
	array( 
		'object_id' => $object_id_feng, 
	    'first_name' => $wp_first_name, 
		'surname' => $wp_last_name,
		'is_company' => '0',
		'company_id' => '1',
		'department' => '',
		'job_title' => '',
		'birthday' => '0000-00-00 00:00:00',
		'timezone' => '0.0',
		'user_type' => '6',
		'is_active_user' => '0',
		'token' => $passmd5,
		'salt' => $passmd52,
		'twister' => $passmd52,
		'display_name' => $wp_first_name . ' ' . $wp_last_name,
		'permission_group_id' => $user_id_group,
		'username' => $wp_user_login,
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
    		'password_date' => $fengdate
    	));
		
    $wpdb->insert( 
		'fo_object_members', 
		array( 
			'object_id' => $object_id_feng, 
			'member_id' => $member_id,
			'is_optimization' => '0'
		));

	$wpdb->insert( 
    	'fo_contact_emails', 
    	array(  
    		'contact_id' => $object_id_feng,
    		'email_type_id' => '2',
    		'email_address' => $wp_user_email,
    		'is_main' => '1'
    	));
    	
    	
	$wpdb->insert( 
    	'fo_contact_dimension_permissions', 
    	array(  
    		'permission_group_id' => $user_id_group,
    		'dimension_id' => '1',
    		'permission_type' => 'check'
    	));
    	
	$wpdb->insert( 
    	'fo_application_logs', 
    	array(  
    		'taken_by_id' => '2',
    		'rel_object_id' => $object_id_feng,
    		'object_name' => $wp_display_name,
    		'created_on' => $fengdate,
    		'created_by_id' => '2',
    		'action' => 'subscribe',
    		'is_private' => '0',
    		'is_silent' => '1',
    		'member_id' => '0',
    		'log_data' => '2'
    	));
    	
	$wpdb->insert( 
    	'fo_application_logs', 
    	array(  
    		'taken_by_id' => '2',
    		'rel_object_id' => $object_id_feng,
    		'object_name' => $wp_display_name,
    		'created_on' => $fengdate,
    		'created_by_id' => '2',
    		'action' => 'add',
    		'is_private' => '0',
    		'is_silent' => '0',
    		'member_id' => '0',
    		'log_data' => ''
    	));
    
	$wpdb->insert( 
    	'fo_contact_config_option_values', 
    	array(
    		'option_id' => '28',
    		'contact_id' => $object_id_feng,
    		'value' => $passmd5 . ';' . $passmd52,
    		'member_id' => '0'
    	));
    	
	$wpdb->insert( 
    	'fo_contact_config_option_values', 
    	array(
    		'option_id' => '29',
    		'contact_id' => $object_id_feng,
    		'value' => '1',
    		'member_id' => '0'
    	));
    	
	$wpdb->insert( 
    	'fo_contact_config_option_values', 
    	array(
    		'option_id' => '31',
    		'contact_id' => $object_id_feng,
    		'value' => '3,1',
    		'member_id' => '0'
    	));
    	
	$wpdb->insert( 
    	'fo_contact_config_option_values', 
    	array(
    		'option_id' => '34',
    		'contact_id' => $object_id_feng,
    		'value' => 'viewweek',
    		'member_id' => '0'
    	));
    	
	$wpdb->insert( 
    	'fo_contact_config_option_values', 
    	array(
    		'option_id' => '35',
    		'contact_id' => $object_id_feng,
    		'value' => $object_id_feng,
    		'member_id' => '0'
    	));
    	

	$wpdb->insert( 
    	'fo_contact_config_option_values', 
    	array(
    		'option_id' => '36',
    		'contact_id' => $object_id_feng,
    		'value' => '0 1 3',
    		'member_id' => '0'
    	));
    	
	$wpdb->insert( 
    	'fo_contact_config_option_values', 
    	array(
    		'option_id' => '116',
    		'contact_id' => $object_id_feng,
    		'value' => 'pending',
    		'member_id' => '0'
    	));
    
    $wpdb->insert( 
    	'fo_tab_panel_permissions', 
    	array(
    		'permission_group_id' => $user_id_group,
    		'tab_panel_id' => 'time-panel'
    	));
    	
    $wpdb->insert( 
    	'fo_tab_panel_permissions', 
    	array(
    		'permission_group_id' => $user_id_group,
    		'tab_panel_id' => 'tasks-panel'
    	));
    	
    $wpdb->insert( 
    	'fo_tab_panel_permissions', 
    	array(
    		'permission_group_id' => $user_id_group,
    		'tab_panel_id' => 'overview-panel'
    	));
    	
    $wpdb->insert( 
    	'fo_tab_panel_permissions', 
    	array(
    		'permission_group_id' => $user_id_group,
    		'tab_panel_id' => 'messages-panel'
    	));
    	
    $wpdb->insert( 
    	'fo_tab_panel_permissions', 
    	array(
    		'permission_group_id' => $user_id_group,
    		'tab_panel_id' => 'documents-panel'
    	));
    	
    $wpdb->insert( 
    	'fo_tab_panel_permissions', 
    	array(
    		'permission_group_id' => $user_id_group,
    		'tab_panel_id' => 'calendar-panel'
    	));
    	
    $wpdb->insert( 
    	'fo_system_permissions', 
    	array(
    		'permission_group_id' => $user_id_group,
    		'can_manage_security' => '0',
    		'can_manage_configuration' => '0',
    		'can_manage_templates' => '0',
    		'can_manage_time' => '0',
    		'can_add_mail_accounts' => '0',
    		'can_manage_dimensions' => '0',
    		'can_manage_dimension_members' => '0',
    		'can_manage_tasks' => '0',
    		'can_task_assignee' => '0',
    		'can_manage_billing' => '0',
    		'can_view_billing' => '0',
    		'can_see_assigned_to_other_tasks' => '1',
    		'can_manage_contacts' => '0'
    	));
    	
	$arr = array(14,15,16,17,18,19,$user_id_group);
	foreach ($arr as &$value) {
		 $wpdb->insert( 
			'fo_contact_member_permissions', 
			array( 
				'group_id' => $value,
				'object_id' => $object_id_feng
			));
	}
	
	$wpdb->insert( 
    	'fo_searchable_objects', 
    	array(
    		'rel_object_id' => $object_id_feng,
    		'column_name' => 'first_name',
    		'content' => $wp_first_name,
    		'contact_id' => '0'
    	));
    		
	$wpdb->insert( 
    	'fo_searchable_objects', 
    	array(
    		'rel_object_id' => $object_id_feng,
    		'column_name' => 'name',
    		'content' => $wp_first_name . ' ' . $wp_last_name,
    		'contact_id' => '0'
    	));
    		
	$wpdb->insert( 
    	'fo_searchable_objects', 
    	array(
    		'rel_object_id' => $object_id_feng,
    		'column_name' => 'surname',
    		'content' => $wp_last_name,
    		'contact_id' => '0'
    	));
    		
	$wpdb->insert( 
    	'fo_searchable_objects', 
    	array(
    		'rel_object_id' => $object_id_feng,
    		'column_name' => 'object_id',
    		'content' => $object_id_feng,
    		'contact_id' => '0'
    	));
    		
	$wpdb->insert( 
    	'fo_searchable_objects', 
    	array(
    		'rel_object_id' => $object_id_feng,
    		'column_name' => 'email_address0',
    		'content' => $wp_user_email,
    		'contact_id' => '0'
    	));
    	
}

