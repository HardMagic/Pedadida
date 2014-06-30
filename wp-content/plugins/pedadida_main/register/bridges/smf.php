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

INSERT INTO smf_members (id_member, member_name, email_address, passwd)
    VALUES (ID, NEW.user_username, NEW.user_email, NEW.user_password);


*/
    
    $wpdb->insert( 
    	'smf_members', 
    	array( 
    	    'id_member' => $user_id,
    		'member_name' => $info->user_login, 
    		'email_address' => $info->user_email,
    		'passwd' => $info->user_pass, 
    		'real_name' => $info->first_name . " " . $info->last_name
    	));
    





