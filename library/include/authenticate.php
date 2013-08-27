<?php
# authenticate user based on cookie

//include "resource_functions.php";

$valid=true;
$autologgedout=false;
$nocookies=false;
$se_bypass=false;
$ip = ip2long($_SERVER["REMOTE_ADDR"]);
$ip_restrict_group="";
$ip_restrict_user="";
$registernow=false;
$session_hash = '';

 //ADD THIRD PARTY SO IT DOES NOT LOAD MOODLE OR WORDPRESS
$third_party = 1;
$my_user_id = 0;

define('WP_USE_THEMES', false);
require_once(__DIR__.'/../../wp-blog-header.php');

$current_user = wp_get_current_user(); 

if (($current_user->ID > 0) || isset($anonymous_login))
    {	    
     // PEDADIDA INTEGRATION ////////
		if($current_user->ID > 0)
		{
			
			 if($current_user->ID > 0){
			$my_user_id = $current_user->ID;
			$myname = $current_user->user_login;
			$password = $current_user->user_pass;
			
		
			 $res=$db->query("SELECT * FROM user WHERE username='$myname'");
				  if($res->num_rows == 1){	  
				  $userRow = $res->fetch_array(MYSQLI_ASSOC);
				  
					$username=$userRow['username'];
					$userref=$userRow['ref'];
					$password_hash=$userRow['password'];
					$session_hash=$userRow['session'];
					$usergroup=$userRow['usergroup'];
				}
			else {
				if(isset($myname))
				{					
			
			 if (1 == 1){
					$ref = $current_user->ID;
					$username=$current_user->user_login;
					$password=$current_user->user_pass;
					$password=md5("RS" . $username . $password);
					$fullname=$current_user->user_displayname;
					$email=$current_user->user_email;
					$usergroup=$current_user->user_role;
					$last_active="CURRENT_TIMESTAMP";
					$logged_in=1;
					$last_browser= $_SERVER['HTTP_USER_AGENT'];
					$last_ip=$_SERVER['REMOTE_ADDR'];
					$current_collection=2;
					$accepted_terms=1;
					$account_expires="NULL";
					$comments="NULL";
					$session="NULL";
					$ip_restrict="NULL";
					$password_last_change="0000-00-00 00:00:00";
					$login_tries=0;
					$login_last_try="NULL";
					$approved=1;
					$lang="en-us";
					$created="CURRENT_TIMESTAMP";
				
				
				// FIND OUT WHICH GROUP USER IS IN 
				if($usergroup == 9) // GENERAL
				$usergroup =2;
				if($usergroup == 3 && $username != "admin") // STAFF
				$usergroup =9;
				if($usergroup == 8) // BRONZE
				$usergroup =10;
				if($usergroup == 1) // SILVER
				$usergroup =11;
				if($usergroup == 10) // GOLD
				$usergroup =12;
				if($usergroup == 5) // INTERNS
				$usergroup =13;
				if($usergroup == 7) // PAST INTERNS
				$usergroup =14;
				if($usergroup == 6) // PENDING INTERNS
				$usergroup =15;
				
						
						$new_user = $db->query("INSERT INTO `user` (
				`ref` ,
				`username` ,
				`password` ,
				`fullname` ,
				`email` ,
				`usergroup` ,
				`last_active` ,
				`logged_in` ,
				`last_browser` ,
				`last_ip` ,
				`current_collection` ,
				`accepted_terms` ,
				`account_expires` ,
				`comments` ,
				`session` ,
				`ip_restrict` ,
				`password_last_change` ,
				`login_tries` ,
				`login_last_try` ,
				`approved` ,
				`lang` ,
				`created`
				)
				VALUES (
				$ref , '$username', '$password', '$fullname', '$email', '$usergroup', CURRENT_TIMESTAMP, '1', NULL, '$last_ip', '3', '$accepted_terms', NULL, '', '', '', '0', '0', CURRENT_TIMESTAMP, '$approved', '$lang' , CURRENT_TIMESTAMP )") or die(mysqli_error());



				$newref=sql_insert_id();
				
				# Create a collection for this user
				global $lang;
				$new=create_collection($newref,"My Collection",0,1);
				# set this to be the user's current collection
				$db->query("update user set current_collection='$new', password_last_change=CURRENT_TIMESTAMP where ref='$newref'");
	
		add_collection($newref,$new);
				
			$all_userdata="SELECT * FROM user WHERE ref='$newref'";
			$this_user_data = $db->query($all_userdata) or die(mysqli_error());
			 if (mysql_num_rows($this_user_data) == 1){
			while ($userRow = mysql_fetch_array($this_user_data)) {
					$username=$userRow['username'];
					$userref=$userRow['ref'];
					$password_hash=$userRow['password'];
					$session_hash=$userRow['session'];
				}
				
			}
			else
			$valid=0;
				}
		else
		$username=$anonymous_login;
		$session_hash="";
			//header("Location: edit_profile.php");
					
				  
			$registernow=true;
			}
			else
			$username=$anonymous_login;
			$session_hash="";
			//header("Location: user_editprofile.php");
			}
		}
		else{
			//setcookie ("auth_token", "", time() - 3600);
			$username=$anonymous_login;
		}
			$se_bypass=true;
			$allow=true;
		}
		else
		{
		$username=$anonymous_login;
		$session_hash="";
		$basic_simple_search=true; # Always use the basic simple search for anonymous users to save screen space (the login box will appear on the right hand side).
		}

	$hashsql="and u.session='$session_hash'";
	if (isset($anonymous_login) && ($username==$anonymous_login)) {$hashsql="";} # Automatic anonymous login, do not require session hash.
	
			if($registernow){
			  $res=$db->query("select u.ref, u.username, g.permissions, g.fixed_theme, g.parent, u.usergroup, u.current_collection, u.last_active, timestampdiff(second,u.last_active,now()) idle_seconds,u.email, u.password, u.fullname, g.search_filter, g.edit_filter, g.ip_restrict ip_restrict_group, g.name groupname, u.ip_restrict ip_restrict_user, resource_defaults, u.password_last_change,g.config_options,g.request_mode from user u,usergroup g where u.usergroup=g.ref and u.username='$username' $hashsql and u.approved=1 and (u.account_expires is null or u.account_expires='0000-00-00 00:00:00' or u.account_expires>now())");
				$userdata = $res->fetch_array(MYSQLI_ASSOC);
				}
	
		    $res=$db->query("select u.ref, u.username, g.permissions, g.fixed_theme, g.parent, u.usergroup, u.current_collection, u.last_active, timestampdiff(second,u.last_active,now()) idle_seconds,u.email, u.password, u.fullname, g.search_filter, g.edit_filter, g.ip_restrict ip_restrict_group, g.name groupname, u.ip_restrict ip_restrict_user, resource_defaults, u.password_last_change,g.config_options,g.request_mode from user u,usergroup g where u.usergroup=g.ref and u.username='$username' $hashsql and u.approved=1 and (u.account_expires is null or u.account_expires='0000-00-00 00:00:00' or u.account_expires>now())");
			$userdata = $res->fetch_array(MYSQLI_ASSOC);
			
    if (count($userdata)>0)
        {
		
        if($se_bypass)
        {   
   	    # Account expiry
        $expires=sql_value("select account_expires value from user where username='$username'","");
        if ($expires!="" && $expires!="0000-00-00 00:00:00" && strtotime($expires)<=time())
       		{
       		$valid=0;$error=$lang["accountexpired"];
       		}
       else
       		{
		 	$expires=0;
        	if (getval("remember","")!="") {$expires=time()+(3600*24*100);} # remember login for 100 days

			
			# Store language cookie
			setcookie("language",getval("language",""),time()+(3600*24*1000));
			setcookie("language",getval("language",""),time()+(3600*24*1000),$baseurl_short . "pages/");
			
			# Update the user record. Set the password hash again in case a plain text password was provided.
			//$db->query("update user set password='$password_hash',session='$session_hash',last_active=now(),login_tries=0,lang='".getval("language","")."' where username='$username' and (password='$password' or password='$password_hash')");

			# Log this
			if($username!=$anonymous_login)
			daily_stat("User session",$userref);
			//resource_log(0,'l',0);
			
			# Blank the IP address lockout counter for this IP
			$db->query("delete from ip_lockout where ip='" . escape_check($ip) . "'");

			# Set the session cookie.
	        setcookie("user",$username . "|" . $session_hash,$expires);
	        
	        # Set default resource types
	        setcookie("restypes",$default_res_types);
			
	        }
				}
        $valid=true;
        $userref=$userdata["ref"];
        $username=$userdata["username"];
		
		# Hook to modify user permissions
		if (hook("userpermissions")){$userdata["permissions"]=hook("userpermissions");} 
		
		# Create userpermissions array for checkperm() function
		$userpermissions=array_merge(explode(",",trim($global_permissions)),explode(",",trim($userdata["permissions"]))); 
	
		$usergroup=$userdata["usergroup"];
		$usergroupname=$userdata["groupname"];
        $usergroupparent=$userdata["parent"];
        $useremail=$userdata["email"];
        $userpassword=$userdata["password"];
        $userfullname=$userdata["fullname"];
		if (!isset($userfixedtheme)) {$userfixedtheme=$userdata["fixed_theme"];} # only set if not set in config.php
				
        $ip_restrict_group=trim($userdata["ip_restrict_group"]);
        $ip_restrict_user=trim($userdata["ip_restrict_user"]);
        
        $usercollection=$userdata["current_collection"];
        $usersearchfilter=$userdata["search_filter"];
        $usereditfilter=$userdata["edit_filter"];
        $userresourcedefaults=$userdata["resource_defaults"];
        $userrequestmode=trim($userdata["request_mode"]);
        
        # Apply config override options
        $config_options=trim($userdata["config_options"]);
        if ($config_options!="") {eval($config_options);}
        
       
        if ($password_expiry>0 && !checkperm("p") && $allow_password_change && $pagename!="change_password" && $pagename!="index" && $pagename!="collections" && strlen(trim($userdata["password_last_change"]))>0)
        	{
        	# Redirect the user to the password change page if their password has expired.
	        $last_password_change=time()-strtotime($userdata["password_last_change"]);
			if ($last_password_change>($password_expiry*60*60*24))
				{
				redirect("pages/change_password.php?expired=true");
				}
        	}
        
        if (strlen(trim($userdata["last_active"]))>0)
        	{
	        if ($userdata["idle_seconds"]>($session_length*60))
	        	{
          	    # Last active more than $session_length mins ago?
				$al="";if (isset($anonymous_login)) {$al=$anonymous_login;}
				
				if ($session_autologout && $username!=$al) # If auto logout enabled, but this is not the anonymous user, log them out.
					{
					# Reached the end of valid session time, auto log out the user.
					
					# Remove session
					$db->query("update user set logged_in=0,session='' where ref='$userref'");
			
					# Blank cookie / var
					setcookie("user","",0);
					unset($username);
		
					if (isset($anonymous_login))
						{
						# If the system is set up with anonymous access, redirect to the home page after logging out.
						redirect("pages/home.php");
						}
					else
						{
						$valid=false;
						$autologgedout=true;
						}
					}
				else
	        		{
		        	# Session end reached, but the user may still remain logged in.
			        # This is a new 'session' for the purposes of statistics.
					daily_stat("User session",$userref);
					}
				}
			}
        }
        else {$valid=false;}
    }
