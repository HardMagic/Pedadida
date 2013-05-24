<?php
/**
 * Displays the header section of the theme.
 *
 * @package Theme Horse
 * @subpackage Attitude
 * @since Attitude 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<script>
<!--
$('div.ui-page').live("swipeleft", function(){
var nextpage = $(this).next('div[data-role="page"]');
if (nextpage.length > 0) {
$.mobile.changePage(nextpage, "slide", false, true);
}
});
$('div.ui-page').live("swiperight", function(){
var prevpage = $(this).prev('div[data-role="page"]');
if (prevpage.length > 0) {
$.mobile.changePage(prevpage, {transition: "slide",
reverse: true}, true, true);
}
});
// -->
</script>

	<?php		
		/** 
		 * attitude_title hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * attitude_add_meta 5
		 * attitude_show_title 10
		 *
		 */
		do_action( 'attitude_title' );

		/** 
		 * attitude_meta hook
		 */
		do_action( 'attitude_meta' );

		/** 
		 * attitude_links hook
		 *
		 * HOOKED_FUNCTION_NAME PRIORITY
		 *
		 * attitude_add_links 10
		 * attitude_favicon 15
		 * attitude_webpageicon 20
		 *
		 */
		do_action( 'attitude_links' );

		/** 
		 * This hook is important for wordpress plugins and other many things
		 */
		wp_head();
	?>
	


</head>

<body <?php body_class(); ?>>


	<?php
		/** 
		 * attitude_before hook
		 */
		do_action( 'attitude_before' );
	?>

	<div class="wrapper" data-role="page" data-theme="c">
	
    <div data-role="panel" id="leftpanel" class="slogan" data-position="left" data-display="reveal">
        <ul data-role="listview" data-theme="c" data-divider-theme="c" data-icon="true" data-global-nav="demos" class="jqm-list">
            <li data-role="list-divider">jQuery Mobile Demos</li>
			<li><a href="./">Home</a></li>
            <li><a href="intro/">Introduction</a></li>
            <li><a href="examples/">Demo Showcase</a></li>
            <li><a href="faq/">Questions & Answers</a></li>
			<li><a href="intro/rwd.html">Going Responsive</a></li>
            <li data-role="list-divider">Widget reference</li>
<li data-section="Widgets" data-filtertext="accordions collapsible sets content formatting grouped inset mini"><a href="widgets/accordions/">Accordion</a></li>

<li data-section="Widgets" data-filtertext="ajax navigation navigate event method"><a href="widgets/navigation/" data-ajax="false">AJAX Navigation</a></li>

<li data-section="Widgets" data-filtertext="autocomplete filter reveal listviews remote listviewbeforefilter placeholder"><a href="widgets/autocomplete/" data-ajax="false">Autocomplete</a></li>

<li data-section="Widgets" data-filtertext="buttons inputs forms inline theme grouped icons mini disabled"><a href="widgets/buttons/" data-ajax="false">Buttons</a></li>

<li data-section="Widgets" data-filtertext="checkboxes checkboxradio inputs forms mini disabled"><a href="widgets/checkbox/">Checkboxes</a></li>

<li data-section="Widgets" data-filtertext="collapsibles content formatting"><a href="widgets/collapsibles/" data-ajax="false">Collapsibles</a></li>

<li data-section="Widgets" data-filtertext="controlgroups selects checkboxradio buttons horizontal vertical"><a href="widgets/controlgroups/">Controlgroup</a></li>

<li data-section="Widgets" data-filtertext="dialogs modal popups"><a href="widgets/dialog/">Dialogs</a></li>

<li data-section="Widgets" data-filtertext="fixed toolbars headers footers sections fullscreen"><a href="widgets/fixed-toolbars/">Fixed toolbars</a></li>

<li data-section="Widgets" data-filtertext="flip toggle switch binary slider selects forms disabled"><a href="widgets/sliders/switch.html" data-ajax="false">Flip switch toggle</a></li>

<li data-section="Widgets" data-filtertext="footer toolbars footers sections"><a href="widgets/footers/">Footer toolbar</a></li>

<li data-section="Widgets" data-filtertext="forms inputs slider button range toggle switch label disabled accessible fieldcontains elements"><a href="widgets/forms/">Form elements</a></li>

<li data-section="Widgets" data-filtertext="grids columns blocks content formatting rwd responsive"><a href="widgets/grids/">Grids</a></li>

<li data-section="Widgets" data-filtertext="header toolbars fixed fullscreen sections"><a href="widgets/headers/">Header toolbar</a></li>

