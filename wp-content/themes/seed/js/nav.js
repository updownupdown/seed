jQuery(document).ready(function($){

	var nav = $('#nav'),
			scrollTop = $(this).scrollTop(),
			lastScrollTop = $(this).scrollTop(),
			navHeight = 130,
			mobileNavHeight = 50,
			deltaNavHeight = navHeight - mobileNavHeight;

	// Toggle Navs
	function toggleNavs(){

		// Desktop
		if ( scrollTop > deltaNavHeight ) {
			nav.addClass('small');
		} else {
			nav.removeClass('small');
		}

		// Mobile
		if( scrollTop > lastScrollTop && scrollTop > mobileNavHeight ){
			nav.addClass('mobile-nav-hide');
		} else {
			nav.removeClass('mobile-nav-hide');
		}
	}

	// Check scroll every 0.5s
	var didScroll = false;
	$(window).scroll(function(){ didScroll = true; });
	setInterval(function(){
	    if( didScroll ){
				didScroll = false;
				scrollTop = $(this).scrollTop();
				toggleNavs();
				lastScrollTop = scrollTop;
	    }
	}, 250);

	// Toggle navs on init
	toggleNavs();


	// ===== Mobile Nav Toggles ===== //

	// Main toggle
	$('.mobile-nav-toggle').click(function(){
		$('body').toggleClass('mobile-nav-active');
	});

	// Search toggle
	$('#mobile-nav-search-toggle').click(function(){
		$('#mobile-nav-search input').focus();
	});


	// ===== Nav sub-menus ===== //

	// Append open/close buttons sub-menus
	$('#main-menu li').has('.sub-menu').addClass('has-children').append('<div class="expand-btn"></div>');

	// Toggle sub-menus
	$('.expand-btn').click(function(){
		var el = $(this),
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

});
