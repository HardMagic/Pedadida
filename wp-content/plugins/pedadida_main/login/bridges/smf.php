<?php

function smf_login($user_login, $user) {

    require_once( PEDADIDA_PLUGIN_PATH . 'toolkit/smf_2_api.php');
    smfapi_login($user_login);

}
add_action('wp_login', 'smf_login', 10, 2);

?>