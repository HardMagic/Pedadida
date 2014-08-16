<?php
/* 

Variables to be used
these are notes from this wp function: get_userdata
$user_id = ID
$info->user_login = User Name
$info->user_pass = User Password
$info->user_email = Email
$info->first_name = First Name
$info->last_name = Last Name


Info needed to add:
 
 Look in One Note to get all fields
*/
    if($wpdb->get_var("SHOW TABLES LIKE 'se_users'") == 'se_users')
    {
    $wpdb->insert( 
    	'se_users', 
    	array( 
    	    'user_id' => $user_id, 
    	    'user_level_id' => 1,
    	    'user_subnet_id' => 0,
    	    'user_profilecat_id' => 1,
    	    'user_email' => $info->user_email,
    	    'user_newemail' => $info->user_email, 
    		'user_fname' => $info->first_name, 
    		'user_lname' => $info->last_name,
    		'user_username' => $info->user_login,
    	    'user_displayname' => $info->first_name,
    	    'user_password' => $info->user_pass,
    	    'user_password_method' => 1,
    	    'user_code' => $info->user_pass,
    	    'user_enabled' => 1,
    	    'user_verified' => 1,
    	    'user_language_id' => 1,
    	    'user_signupdate' => '',
    	    'user_lastlogindate' => 0,
    	    'user_lastactive' => 0,
    	    'user_ip_signup' => $_SERVER['REMOTE_ADDR'],
    	    'user_ip_lastactive' => $_SERVER['REMOTE_ADDR'],
    	    'user_status' => '',
    	    'user_status_date' => 0,
    	    'user_logins' => 0,
    	    'user_invitesleft' => 999,
    	    'user_timezone' => '-7',
    	    'user_dateupdated' => time(),
    	    'user_blocklist' => NULL,
    	    'user_invisible' => 0,
    	    'user_saveviews' => 0,
    	    'user_photo' => '',
    	    'user_search' => 1,
    	    'user_privacy' => 63,
    	    'user_comments' => 31,
    	    'user_hasnotifys' => 1,
    	    'user_userpoints_allowed' => 1,
    	    'user_profile_album' => 'tab',
    	    'user_profile_game' => 'tab',
    	    'Password_MD5' => $info->user_pass,
    	    'Password_Clear' => NULL,
    	    'currentcity' => '',
    	    'currentcountry' => '',
    	    'currentstate' => '',
    	    'currentzip' => '',
    	    'country_code' => '',
    	    'user_style' => 1,
    	    'user_url' => NULL,
    	    'upline_id' => 30,
    	    'user_rating' => NULL,
    	    'movprogress' => NULL
    	));
    	
    	
    
/*
INSERT INTO `themov_2nd`.`se_usersettings` (`usersetting_id`, `usersetting_user_id`, `usersetting_lostpassword_code`, `usersetting_lostpassword_time`, 
`usersetting_notify_friendrequest`, `usersetting_notify_message`, `usersetting_notify_profilecomment`, `usersetting_actions_dontpublish`, `usersetting_actions_display`, 
`usersetting_displayname_method`, `usersetting_openidconnect_publishfeeds`, `usersetting_openidconnect_publishfeeds_keys`, `usersetting_openidconnect_autologin`, 
`usersetting_notify_linkcomment`, `usersetting_notify_mediacomment`, `usersetting_notify_newtag`, `usersetting_notify_mediatag`, `usersetting_notify_badgecomment`, 
`usersetting_notify_epaymenttransaction`, `usersetting_notify_articlecomment`, `usersetting_notify_articlemediacomment`, `usersetting_notify_businesscomment`, 
`usersetting_notify_businessmediacomment`, `usersetting_permission_gmap`, `usersetting_gmap_f_country`, `usersetting_gmap_f_region`, `usersetting_gmap_f_city`, 
`usersetting_gmap_f_address`, `usersetting_gmap_f_postal`, `usersetting_notify_fileuploadscomment`, `usersetting_notify_jobpostcomment`, 
`usersetting_notify_jobpostmediacomment`, `usersetting_notify_groupinvite`, `usersetting_notify_groupcomment`, `usersetting_notify_groupmediacomment`, 
`usersetting_notify_groupmemberrequest`, `usersetting_notify_newgrouptag`, `usersetting_notify_groupmediatag`, `usersetting_notify_grouppost`, 
`usersetting_music_profile_autoplay`, `usersetting_music_site_autoplay`, `usersetting_xspfskin_id`, `usersetting_notify_eventinvite`, `usersetting_notify_eventcomment`, 
`usersetting_notify_eventmediacomment`, `usersetting_notify_eventmemberrequest`, `usersetting_notify_neweventtag`, `usersetting_notify_eventmediatag`, 
`usersetting_newsfeedplus_likepoints`, `usersetting_newsfeedplus_rememberchoice`, `usersetting_notify_recommendedcomment`, `usersetting_notify_videocomment`, 
`usersetting_notify_classifiedcomment`, `usersetting_notify_game_mediacomment`, `usersetting_notify_blogcomment`, `usersetting_notify_blogtrackback`, 
`usersetting_notify_newblogsubscriptionentry`, `usersetting_notify_itemcomment`, `usersetting_notify_itemmediacomment`, `usersetting_notify_wallpost`, 
`usersetting_notify_wallactioncomment`, `usersetting_notify_wallactionlike`, `usersetting_notify_wallactionfollow`) 
VALUES (NULL, '999999', '', '0', '0', '0', '0', '', '', '1', '', '', '0', '1', '1', '1', '1', '1', '1', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 
'1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '', '', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
*/

     $wpdb->insert( 
    	'se_usersettings', 
    	array( 
    	    'usersetting_user_id' => 1,
    	    'usersetting_lostpassword_code' => 0,
    	    'usersetting_lostpassword_time' => 1,
    	    'usersetting_notify_friendrequest' => $info->user_email,
    	    'usersetting_notify_message' => $info->user_email, 
    		'usersetting_notify_profilecomment' => $info->first_name, 
    		'usersetting_actions_dontpublish' => $info->last_name,
    		'usersetting_actions_display' => $info->user_login,
    	    'usersetting_displayname_method' => $info->first_name,
    	    'usersetting_openidconnect_publishfeeds' => $info->user_pass,
    	    'usersetting_openidconnect_publishfeeds_keys' => 1,
    	    'usersetting_openidconnect_autologin' => $info->user_pass,
    	    'usersetting_notify_linkcomment' => 1,
    	    'usersetting_notify_mediacomment' => 1,
    	    'usersetting_notify_newtag' => 1,
    	    'usersetting_notify_mediatag' => '',
    	    'usersetting_notify_badgecomment' => 0,
    	    'usersetting_notify_epaymenttransaction' => 0,
    	    'usersetting_notify_articlecomment' => $_SERVER['REMOTE_ADDR'],
    	    'usersetting_notify_articlemediacomment' => $_SERVER['REMOTE_ADDR'],
    	    'usersetting_notify_businesscomment' => '',
    	    'usersetting_notify_businessmediacomment' => 0,
    	    'usersetting_permission_gmap' => 0,
    	    'usersetting_gmap_f_country' => 999,
    	    'usersetting_gmap_f_region' => '-7',
    	    'usersetting_gmap_f_city' => time(),
    	    'usersetting_gmap_f_address' => NULL,
    	    'usersetting_gmap_f_postal' => 0,
    	    'usersetting_notify_fileuploadscomment' => 0,
    	    'usersetting_notify_jobpostcomment' => '',
    	    'usersetting_notify_jobpostmediacomment' => 1,
    	    'usersetting_notify_groupinvite' => 63,
    	    'usersetting_notify_groupcomment' => 31,
    	    'usersetting_notify_groupmediacomment' => 1,
    	    'usersetting_notify_groupmemberrequest' => 1,
    	    'usersetting_notify_newgrouptag' => 'tab',
    	    'usersetting_notify_groupmediatag' => 'tab',
    	    'usersetting_notify_grouppost' => $info->user_pass,
    	    'usersetting_music_profile_autoplay' => NULL,
    	    'usersetting_music_site_autoplay' => '',
    	    'usersetting_xspfskin_id' => '',
    	    'usersetting_notify_eventinvite' => '',
    	    'usersetting_notify_eventcomment' => '',
    	    'usersetting_notify_eventmediacomment' => '',
    	    'usersetting_notify_eventmemberrequest' => 1,
    	    'usersetting_notify_neweventtag' => NULL,
    	    'usersetting_notify_eventmediatag' => 30,
    	    'usersetting_newsfeedplus_likepoints' => NULL,
    	    'usersetting_newsfeedplus_rememberchoice' => 'tab',
    	    'usersetting_notify_recommendedcomment' => 'tab',
    	    'usersetting_notify_videocomment' => $info->user_pass,
    	    'usersetting_notify_classifiedcomment' => '',
    	    'usersetting_notify_game_mediacomment' => '',
    	    'usersetting_notify_blogcomment' => 1,
    	    'usersetting_notify_blogtrackback' => NULL,
    	    'usersetting_notify_newblogsubscriptionentry' => 30,
    	    'usersetting_notify_itemcomment' => NULL,
    	    'usersetting_notify_itemmediacomment' => 'tab',
    	    'usersetting_notify_wallpost' => 'tab',
    	    'usersetting_notify_wallactioncomment' => $info->user_pass,
    	    'usersetting_notify_wallactionlike' => NULL,
    	    'usersetting_notify_wallactionfollow' => ''
    	));


/*
INSERT INTO `themov_2nd`.`se_profilevalues` (`profilevalue_id`, `profilevalue_user_id`, `profilevalue_2`, `profilevalue_3`,
`profilevalue_4`, `profilevalue_5`, `profilevalue_8`, `profilevalue_10`, `profilevalue_11`, `profilevalue_12`, 
`profilevalue_13`, `profilevalue_14`, `profilevalue_15`, `profilevalue_17`, `profilevalue_18`, `profilevalue_19`, 
`profilevalue_20`, `profilevalue_21`, `profilevalue_22`, `profilevalue_23`, `profilevalue_24`, `profilevalue_25`, 
`profilevalue_26`, `profilevalue_27`, `profilevalue_28`, `profilevalue_29`, `profilevalue_30`, `profilevalue_31`, 
`profilevalue_32`, `profilevalue_33`, `profilevalue_34`, `profilevalue_35`, `profilevalue_36`) 
VALUES (NULL, '9876543', '', '', '0000-00-00', '-1', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, '-1', '-1', '', '', '', '-1', '', '', '', '', '', NULL, NULL, NULL, '', '', '');
*/
}