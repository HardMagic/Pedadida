<?php
require_once ($CFG->dirroot."/theme/moodle2tablet/lib.php");

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
}

if (!empty($PAGE->theme->settings->footnote)) {
    $footnote = $PAGE->theme->settings->footnote;
} else {
    $footnote = '<!-- There was no custom footnote set -->';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <script type='text/javascript'>

var GORDA = {};

</script>

<?php echo $OUTPUT->standard_head_html() ?>

<?php if ($PAGE->bodyid=="page-mod-forum-post") { ?>
<style type="text/css">
html, body {background:#333;}
#gorda-header, #popovers-container, .navbar, .footer, .forumpost, .forumthread, .ftoggler{display:none;}
#iscroll-wrapper{top:0px;}
.generalbox {margin:5%;}
.mform fieldset{border-width: 0;}
span.backpost {
	float:right;
	max-width:15px;
	height:15px;
	background-color: #000;
	padding: 1px 5px;
	-webkit-box-shadow: 0 0 3px 3px#888;
	box-shadow: 0 0 3px 3px #888;
	border: 1px solid #fff;
}
span.backpost a{ color: #fff; }
</style>

<?php } ?>

<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' /> 
<meta name='apple-mobile-web-app-status-bar-style' content='default' /> 
<meta name='apple-mobile-web-app-capable' content='yes' /> 
 
<link rel='apple-touch-icon' href='<?php echo $OUTPUT->pix_url('ipad_bookmark_icon', 'theme')?>' />
	
</head>

<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)); echo ' '.$PAGE->theme->settings->choicestyle;?>">
<?php echo $OUTPUT->standard_top_of_body_html(); 
global $DB; 
$instancia = $DB->get_fieldset_select('block_instances', 'id', 'blockname = \'navigation\' or blockname = \'settings\''); 
 
$topsettings = $this->page->get_renderer('theme_moodle2tablet','topsettings'); // get rederer ------------------------------------------------------------------------
?>
	
 <!-- All the iPad menubar code goes here -->
<div id="gorda-header" class="light-gradient">
	<div class="head-left">
    		
			<div class="menubar-button button" id="hidestuff" onClick="classicUpdateOrientation('hide');"><p class="hidenav-icon"></p></div>
            <div class="menubar-button button" id="showstuff" onClick="classicUpdateOrientation('show');"><p class="shownav-icon"></p></div>
        	<div class="menubar-button" id="home"><a href="<?php echo $CFG->wwwroot; ?>"><span class="home-icon">&nbsp;</span></a></div>
			<div class="menubar-button" id="block"><p class="blocks-icon"></p></div>
           
           <div class="menubar-button" id="account"><p class="account-icon"></p></div>
            
		</div>	

	<div class="head-center">
    
             <?php if ($hasheading) { ?>
		    	<h1><?php echo $PAGE->heading ?></h1>
    		  
	        <?php } ?> 
		 
	</div>
	
	<div class="head-right">
    	<div id="quiz-timer" class="button" > <span id="quiz-time-left"></span></div>
    	<div class="menubar-button button" id="search"><p class="search-icon"></p></div>
	</div>
</div>		


<div id="popovers-container">
<!-- Page Menu Popover -->
			<div id="pop-menu" class="popover">
			<header>
				<h1><?php p(get_string('navigation')); ?></h1>
			</header>			
			<div class="pop-inner">
			<div id="pages-wrapper" class="iscroller">
					<div id="pages-iscroll">
					<div id="inst<?php echo $instancia[0]; ?>" class="block_navigation pop-navi">
                    <div class="content">
                    <?php 
			
		if( $this->page->pagelayout != 'maintenance' // Don't show sideMenu if site is being upgraded
            && !(get_user_preferences('auth_forcepasswordchange') && !session_is_loggedinas()) // Don't show it when forcibly changing password either
          ) {
			  
			 
            echo $OUTPUT->blocks_for_nav('side-pre'); echo $OUTPUT->blocks_for_nav('side-post');
            
        }
						
						?>
                    
                     </div></div>
                     <?php echo $custommenu; 
					 //echo "<br><br><br><br>";
					 ?>
                     </div>
                     </div>
			</div>
			<p class="menu-pointer-arrow">&nbsp;</p>
		</div>
	 
<!-- block Popover -->
	<div id="pop-block" class="popover popover-lists">
    <header>
    <ul class="menu-tabs">
    	<?php echo $OUTPUT->blocks_for_head('side-pre'); echo $OUTPUT->blocks_for_head('side-post'); ?>
    </ul>
    </header>
		<?php echo $OUTPUT->blocks_for_content('side-pre'); echo $OUTPUT->blocks_for_content('side-post'); ?>
	<p class="menu-pointer-arrow">&nbsp;</p>
	</div>
	 
<!-- Account Popover -->
    
		<div id="pop-account" class="popover popover-lists">
		<header>
        <ul class="menu-tabs2">
        
				<li><a href="#" rel="#classicLogin"><?php p(get_string('login')); ?></a></li>
                <li><a href="#" rel="#classicSettings"><?php p(get_string('settings')); ?></a></li>
                <li><a href="#" rel="#classicMessages"><?php p(get_string('messages','message')); ?></a></li>
		</ul>
        </header>
       
        <div id="classicLogin" class="tabbed pop-inner">
				
					<?php
        			
        				if (isloggedin())
        				{
        					echo ''.$OUTPUT->user_picture($USER, array('size'=>55)).'';
							echo $OUTPUT->login_info();
        				}
        				else {
        					?>
						
                    <form name="loginform" id="loginform" action="<?php echo $CFG->wwwroot .'/login/index.php' ?>" method="post">
					<div>
						<input placeholder="Username" type="text" autocapitalize="off" name="username" id="username" value="" tabindex="5" />
					</div>
					<div>
						<input placeholder="Password" autocapitalize="off" autocomplete="off" type="password" name="password"  id="password" value="" tabindex="6" />
						<input type="hidden" name="rememberme" checked="yes" value="forever"/>
					</div>
					<div>
						<input type="submit" value="<?php p(get_string('login')); ?>" id="loginbtn" class="button" tabindex="7" />					
					</div>
						
					</form>
                    <?php
        				}
        		echo $OUTPUT->lang_menu();
	        	echo $PAGE->headingmenu;
        			?>
			
		</div>
       <div id="classicSettings" class="tabbed pop-inner">
       <div id="pages-wrapper2" class="iscroller">
					<div id="pages-iscroll">
					<div id="inst<?php echo $instancia[1]; ?>" class="block_settings">
                    <div class="content">
                    <?php 
					
			
		if( $this->page->pagelayout != 'maintenance' // Don't show sideMenu if site is being upgraded
            && !(get_user_preferences('auth_forcepasswordchange') && !session_is_loggedinas()) // Don't show it when forcibly changing password either
          ) {
			  
            echo $OUTPUT->blocks_for_sett('side-pre'); echo $OUTPUT->blocks_for_sett('side-post');
            
        }
						
						?>
                    
                     </div></div>
                    <?php 
					echo $topsettings->settings_search_box();
					?>
                   
                     </div>
				</div>
       </div>
       
       <div id="classicMessages" class="tabbed pop-inner2">
       <div id="pages-wrapper3" class="iscroller">
					<div id="pages-iscroll">
					<div id="inst92" class="block_messages">
                    <div class="content">
                    <?php 
					
		if (isloggedin()){
			$headerMsj = $OUTPUT->blocks_for_msjs('side-pre');
			$contenMsj = $OUTPUT->blocks_for_msjs('side-post');
			if ($headerMsj=="" && $contenMsj=="")
		 	echo 'You have to add a message block';	
			else
			echo $headerMsj; echo $contenMsj;
		
		   	echo '</br><a href="'.$CFG->wwwroot .'/message/index.php">'.get_string('gotomessages','message').' </a>';
        }
						
					?>
                    
                    
                     </div></div>
                   
                   </div>
				</div>
       </div>
       
		<p class="menu-pointer-arrow">&nbsp;</p>
	</div>

<!-- Search Popover -->
			<div id="pop-search" class="popover">
			<header>
				<h1><?php p(get_string('searchforums', 'forum')); ?></h1>
			</header>			
			<div class="pop-inner">
				<div id="search-bar">
					<div id="gorda-search-inner">
						<form id="searchform" action="<?php echo $CFG->wwwroot .'/mod/forum/search.php' ?>">
                        	<input name="id" type="hidden" value="<?php echo $this->page->course->id;?>">
							<input placeholder="<?php p(get_string('search', 'forum')); ?>" type="text" name="search" id="searchform_search" tabindex="8" />
							<input name="submit" type="hidden" id="searchform_button" class="button" tabindex="9" />
                      <a href="<?php echo $CFG->wwwroot .'/mod/forum/search.php?id='.$this->page->course->id ?>"><?php p(get_string('advancedsearch', 'forum')); ?></a>
						</form>
                        
					</div>		
				</div>
			</div>
			<p class="menu-pointer-arrow">&nbsp;</p>
		</div>
	
</div><!-- #popovers-container -->


<!-- The Landscape Sidebar ( menu is dynamically attatched here by js ) -->
					<div id="main-menu"> </div>
		
		
		<!-- Main content -->
			<div id="iscroll-wrapper" class="iscroller">
			<div id="iscroll-content">
          
         
          
      <?php if ($hasnavbar) { ?>
	    
    	    <?php echo "<div class='navbar'>".$OUTPUT->navbar()."</div>"; ?>
            
        
    <?php } ?>
    
  <div id="page-content">
		<div class="generalbox">
			
        <?php echo method_exists($OUTPUT, "main_content")?$OUTPUT->main_content():core_renderer::MAIN_CONTENT_TOKEN ?>
			
		</div>
                
		
	</div><!-- #page-content -->

	<div class="footer">
		<?php
		echo $footnote;
        echo $OUTPUT->standard_footer_html();
        ?>
    	</div>
	
	

	</div><!-- iscroll content -->
	</div><!-- iscroll wrapper -->

<?php echo $OUTPUT->standard_end_of_body_html() ?>

</body>
</html>