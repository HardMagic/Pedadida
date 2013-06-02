/* Description: JavaScript for moodle2mobile */
/* Required jQuery version: 1.6+ */

var touchJS = jQuery.noConflict();
var GORDAWebApp = navigator.standalone;
var iOS5 = (navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/iPhone|iPad|iPod/i) || navigator.userAgent.match(/IEMobile/i));

/* For debugging Web-App mode in a browser */
//var GORDAWebApp = true;

/* see http://cubiq.org/add-to-home-screen for additional options */
var addToHomeConfig = {
	animationIn: 'drop',
	animationOut: 'bubble',
	startDelay: 550,								// milliseconds
	lifespan: 1000*60,							// milliseconds  (set to: 30 secs)
	expire: 60*24*GORDA.expiryDays,	// minutes (set in admin settings)
	bottomOffset: 14,
	touchIcon: true,
	arrow: true,
	message: GORDA.add2home_message
};

/* Try to get out of frames! */
if ( window.top != window.self ) { 
	window.top.location = self.location.href
}

/* If it's iPad, use touchstart, in desktop browser, use click (touchstart/end is faster on iOS) */
if ( typeof ontouchstart != 'undefined' && typeof ontouchend != 'undefined' ) { 
	var touchStartOrClick = 'touchstart'; 
	var touchEndOrClick = 'touchend'; 
} else {
	var touchStartOrClick = 'click'; 
	var touchEndOrClick = 'click'; 
};