else
    {
    $valid=false;
    $nocookies=true;
    
    # Set a cookie that we'll check for again on the login page after the redirection.
    # If this cookie is missing, it's assumed that cookies are switched off or blocked and a warning message is displayed.
    setcookie("cookiecheck","true");
    }
  
if (!$valid)
    {
	$_SERVER['REQUEST_URI'] = ( isset($_SERVER['REQUEST_URI']) ?
	$_SERVER['REQUEST_URI'] : $_SERVER['SCRIPT_NAME'] . (( isset($_SERVER
	['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '')));
    $path=$_SERVER["REQUEST_URI"];
	$userref=1;
    }

# Handle IP address restrictions
$ip=get_ip();
$ip_restrict=$ip_restrict_group;
if ($ip_restrict_user!="") {$ip_restrict=$ip_restrict_user;} # User IP restriction overrides the group-wide setting.
if ($ip_restrict!="")
	{
	# Allow multiple IP addresses to be entered, comma separated.
	$i=explode(",",$ip_restrict);
	
	if (!$se_bypass) $allow=false;

	# Loop through all provided ranges
	for ($n=0;$n<count($i);$n++)
		{
		$ip_restrict=trim($i[$n]);
		
		# Match against the IP restriction.
		$wildcard=strpos($ip_restrict,"*");

		if ($wildcard!==false)
			{
			# Wildcard
			if (substr($ip,0,$wildcard)==substr($ip_restrict,0,$wildcard)) {$allow=true;}
			}
		else
			{
			# No wildcard, straight match
			if ($ip==$ip_restrict) {$allow=true;}
			}
		}
		
	
	if (!$allow)
		{
		header("Location: ". network_site_url()."/library");
		exit("You do not have permission to access  that area.");
		} 
	}

#update activity table
global $pagename;
$terms="";if (($pagename!="login") && ($pagename!="terms")) {$terms=",accepted_terms=1";} # Accepted terms
$db->query("update user set last_active=now(),logged_in=1,last_ip='" . get_ip() . "',last_browser='" . $db->real_escape_string(substr($_SERVER["HTTP_USER_AGENT"],0,250)) . "'$terms where ref='$userref'");
/* if(isset($my_user_id))
$db->query("UPDATE wp_users SET user_lastactive = '".time()."' WHERE ID = '". $db->real_escape_string($my_user_id)."'");
*/
# Add group specific text (if any) when logged in.
if (hook("replacesitetextloader"))
	{
	# this hook expects $site_text to be modified and returned by the plugin	 
	$site_text=hook("replacesitetextloader");
	}
else
	{
	if (isset($usergroup))
		{
		$res=$db->query("select language,name,text from site_text where (page='$pagename' or page='all') and specific_to_group='$usergroup'");
		$results = $res->fetch_array(MYSQLI_ASSOC);
		for ($n=0;$n<count($results);$n++) {$site_text[$results[$n]["language"] . "-" . $results[$n]["name"]]=$results[$n]["text"];}
		}
	}	/* end replacesitetextloader */

# Load group specific plugins
$active_plugins = ($db->query("SELECT name,enabled_groups FROM plugins WHERE inst_version>=0 AND length(enabled_groups)>0"));
foreach($active_plugins as $plugin)
	{
	# Check group access, only enable for global access at this point
	$s=explode(",",$plugin['enabled_groups']);
	if (in_array($usergroup,$s))
		{
		register_plugin($plugin['name']);
		}
	}


?>
