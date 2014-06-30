/* This area adds the required fields to the login form so we can login to all needed locatons.
Total List
first name
last name
email 
user name
password 
*/

 //1. Add a new form element...
    add_action('register_form','pedadida_register_form');
    function pedadida_register_form (){
		$first_name = ( isset( $_POST['first_name'] ) ) ? $_POST['first_name']: '';
		$last_name = ( isset( $_POST['last_name'] ) ) ? $_POST['last_name']: '';
		?>
        <p>
            <label for="first_name"><?php _e('First Name','pedadida') ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(stripslashes($first_name)); ?>" size="25" /></label>
        </p>
		<p>
            <label for="last_name"><?php _e('Last Name','pedadida') ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(stripslashes($last_name)); ?>" size="25" /></label>
        </p>
		        <?php
    }
//2. Add validation. In this case, we make sure first_name & last_name are required.
    add_filter('registration_errors', 'pedadida_registration_errors', 10, 3);
    function pedadida_registration_errors ($errors, $sanitized_user_login, $user_email) {
if ( empty( $_POST['first_name'] ) )
            $errors->add( 'first_name_error', __('<strong>ERROR</strong>: You must include a first name.','pedadida') );
if ( empty( $_POST['last_name'] ) )
            $errors->add( 'last_name_error', __('<strong>ERROR</strong>: You must include a last name.','pedadida') );
return $errors;
    }
//3. Finally, save our extra registration user meta.
    add_action('user_register', 'pedadida_user_register');
    function pedadida_user_register ($user_id) {
	if ( isset( $_POST['first_name'] ) )
            update_user_meta($user_id, 'first_name', $_POST['first_name']);
	if ( isset( $_POST['last_name'] ) )
            update_user_meta($user_id, 'last_name', $_POST['last_name']);
    }
