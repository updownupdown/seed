jQuery(document).ready(function($){

	// ========== Flexible - Accordions ========== //
	$('.flexible-accordion').each(function(){

		if( $(this).data('open') === true){

			// Open first
			$(this).accordion({
				heightStyle: "content",
				collapsible: true,
			});

		} else {

			// All closed by default
			$(this).accordion({
				heightStyle: "content",
				collapsible: true,
				active: false,
			});

		}

	});


	// ========== Flexible - Tabs ========== //
	$('.flexible-tab').each(function(){

		$(this).tabs({
			loaded: false,
			activate: function (e, ui){
				if( $(window).width() < 1025 ){
					$('html, body').stop().animate({ scrollTop: $(ui.newPanel).offset().top - 60 }, 1000);
				}
			}
		});

	});

});