<li data-section="Widgets" data-filtertext="icons buttons disc position"><a href="widgets/icons/">Icons</a></li>

<li data-section="Widgets" data-filtertext="links navigation ajax prefetch cache"><a href="widgets/links/">Links</a></li>

<li data-section="Widgets" data-filtertext="listviews thumbnails icons nested split button collapsible ul ol"><a href="widgets/listviews/" data-ajax="false">Listviews</a></li>

<li data-section="Widgets" data-filtertext="ajax loader overlay spinner pages"><a href="widgets/loader/" data-ajax="false">Loader overlay</a></li>

<li data-section="Widgets" data-filtertext="navbars navmenu toolbars links icons footer header"><a href="widgets/navbar/" data-ajax="false">Navbar</a></li>

<li data-section="Widgets" data-filtertext="navbars persistent header footer links navmenu"><a href="widgets/fixed-toolbars/footer-persist-a.html">Navbar, persistent</a></li>

<li data-section="Widgets" data-filtertext="pages single multipage templates ajax nav"><a href="widgets/pages/">Pages</a></li>

<li data-section="Widgets" data-filtertext="panels sliding nav modal transition display reveal overlay push rwd responsive"><a href="widgets/panels/">Panels <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="popup dialog modal transition tooltip lightbox form overlay screen flip pop fade transition"><a href="widgets/popup/">Popup</a></li>

<li data-section="Widgets" data-filtertext="radiobuttons checkboxradio inputs forms disabled grouped"><a href="widgets/radiobuttons/">Radio buttons</a></li>

<li data-section="Widgets" data-filtertext="selectmenus custom native multiple optgroup disabled forms"><a href="widgets/selects/">Select</a></li>

<li data-section="Widgets" data-filtertext="slider, single sliders range inputs forms disabled"><a href="widgets/sliders/" data-ajax="false">Slider, single</a></li>

<li data-section="Widgets" data-filtertext="slider, dual range sliders rangesliders inputs forms disabled"><a href="widgets/sliders/rangeslider.html" data-ajax="false">Slider, dual range <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="tables column th td toggle responsive tables rwd hide show tabular"><a href="widgets/table-column-toggle/">Table, column toggle <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="tables reflow th td responsive rwd columns tabular"><a href="widgets/table-reflow/">Table, reflow <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="text inputs textarea numeric email tel file date time month clear pattern placeholder forms"><a href="widgets/textinputs/">Text inputs & textarea</a></li>

<li data-section="Widgets" data-filtertext="page transitions animated pages ajax navigation flip slide fade pop" data-ajax="false"><a href="widgets/transitions/" data-ajax="false">Transitions</a></li>

        </ul>
	</div><!-- /panel -->
	
 <div data-role="panel" id="rightpanel" class="slogan" data-position="right" data-display="reveal">
        <ul data-role="listview" data-theme="c" data-divider-theme="c" data-icon="true" data-global-nav="demos" class="jqm-list">
            <li data-role="list-divider">Pedadida Menu</li>
			<li><a href="./">Home</a></li>
            <li><a href="intro/">Introduction</a></li>
            <li><a href="examples/">Demo Showcase</a></li>
            <li><a href="faq/">Questions & Answers</a></li>
			<li><a href="intro/rwd.html">Going Responsive</a></li>
            <li data-role="list-divider">Widget reference</li>
<li data-section="Widgets" data-filtertext="accordions collapsible sets content formatting grouped inset mini"><a href="widgets/accordions/">Accordion</a></li>

<li data-section="Widgets" data-filtertext="ajax navigation navigate event method"><a href="widgets/navigation/" data-ajax="false">AJAX Navigation</a></li>

<li data-section="Widgets" data-filtertext="autocomplete filter reveal listviews remote listviewbeforefilter placeholder"><a href="widgets/autocomplete/" data-ajax="false">Autocomplete</a></li>

<li data-section="Widgets" data-filtertext="buttons inputs forms inline theme grouped icons mini disabled"><a href="widgets/buttons/" data-ajax="false">Buttons</a></li>

<li data-section="Widgets" data-filtertext="checkboxes checkboxradio inputs forms mini disabled"><a href="widgets/checkbox/">Checkboxes</a></li>

<li data-section="Widgets" data-filtertext="collapsibles content formatting"><a href="widgets/collapsibles/" data-ajax="false">Collapsibles</a></li>

<li data-section="Widgets" data-filtertext="controlgroups selects checkboxradio buttons horizontal vertical"><a href="widgets/controlgroups/">Controlgroup</a></li>

