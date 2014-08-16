<?php
/* 


*/

//NO TIME VARIABLE
if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'user'"))==1) 
{
$no_time="0000-00-00 00:00:00";
    
    $wpdb->insert( 
    	'user', 
    	array( 
    	    'ref' => $user_id,
    	    'username' => $info->user_login, 
    		'password' => $info->user_pass, 
    		'fullname' => $info->first_name . " " . $info->last_name,
    		'email' => $info->user_email,
    		'usergroup' => 1,
    		'last_active' => $no_time, 
    		'logged_in' => 1, 
    		'last_browser' => NULL, 
    		'last_ip' => $_SERVER['REMOTE_ADDR'], 
    		'current_collection' => 2, 
    		'accepted_terms' => 1,  
    		'account_expires' => NULL,  
    		'comments' => NULL,  
    		'session' => NULL,  
    		'ip_restrict' => NULL, 
    		'password_last_change' => $no_time, 
    		'login_tries' => 0, 
    		'login_last_try' => NULL, 
    		'approved' => 1,
    		'lang' => 'en-us', 
    		'created' => CURRENT_TIMESTAMP
    	));

}