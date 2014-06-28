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




// LOGIN FORM CUSTOMIZATION INCLUDED
require_once('registration_form.php');

    // REGISTERING AREA
	
			//THIS IS THE AREA FOR WP CREATE ACCOUNT HOOK
	add_action('user_register', 'pedadida_bridges_create');
    function pedadida_bridges_create ($user_id) {
    
			//THIS IS THE AREA FOR MOODLE HOOK

			//THIS IS THE AREA FOR RESOURCESPACE HOOK

			//THIS IS THE AREA FOR SMF FORUM HOOOK

			//THIS IS THE AREA FOR FENGOFFICE HOOK

			//THIS IS THE AREA FOR SOCIAL ENGINE
    
		//THIS IS THE AREA TO SEND THE WELCOME MESSAGE
    }
    
			//DO THEY NEED A CREDIT CARD
				//THIS IS THE AREA IF THEY HAVE A CREDIT CARD
				
				//THIS IS THE AREA IF THEY DO NOT HAVE A CREDIT CARD
				
				
	//LOGGING IN AREA
			//IF THEY ARE NOT LOGGED IN
			add_action('wp_login', 'pedadida_logins');
			function pedadida_logins() {

				//THIS IS THE AREA FOR THE WP LOGIN HOOK

				//THIS IS THE AREA FOR MOODLE HOOK

				//THIS IS THE AREA FOR RESOURCESPACE HOOK

				//THIS IS THE AREA FOR SMF FORUM HOOOK

				//THIS IS THE AREA FOR FENGOFFICE HOOK

				//THIS IS THE AREA FOR SOCIAL ENGINE
			       
            }
			//IF THEY ARE LOGGED IN
				//DO THEY NEED A CREDIT CARD
				   require_once('credit_card.php');

					//THIS IS THE AREA IF THEY HAVE A CREDIT CARD
					
					//THIS IS THE AREA IF THEY DO NOT HAVE A CREDIT CARD



    
				
