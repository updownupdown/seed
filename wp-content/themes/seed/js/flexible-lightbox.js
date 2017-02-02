jQuery(document).ready(function($){

	// ========== Flexible - Photo Gallery (Lightbox) ========== //
	if( $('.flexible-gallery-lightbox').length ){

		$('.lightgallery-gallery').lightGallery({
			selector: '.lightgallery-item',
			youtubePlayerParams: {
				rel: 0,
			},
		});
	}


	// ========== Flexible Video Gallery (Lightbox) ========== //
	if( $('.lightgallery-video').length ){

		$('.lightgallery-video').lightGallery({
		    selector: 'this',
		    zoom: false,
		    counter: false,
		    download: false,
		});

	}

});