jQuery(document).ready(function($){

	// ========== WOW ========== //
	/*
	if( $(window).width() > 1024 ){
		wow = new WOW({offset:100})
		wow.init();
	} else {
		$('.wow').removeClass('wow');
	}
	*/
	

	/*
	// ========== SKROLLR ========== //
	window.onload = function() {
		if( $(window).width() > 1024 ){
			var s = skrollr.init({
				mobileCheck: function(){return false;},
				forceHeight: false
			});
		}
	}
	*/



	// ========== BEGIN STICKY NAV ========== //

	// ===== Sticky Nav ===== //
	var nav = $('#nav'),
		navHeight = nav.height(),
		scrollTimer = 0,
		lastScrollFireTime = 0,
		scrollTop = $(this).scrollTop(),
		lastScrollTop = $(this).scrollTop(),
		delta = 5,
		navbarHeight = $('#sticky-top').outerHeight(),
		minScrollTime = 200,
		deltaNavHeight = navHeight - navbarHeight;

	// Desktop nav small/large
	function toggleDesktopNav(){
		if ( scrollTop > deltaNavHeight && ! nav.hasClass('small') ) {
			nav.addClass('small');
		} else if ( $(this).scrollTop() <= deltaNavHeight && nav.hasClass('small') ) {
			nav.removeClass('small');
		}		
	}

	// Mobile nav show/hide
	function toggleMobileNav(){
		if( scrollTop > lastScrollTop && scrollTop > navbarHeight && !$(document.body).hasClass('sticky-active') ){
			$('#sticky-top').removeClass('sticky-show').addClass('sticky-hide');
		} else if(scrollTop + $(window).height() < $(document).height()) {
			$('#sticky-top').removeClass('sticky-hide').addClass('sticky-show');	       
		}
	}

	// Process scroll
	function processScroll() {
		scrollTop = $(this).scrollTop();
		if(Math.abs(lastScrollTop - scrollTop) <= delta) return;

		toggleDesktopNav();
		toggleMobileNav();

		lastScrollTop = scrollTop;		
	}

	toggleDesktopNav();
	toggleMobileNav();


	// On scroll
	$(window).on('scroll', function(){
		var now = new Date().getTime();

		if(!scrollTimer){
			if (now - lastScrollFireTime > (3 * minScrollTime)) {
				processScroll();
				lastScrollFireTime = now;
			}

			scrollTimer = setTimeout(function() {
				scrollTimer = null;
				lastScrollFireTime = new Date().getTime();
				processScroll();
			}, minScrollTime);
		}
	});


	// ===== Toggles ===== //

	// Main toggle
	$('.sticky-toggle').click(function(){
		$('body').toggleClass('sticky-active');
	});

	// Search toggle
	$('#sticky-search-toggle').click(function(){
		$('#sticky-search input').focus();
	});


	// ===== Nav sub-menus ===== //

	// Append open/close buttons sub-menus
	$('#sticky-main-menu li').has('.sub-menu').addClass('has-children').append('<div class="has-children-btn"></div>');

	// Toggle sub-menus
	$('.has-children-btn').click(function(){
		var el = $(this);
			subMenu = el.siblings('.sub-menu').first(),
			parent = el.parent(),	
			grandparent = parent.parent();

		if(parent.hasClass('opened')){
			// close sub-menu
			subMenu.slideUp(300);

			// close children (if any)
			parent.find('.opened .sub-menu').slideUp(300);
			parent.find('.opened').toggleClass('opened');
		} else {	
			// open sub-menu
			subMenu.slideDown(300);
			
			// close other menus (if any are opened)
			grandparent.find('.opened .sub-menu').not(parent).slideUp(300);
			grandparent.find('.opened').not(parent).toggleClass('opened');
		}
		parent.toggleClass('opened');
	});	

	// ========== END STICKY NAV ========== //

});