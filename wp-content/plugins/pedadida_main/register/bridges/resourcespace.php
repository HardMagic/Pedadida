<?php
/* 

Variables to be used

$user_id = ID
$info->user_login = User Name
$info->user_pass = User Password
$info->user_email = Email
$info->first_name = First Name
$info->last_name = Last Name


Info needed to add is at bottom.


*/
    
    $wpdb->insert( 
    	'user', 
    	array( 
    	    'ref' => $user_id,
    	    'username' => $info->user_login, 
    		'password' => $info->user_pass, 
    		'fullname' => $info->first_name . " " . $info->last_name,
    		'email' => $info->user_email,
    		'usergroup' => $info->user_pass,
    		'last_active' => $info->user_pass, 
    		'logged_in' => $info->user_login, 
    		'last_browser' => $info->user_pass, 
    		'last_ip' => $info->user_pass, 
    		'current_collection' => $info->user_pass, 
    		'accepted_terms' => $info->user_pass,  
    		'account_expires' => $info->user_pass,  
    		'comments' => $info->user_pass,  
    		'session' => $info->user_pass,  
    		'ip_restrict' => $info->user_pass, 
    		'password_last_change' => $info->user_pass, 
    		'login_tries' => $info->user_pass, 
    		'login_last_try' => $info->user_pass, 
    		'approved' => $info->user_pass, fo->user_email,
    		'lang' => $info->user_pass, 
    		'created' => $info->user_pass
    	));
    



		
		
		
		
		
		
		
		
		
		
		
			while ($userRow = mysql_fetch_array($this_user_data_se)) {
					$username=$userRow['user_username'];
					$password=$userRow['user_password'];
					$password=md5("RS" . $username . $password);
					$fullname=$userRow['user_displayname'];
					$email=$userRow['user_email'];
					$usergroup=$userRow['user_level_id'];
					$last_active="2010-11-27 01:38:01";
					$logged_in=1;
					$last_browser="NULL";
					$last_ip=$userRow['user_ip_lastactive'];
					$current_collection=2;
					$accepted_terms=1;
					$account_expires="NULL";
					$comments="NULL";
					$session="NULL";
					$ip_restrict="NULL";
					$password_last_change="0000-00-00 00:00:00";
					$login_tries=0;
					$login_last_try="NULL";
					$approved=$userRow['user_enabled'];
					$lang="en-us";
					$created="CURRENT_TIMESTAMP";
				}
				
			
						
					

NULL , '$username', '$password', '$fullname', '$email', '$usergroup', '$last_active', '1', NULL, '$last_ip', '3', '$accepted_terms', NULL, '', '', '', '0', '0', NULL , '$approved', '$lang' , CURRENT_TIMESTAMP )") or die(mysql_error());