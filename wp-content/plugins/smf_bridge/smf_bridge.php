<?php
/*
Plugin Name: SMF Wordpress Bridge
Plugin URI: http://hardmagic.com/smf_bridge
Description:  Sync All Wordpress Logins to SMF
Author: Krashnik
Version: 0.1
Author URI: http://modelmatt.com
*/
function smf_login($user_login, $user) {

//require_once(__DIR__.'/../../../../pedadida-config.php'); // needed to get Secret Key
require_once(__DIR__.'/../../../discuss/smf_2_api.php'); 

smfapi_login($user_login);

}
add_action('wp_login', 'smf_login', 10, 2);
?>


