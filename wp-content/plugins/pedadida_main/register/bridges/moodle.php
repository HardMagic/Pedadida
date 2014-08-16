<?php
/* 

Variables to be used

$user_id = ID
$info->user_login = User Name
$info->email = Email
$info->first_name = First Name
$info->last_name = Last Name


*/
if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'mdl_users'"))==1) 
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
    