<li data-section="Widgets" data-filtertext="dialogs modal popups"><a href="widgets/dialog/">Dialogs</a></li>

<li data-section="Widgets" data-filtertext="fixed toolbars headers footers sections fullscreen"><a href="widgets/fixed-toolbars/">Fixed toolbars</a></li>

<li data-section="Widgets" data-filtertext="flip toggle switch binary slider selects forms disabled"><a href="widgets/sliders/switch.html" data-ajax="false">Flip switch toggle</a></li>

<li data-section="Widgets" data-filtertext="footer toolbars footers sections"><a href="widgets/footers/">Footer toolbar</a></li>

<li data-section="Widgets" data-filtertext="forms inputs slider button range toggle switch label disabled accessible fieldcontains elements"><a href="widgets/forms/">Form elements</a></li>

<li data-section="Widgets" data-filtertext="grids columns blocks content formatting rwd responsive"><a href="widgets/grids/">Grids</a></li>

<li data-section="Widgets" data-filtertext="header toolbars fixed fullscreen sections"><a href="widgets/headers/">Header toolbar</a></li>

<li data-section="Widgets" data-filtertext="icons buttons disc position"><a href="widgets/icons/">Icons</a></li>

<li data-section="Widgets" data-filtertext="links navigation ajax prefetch cache"><a href="widgets/links/">Links</a></li>

<li data-section="Widgets" data-filtertext="listviews thumbnails icons nested split button collapsible ul ol"><a href="widgets/listviews/" data-ajax="false">Listviews</a></li>

<li data-section="Widgets" data-filtertext="ajax loader overlay spinner pages"><a href="widgets/loader/" data-ajax="false">Loader overlay</a></li>

<li data-section="Widgets" data-filtertext="navbars navmenu toolbars links icons footer header"><a href="widgets/navbar/" data-ajax="false">Navbar</a></li>

<li data-section="Widgets" data-filtertext="navbars persistent header footer links navmenu"><a href="widgets/fixed-toolbars/footer-persist-a.html">Navbar, persistent</a></li>

<li data-section="Widgets" data-filtertext="pages single multipage templates ajax nav"><a href="widgets/pages/">Pages</a></li>

<li data-section="Widgets" data-filtertext="panels sliding nav modal transition display reveal overlay push rwd responsive"><a href="widgets/panels/">Panels <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="popup dialog modal transition tooltip lightbox form overlay screen flip pop fade transition"><a href="widgets/popup/">Popup</a></li>

<li data-section="Widgets" data-filtertext="radiobuttons checkboxradio inputs forms disabled grouped"><a href="widgets/radiobuttons/">Radio buttons</a></li>

<li data-section="Widgets" data-filtertext="selectmenus custom native multiple optgroup disabled forms"><a href="widgets/selects/">Select</a></li>

<li data-section="Widgets" data-filtertext="slider, single sliders range inputs forms disabled"><a href="widgets/sliders/" data-ajax="false">Slider, single</a></li>

<li data-section="Widgets" data-filtertext="slider, dual range sliders rangesliders inputs forms disabled"><a href="widgets/sliders/rangeslider.html" data-ajax="false">Slider, dual range <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="tables column th td toggle responsive tables rwd hide show tabular"><a href="widgets/table-column-toggle/">Table, column toggle <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="tables reflow th td responsive rwd columns tabular"><a href="widgets/table-reflow/">Table, reflow <span class="ui-li-count">New</span></a></li>

<li data-section="Widgets" data-filtertext="text inputs textarea numeric email tel file date time month clear pattern placeholder forms"><a href="widgets/textinputs/">Text inputs & textarea</a></li>

<li data-section="Widgets" data-filtertext="page transitions animated pages ajax navigation flip slide fade pop" data-ajax="false"><a href="widgets/transitions/" data-ajax="false">Transitions</a></li>

        </ul>
	</div><!-- /panel -->


		<?php
			/** 
			 * attitude_before_header hook
			 */
			do_action( 'attitude_before_header' );
		?>
		<header id="branding"  data-role="header">
			<?php
				/** 
				 * attitude_header hook
				 *
				 * HOOKED_FUNCTION_NAME PRIORITY
				 *
				 * attitude_headerdetails 10
				 */
				do_action( 'attitude_header' );
			?>
		</header>
		<?php
			/** 
			 * attitude_after_header hook
			 */
			do_action( 'attitude_after_header' );
		?>

		<?php
			/** 
			 * attitude_before_main hook
			 */
			do_action( 'attitude_before_main' );
		?>
		<div id="main" data-role="content" class="container clearfix">