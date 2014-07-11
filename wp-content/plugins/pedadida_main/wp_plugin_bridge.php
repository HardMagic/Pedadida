<?php
/**
 * Plugin Name: Pedadida Single SignOn
 * Plugin URI: http://pedadida.com/ssi
 * Description: Single Sign On for Pedadida.
 * Version: 1.0
 * Author: Krashnik
 * Author URI: http://modelmatt.com
 * License: GPL2
 */

/*  Copyright 2014 Krashnik (email : info@hardmagic.com)
This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// MAKE PLUGIN PATHS CONSTANT
define( 'PEDADIDA_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PEDADIDA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


    // REGISTERING AREA
        // REGISTRATION FORM CUSTOMIZATION
        require_once( PEDADIDA_PLUGIN_PATH . 'register/registration_form.php');

		//THIS IS THE AREA FOR WP CREATE ACCOUNT HOOK
	    add_action('user_register', 'pedadida_bridges_create');
        function pedadida_bridges_create ($user_id) {
            
            $info = get_userdata( $user_id );
    
			//THIS IS THE AREA FOR MOODLE HOOK
            require_once( PEDADIDA_PLUGIN_PATH . 'register/bridges/moodle.php');
			//THIS IS THE AREA FOR RESOURCESPACE HOOK
            require_once( PEDADIDA_PLUGIN_PATH . 'register/bridges/resourcespace.php');
			//THIS IS THE AREA FOR SMF FORUM HOOOK
            require_once( PEDADIDA_PLUGIN_PATH . 'register/bridges/smf.php');
			//THIS IS THE AREA FOR FENGOFFICE HOOK
            require_once( PEDADIDA_PLUGIN_PATH . 'register/bridges/fengoffice.php');
			//THIS IS THE AREA FOR SOCIAL ENGINE
            require_once( PEDADIDA_PLUGIN_PATH . 'register/bridges/socialengine3.php');
		//THIS IS THE AREA TO SEND THE WELCOME MESSAGE
        }
    
			//DO THEY NEED A CREDIT CARD
				//THIS IS THE AREA IF THEY HAVE A CREDIT CARD
				
				//THIS IS THE AREA IF THEY DO NOT HAVE A CREDIT CARD
				
				
	//LOGIN AREA
		//IF THEY ARE NOT LOGGED IN
		add_action('wp_login', 'pedadida_logins', 10, 2);
		
		function pedadida_logins($user_login, $user) {

		//THIS IS THE AREA FOR MOODLE HOOK
        require_once( PEDADIDA_PLUGIN_PATH . 'login/bridges/moodle.php');
		//THIS IS THE AREA FOR RESOURCESPACE HOOK
        require_once( PEDADIDA_PLUGIN_PATH . 'login/bridges/resourcespace.php');
		//THIS IS THE AREA FOR SMF FORUM HOOOK
        require_once( PEDADIDA_PLUGIN_PATH . 'login/bridges/smf.php');
		//THIS IS THE AREA FOR FENGOFFICE HOOK
        require_once( PEDADIDA_PLUGIN_PATH . 'login/bridges/fengoffice.php');
		//THIS IS THE AREA FOR SOCIAL ENGINE
        require_once( PEDADIDA_PLUGIN_PATH . 'login/bridges/socialengine3.php');
		       
        }
		//IF THEY ARE LOGGED IN
		
			//DO THEY NEED A CREDIT CARD
			   require_once( PEDADIDA_PLUGIN_PATH . 'credit_card.php');

				//THIS IS THE AREA IF THEY HAVE A CREDIT CARD
				
				//THIS IS THE AREA IF THEY DO NOT HAVE A CREDIT CARD



    
				