function doClassiciPadReady() {

	/* Prevent default touchmove function for iScrolls */	
	if ( iOS5 ) {
		var staticElements = touchJS( '#gorda-header, .popover header' ); // these elements will not trigger a touchmove event
		staticElements.bind( 'touchmove', function( e ){ e.preventDefault(); } );
	} else {
		document.addEventListener( 'touchmove', function( e ){ e.preventDefault(); }, false );

		/* Fix for select elements on iOS 4.3.2 */		
		var formElements = touchJS( 'select, input, textarea' );
		formElements.bind( touchStartOrClick, function( e ) { e.stopPropagation(); } );	
	}

	/* Add the orientation event listener */	
	window.addEventListener( 'orientationchange', function() {
		classicUpdateOrientation();
	});

	//add no-overflow div to general table -------------------------------------
	touchJS('.generaltable').wrap('<div class="no-overflow" />');
	//add back link for forum post ---------------------------------------------
	touchJS( '#mformforum' ).prepend( '<span class="backpost"><b><a href="javascript:history.back();">X</a></b></span>' );

	/* Menubar Button Left Popover Triggers */	
	touchJS( '.head-left div.menubar-button' ).bind( touchEndOrClick, function(){
		var popoverName = '#pop-' + touchJS( this ).attr( 'id' );
		var linkOffset = touchJS( this ).offset();
		touchJS( popoverName ).css({
			top: '40px',
			left: linkOffset.left - touchJS( popoverName ).width() / 2.95
		}).popOverToggle();
		touchJS( popoverName + ' .menu-pointer-arrow' ).css( 'left', '95px' );
		headerDismissSpan();
		scrollerRefresh();
	});
	
	/* Menubar Button Right Popover Triggers */	
	touchJS( '.head-right div.menubar-button' ).bind( touchEndOrClick, function() {
		var popoverName = '#pop-' + touchJS( this ).attr( 'id' );
		var linkOffset = touchJS( this ).offset();
		touchJS( popoverName ).css({
			top: '40px',
			left: linkOffset.left - touchJS( popoverName ).width() / 1.55
		}).popOverToggle();
		touchJS( popoverName + ' .menu-pointer-arrow' ).css( 'right', '0px' );
		headerDismissSpan();
		scrollerRefresh();
	});
	
	/*  Tap the menubar to scroll the main content to top on pre-ios5 */	
	if ( !iOS5 ) {
		touchJS( '.head-center h1' ).bind( touchStartOrClick, function() {
			var homeScroller = touchJS( '#iscroll-wrapper' ).data( 'scroller' );
			homeScroller.scrollTo( 0, 0, 500 );
		});
	}

	/*  Menubar Block PopOver Inner Tabs */
	touchJS( function() {
	    var tabContainers = touchJS( '#pop-block > div' );

	    touchJS( 'ul.menu-tabs a' ).bind( touchStartOrClick, function( e ) {
	        tabContainers.hide().filter( this.rel ).show();
	    	touchJS( 'ul.menu-tabs a' ).removeClass( 'selected' );
	   		touchJS( this ).addClass( 'selected' );
			e.preventDefault();
			scrollerRefresh();
	  	  }).filter( ':first' ).trigger( touchStartOrClick );
	});
	
		/*  Menubar Account PopOver Inner Tabs */
	touchJS( function() {
	    var tabContainers = touchJS( '#pop-account > div' );

	    touchJS( 'ul.menu-tabs2 a' ).bind( touchStartOrClick, function( e ) {
	        tabContainers.hide().filter( this.rel ).show();
	    	touchJS( 'ul.menu-tabs2 a' ).removeClass( 'selected' );
	   		touchJS( this ).addClass( 'selected' );
			e.preventDefault();
			scrollerRefresh();
	  	  }).filter( ':first' ).trigger( touchStartOrClick );
	});
	
	/* Add highlights to a popover and menu links when clicked */
		touchJS( '#popovers-container .pop-inner li a, #pages-wrapper a' ).live( 'click', function() {
			touchJS( this ).parent().toggleClass( 'highlight' );
		});

	/* .active styling to mimic default iOS functionality */
	var touchDivs = '.button, .content a, .footer a';
		touchJS( touchDivs ).live( touchStartOrClick, function() {
			touchJS( this ).addClass( 'active' );
		}).live( touchEndOrClick, function() {
			touchJS( this ).removeClass( 'active' );
		});
	/* Page menu: Hide the Child ULs */
	touchJS( '#pages-wrapper' ).find( 'li.has_children ul' ).hide();

	/* Page menu: Filter parent link href's and make them toggles for thier children */
	touchJS( '#pages-wrapper ul li.has_children > a' ).unbind( 'click' ).bind( 'click', function() {
		touchJS( this ).next().webkitSlideToggle( 350 );
		touchJS( this ).toggleClass( 'arrow-toggle' );
		touchJS( this ).parent().toggleClass( 'open-tree' );
		scrollerRefresh();
		return false;
	});
	
	
	/* Page menu2: Hide the Child ULs ---------------------------------------------------------------------------------------------------------*/
	touchJS( '#pages-wrapper2' ).find( 'li.has_children ul' ).hide();

	/* Page menu2: Filter parent link href's and make them toggles for thier children -----------------------------------------------------------------*/
	touchJS( '#pages-wrapper2 ul li.has_children > a' ).unbind( 'click' ).bind( 'click', function() {
		touchJS( this ).next().webkitSlideToggle( 350 );
		touchJS( this ).toggleClass( 'arrow-toggle' );
		touchJS( this ).parent().toggleClass( 'open-tree' );
		scrollerRefresh();
		return false;
	});
	
	
	
	/*  Make sure the menubar stays present when form textareas are out of focus (non-iOS 5) */	
	if ( !iOS5 ) {
		touchJS( 'textarea, .content input' ).bind( 'blur', function() {
			scrollTo( 0, 0, 100 );
		});
	}
	

	/* Set tabindex automagically */
	touchJS( function(){
	var tabindex = 1;
		touchJS( 'input, select, textarea' ).each( function() {
			if ( this.type != 'hidden' ) {
				var inputToTab = touchJS( this );
				inputToTab.attr( 'tabindex', tabindex );
				tabindex++;
			}
		});
	});
	
	/* New Toggle Switch JS */
	var onLabel = GORDA.toggle_on;
	touchJS( '.on' ).text( onLabel );
	
	var offLabel = GORDA.toggle_off;
	touchJS( '.off' ).text( offLabel );
	
	touchJS( '#switch div' ).bind( touchEndOrClick, function(){ 
		var switchURL = touchJS( this ).attr( 'title' );
		touchJS( '.on' ).toggleClass( 'active' );
		touchJS( '.off' ).toggleClass( 'active' );
		setTimeout( function () { window.location = switchURL }, 500 );
		return false;
	});
	
	/* add dynamic automatic video resizing via fitVids */

	var videoSelectors = [
		"iframe[src^='http://player.vimeo.com']",
		"iframe[src^='http://www.youtube.com']",
		"iframe[src^='http://www.kickstarter.com']",
		"object",
		"embed",
		"video"
	];
	
	var allVideos = touchJS( '.content' ).find(videoSelectors.join(','));
	
	touchJS( allVideos ).each( function(){ 
		touchJS( this ).unwrap().addClass( 'gorda-videos' ).parentsUntil( '.content', 'div:not(.fluid-width-video-wrapper), span' ).removeAttr( 'width' ).removeAttr( 'height' ).removeAttr( 'style' );
	});

	touchJS( '.content' ).fitVids();

	/* Functions to run onReady */
	classicUpdateOrientation('hide');
	
	webAppLinks();
	webAppOnly();
	setupScrolls();
	
}
/* End Document Ready */

