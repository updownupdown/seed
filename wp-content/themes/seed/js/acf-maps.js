(function($) {


// global vars
var defaultZoomLevel = 15,
		zoomLevel = defaultZoomLevel,
		defaultMarkerColor = '#D35917',
		prev_infowindow = false;


$('.acf-map').each(function(){

	// new_map
	function new_map( $el ) {

		// var
		var $markers = $el.find('.marker');


		// vars
		var args = {
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP,

			// more styles at snazzymaps.com
			styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}],
		};


		// map options

		// zoom
		if( $el.data('zoom') === undefined ){
			zoomLevel = defaultZoomLevel;
		} else {
			zoomLevel = $el.data('zoom');
		}
		args.zoom = zoomLevel;

		// scrollwheel
		if( $el.data('scrollwheel') === true ){
			args.scrollwheel = true;
		} else {
			args.scrollwheel = false;
		}

		// mapTypeControl
		if( $el.data('maptype') === true ){
			args.mapTypeControl = true;
		} else {
			args.mapTypeControl = false;
		}

		// zoomcontrol
		if( $el.data('zoomcontrol') === true ){
			args.zoomControl = true;
		} else {
			args.zoomControl = false;
		}

		// draggable
		if( $el.data('draggable') === true ){
			args.draggable = true;
		} else {
			args.draggable = false;
		}

		// streetview
		if( $el.data('streetview') === true ){
			args.streetViewControl = true;
		} else {
			args.streetViewControl = false;
		}


		// create map
		var map = new google.maps.Map( $el[0], args);

		// add a markers reference
		map.markers = [];

		// add markers
		$markers.each(function(){
	    	add_marker( $(this), map );
		});

		// center map
		center_map(map);

		// return
		return map;
	}


	// pin symbol
	function pinSymbol(markerColor) {
	    return {
	        path: 'M0-34c-5.869,0-10.625,4.757-10.625,10.625C-10.625-12.75,0,0,0,0s10.625-12.75,10.625-23.375 C10.625-29.243,5.869-34,0-34 M0-17c-3.522,0-6.375-2.853-6.375-6.375c0-3.521,2.853-6.375,6.375-6.375 c3.522,0,6.375,2.854,6.375,6.375C6.375-19.853,3.522-17,0-17',
	        fillColor: markerColor,
	        fillOpacity: 0.8,
	        strokeColor: '#000000',
	        strokeWeight: 1,
	        scale: 1,
	   };
	}


	// add_marker
	function add_marker( $marker, map ) {

		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

		// marker colour
		var markerColor = $marker.attr('data-color');

		if( markerColor == 'default' ){
			markerColor = defaultMarkerColor;
		}

		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map,
			icon 		: pinSymbol( markerColor ),
		});

		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() ){
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});

			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {

				// close previous infowindow
				if( prev_infowindow ){
		           prev_infowindow.close();
		        }
		        prev_infowindow = infowindow;

		        // open current infowindow
				infowindow.open( map, marker );
			});

		}

	}


	// center_map
	function center_map(map) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if( map.markers.length == 1 ){
			// set center of map
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( 16 );
		} else {
			// fit to bounds
			map.fitBounds( bounds );
		}

	}


	// resize map on window resize
	var resizeTimer;
	$(window).on('resize', function(e) {

		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {

		google.maps.event.trigger(map,'resize');
		center_map(map);

		}, 250);

	});


	// create new map
	var map = new_map( $(this) );

});

})(jQuery);
