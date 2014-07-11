<?php

    require_once( PEDADIDA_PLUGIN_PATH . 'toolkit/SmfRestClient.php');
    
    /** Uses Secret Key #1 from Pedadida Config */
    require_once(ABSPATH . '/pedadida-config.php');
    
    $smf_api = new SmfRestClient($pedadida_key1);

    $smf_api->login_user($user_login);
    


?>