/* Setup iScrolls */
function setupScrolls(){
	if ( !iOS5 ) {
		touchJS( '.iscroller' ).each( function(){
			var scroller = touchJS( this ).attr( 'id' );
			activeScroller = new iScroll( scroller );
			touchJS( this ).data( 'scroller', activeScroller );
		});
	}
}

function scrollerRefresh() {
	if ( !iOS5 ) {
			var currentScroller = touchJS( '.iscroller' ).filter( ':visible' ).data( 'scroller' );
			var homeScroller = touchJS( '#iscroll-wrapper' ).data( 'scroller' );
		setTimeout( function() { 
			currentScroller.refresh(); 
			homeScroller.refresh();
		}, 0 );
	} else {
		return true; // continue on
	}
}

/* Detect orientation and do some Voodoo with the menubar's menu */
function classicUpdateOrientation(hide_show) {	
	var windowHeight = touchJS( window ).height() - 0;
	var imageHeight = touchJS( '#logo-area' ).height();
	var menuHeight = windowHeight - imageHeight; 
	//var orientationCookie = GORDAReadCookie( 'gorda-ipad-orientation' );
	switch( hide_show ) { //------- apply one design for 90 and 180 ----------------------------------------------------------------------------------------
	//switch( window.orientation ) {
		// Portrait
		//case 0:
		
		case 'hide':
			touchJS( 'body' ).removeClass( 'landscape' ).addClass( 'portrait' );
			touchJS( '#main-menu' ).animate({width:'toggle'});
			touchJS( '#iscroll-wrapper' ).css( 'height', windowHeight );
			//GORDACreateCookie( 'gorda-ipad-orientation', 'portrait', 365 );
			
			document.getElementById('hidestuff').style.display="none";
    		document.getElementById('showstuff').style.display="inline-block";
		break;
		// Landscape & Browsers
		//case 90:
		case 'show':
		//default:
			touchJS( 'body' ).removeClass( 'portrait' ).addClass( 'landscape' );
			touchJS( '#main-menu' ).animate({width:'toggle'});
			touchJS( '#iscroll-wrapper' ).css( 'height', windowHeight );
			touchJS( '#pages-wrapper' ).detach().css( 'height', menuHeight ).css( 'max-height', 'none' ).appendTo( '#main-menu' );
			
			//GORDACreateCookie( 'gorda-ipad-orientation', 'landscape', 365 );
			
			document.getElementById('hidestuff').style.display="inline-block";
			document.getElementById('showstuff').style.display="none";
	}
	
	if ( !iOS5 ) {
		setTimeout( function() { 
			var homeScroller = touchJS( '#iscroll-wrapper' ).data( 'scroller' );
			homeScroller.refresh();
		}, 550 );
	}
}

/* Create a dismiss span that will reverse open popovers when triggered */
function headerDismissSpan() {
	if ( !touchJS( '#dismiss-underlay' ).length ) {
		touchJS( 'body' ).append( '<span id="dismiss-underlay"></span>' );
		touchJS( '#dismiss-underlay' ).bind( touchStartOrClick, function( e ) {
			touchJS( this ).remove();
			touchJS( '#popovers-container .popover.open' ).removeClass( 'open' ).fadeOut( 350 );
			
			return false;
		});
	} else {
		touchJS( '#dismiss-underlay' ).remove();	
	}
}


