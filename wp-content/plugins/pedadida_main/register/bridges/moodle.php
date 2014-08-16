<?php
global $wpdb;
if($wpdb->get_var("SHOW TABLES LIKE 'mdl_users'") == 'mdl_users') 
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
    

