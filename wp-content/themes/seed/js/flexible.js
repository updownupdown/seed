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


	// ========== Flexible - LightGallery ========== //
	if( typeof lightGallery === "function" ){

		// Photo Gallery
		if( $('.flexible-gallery-lightbox').length ){

			$('.lightgallery-gallery').lightGallery({
				selector: '.lightgallery-item',
			});
		}


		// Video Gallery
		if( $('.lightgallery-video').length ){

			$('.lightgallery-video').lightGallery({
			    selector: 'this',
			    zoom: false,
			    counter: false,
			    download: false,
					youtubePlayerParams: {
						rel: 0,
					},
			});

		}
	}



	// ========== Flexible Gallery (Slider) ========== //
	if( typeof lightGallery === "function" && $('.flexible-gallery-slider-wrap').length ){

		$('.flexible-gallery-slider-wrap').each(function(){

			var loading = $('.fgs-loading', this),
					nav = $(this).data('nav'),
					sliderID = $(this).data('count');


			// Slider args
			var flexArgs = {
				animation: "fade",
				prevText: "",
				nextText: "",
				useCSS: false,
				pauseOnHover: true,
				directionNav: true, // arrows
				controlNav: false, // buttons
				slideshowSpeed: 7000,

				start: function(){
					loading.fadeOut(250);
				},
			};


			// Add buttons or carousel
			if( nav == 'buttons' ){
				flexArgs.controlNav = true;
			} else if( nav == 'carousel' ){
				flexArgs.sync = '#fgc-' + sliderID;
			}


			// Initiate carousel
			if( nav == 'carousel' ){
				$('#fgc-' + sliderID).flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					prevText: "",
					nextText: "",
					itemWidth: 80,
					itemMargin: 1,
					asNavFor: '#fgs-' + sliderID,
				});
			}


			// Initiate slider
			$('#fgs-' + sliderID).flexslider(flexArgs);

		});

	}


});