function webAppLinks() {
	if ( GORDAWebApp ) {
		// The New Sauce ( Nobody makes tasty gravy like mom )		
		// bind to all links, except UI controls and such
		// add menu-tabs2 and pages-wrapper2 -----------------------------------------------------------------------------------------
		var webAppLinks = touchJS( 'a' ).not( 
			'.no-ajax, .email a, .button, .comment-buttons a, ul.menu-tabs a, ul.menu-tabs2 a, #pages-wrapper .has_children > a, #pages-wrapper2 .has_children > a,  .GTTabs a' );

 		webAppLinks.each( function(){
			var targetUrl = touchJS( this ).attr( 'href' ); 		
			var targetLink = touchJS( this );
			var localDomain = location.protocol + '//' + location.hostname;
			var rootDomain = location.hostname.split( '.' );
			var masterDomain = rootDomain[1] + '.' + rootDomain[2];

			// link is local, but set to be non-mobile
			if ( typeof gorda_ignored_urls != 'undefined' ) {
			   touchJS.each( gorda_ignored_urls, function( i, value ) {
			       if ( targetUrl.match( value ) ) {
						targetLink.addClass( 'ignored' );
			       }
			   });
			}

		   // filetypes, images class name additions
	       if ( targetUrl.match( ( /[^\s]+(\.(pdf|numbers|pages|xls|xlsx|doc|docx|zip|tar|gz|csv|txt))$/i ) ) ) {
				targetLink.addClass( 'external' );
	       } else if ( targetUrl.match( ( /[^\s]+(\.(jpg|jpeg|gif|png|bmp|tiff))$/i ) ) ) {
				targetLink.addClass( 'img-link' );
	       }

			touchJS( targetLink ).unbind( 'click' ).bind( 'click', function( e ) {
				// is this an external link? Confirm to leave WAM
				if ( touchJS( targetLink ).hasClass( 'external' ) || touchJS( targetLink ).parent( 'li' ).hasClass( 'external' ) ) {
			       	confirmForExternal = confirm( GORDA.external_link_text + ' \n' + GORDA.open_browser_text );
					if ( confirmForExternal ) {
						return true;
					} else {			
						e.preventDefault();
						e.stopImmediatePropagation();
					}
				// prevent images with links to larger ones from opening in web-app mode
				} else if ( touchJS( targetLink ).hasClass( 'img-link' ) ) {
					return false;

				// local http link or no http present: 
				} else if ( targetUrl.match( localDomain ) || !targetUrl.match( 'http://' ) ) {
					// make sure it's not in the ignored list first
					if ( touchJS( targetLink ).hasClass( 'ignored' ) || touchJS( targetLink ).parent( 'li' ).hasClass( 'ignored' ) ) {
				       	confirmForExternal = confirm( GORDA.gorda_ignored_text + ' \n' + GORDA.open_browser_text );
							if ( confirmForExternal ) {
								return true;	
							} else {
								return false;
							}
					// okay, it's passed the tests, this is a local link, fire WAM
					} else {
						GORDACreateCookie( 'gorda-load-last-url', targetUrl, 365 );
						window.location = targetUrl;  
						e.preventDefault();
					} 
				// not local, not ignored, doesn't have no-ajax but it's got an external http domain url
				} else {
			       	confirmForExternal = confirm( GORDA.external_link_text + ' \n' + GORDA.open_browser_text );
					if ( confirmForExternal ) {
						return true;
					} else {			
						return false;
					}					
				}
			}); /* end click bindings */
		}); /* end .each loop */
	} else {
		// Do non web-app setup
		touchJS( 'li.target a' ).attr( 'target', '_blank' );
	}
}

function webAppOnly() {
	if ( GORDAWebApp ) {
		var persistenceOn = touchJS( 'body.loadsaved' ).length;
		touchJS( 'body' ).addClass( 'web-app' );
		touchJS( '#account-link-area, #switch' ).remove();
		if ( !persistenceOn ) {
			GORDAEraseCookie( 'gorda-load-last-url' );
		}
		/* prevent images with links to larger ones from opening in web-app mode */
		touchJS( '.post a' ).has( 'img' ).each( function(){ 
			touchJS( this ).click( function( e ) {
		  		var imgURL = touchJS( this ).attr( 'href' );
				if ( imgURL.match( '.jpg' ) || imgURL.match( '.png' ) || imgURL.match( '.jpeg' ) || imgURL.match( '.gif' ) ) {
					e.preventDefault();
					e.stopImmediatePropagation();
				}
			});
		});
	}
}

/* New touchJS function popOverToggle() for popover windows */
touchJS.fn.popOverToggle = function() { 
	if ( !this.hasClass( 'open' ) ) {
		this.show().addClass( 'open' );
	} else {
		this.removeClass( 'open' ).fadeOut( 350 );
	}
}


/* New touchJS function webkitSlideToggle() */
touchJS.fn.webkitSlideToggle = function() { 
	if ( !this.hasClass( 'slide-in' ) ) {
		this.show().addClass( 'slide-in' );
	} else {
		this.slideUp( 350 ).removeClass( 'slide-in' );
	}
}

/* Cookie Functions */

function GORDACreateCookie( name, value, days ) {
	if ( days ) {
		var date = new Date();
		date.setTime( date.getTime() + ( days*24*60*60*1000 ) );
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path="+GORDA.siteurl;
}

function GORDAReadCookie( name ) {
	var nameEQ = name + "=";
	var ca = document.cookie.split( ';' );
	for( var i=0;i < ca.length;i++ ) {
		var c = ca[i];
		while ( c.charAt(0)==' ' ) c = c.substring( 1, c.length );
		if ( c.indexOf( nameEQ ) == 0 ) return c.substring( nameEQ.length, c.length );
	}
	return null;
}

function GORDAEraseCookie( name ) {
	GORDACreateCookie( name,"",-1 );
}

touchJS( document ).ready( function() { doClassiciPadReady(); } );



