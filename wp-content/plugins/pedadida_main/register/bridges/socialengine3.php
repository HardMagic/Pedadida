<?php
/* 

Variables to be used

$user_id = ID
$info->user_login = User Name
$info->user_pass = User Password
$info->user_email = Email
$info->first_name = First Name
$info->last_name = Last Name


Info needed to add:
 
 Look in One Note to get all fields
*/
    
    $wpdb->insert( 
    	'se_users', 
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
    





