<?php
// ========== Flexible Content Panels Loop ========== //
if( have_rows('panels') ):
while ( have_rows('panels') ) : the_row();


// ========== Full Width Content ========== //
if( get_row_layout() == 'content_cols' ):

	// Panel Classes
	$panel_classes = array();

	// Number of Columns
	$col_num = get_sub_field('col_num');
	$panel_classes[] = 'fcc-num-' . $col_num;

	// Center & Limit Width
	if( $col_num == '1' ){
		$center_lim = get_sub_field('center_lim');
	} else {
		$center_lim = false;
	}

	// Column Split
	if( $col_num == '2' ){
		$col_split = get_sub_field('col_split');
		$panel_classes[] = 'fcc-split-' . $col_split;
	}

	// Open Panel
	openFlexible('content-cols', $panel_classes);

		// Output Columns
		switch( $col_num ){

			case '1':

				// One Column
				if( $center_lim ) echo '<div class="center-lim">';
					echo apply_filters('the_content', get_sub_field('content_1'));
				if( $center_lim ) echo '</div>';

				break;

			case '2':

				// Two Columns
				if( $col_split == '5050' ){

					$col1_class = '50';
					$col2_class = '50';

				} elseif ( $col_split == '7030' ){

					$col1_class = '70';
					$col2_class = '30';

				} elseif ( $col_split == '3070' ){

					$col1_class = '30';
					$col2_class = '70';

				} elseif ( $col_split == '6040' ){

					$col1_class = '60';
					$col2_class = '40';

				} elseif ( $col_split == '4060' ){

					$col1_class = '40';
					$col2_class = '60';

				}


			echo '<div class="fcc-col fcc-col-' . $col1_class . '">' . apply_filters('the_content', get_sub_field('content_1')) . '</div>';
				echo '<div class="fcc-col fcc-col-' . $col2_class . ' last">' . apply_filters('the_content', get_sub_field('content_2')) . '</div>';

				break;

			case '3':

				// Three Columns
				echo '<div class="fcc-col fcc-col-33">' . apply_filters('the_content', get_sub_field('content_1')) . '</div>';
				echo '<div class="fcc-col fcc-col-33">' . apply_filters('the_content', get_sub_field('content_2')) . '</div>';
				echo '<div class="fcc-col fcc-col-33 last">' . apply_filters('the_content', get_sub_field('content_3')) . '</div>';

				break;

			case '4':

				// Four Columns
				echo '<div class="fcc-col fcc-col-25">' . apply_filters('the_content', get_sub_field('content_1')) . '</div>';
				echo '<div class="fcc-col fcc-col-25 halfway">' . apply_filters('the_content', get_sub_field('content_2')) . '</div>';
				echo '<div class="fcc-col fcc-col-25">' . apply_filters('the_content', get_sub_field('content_3')) . '</div>';
				echo '<div class="fcc-col fcc-col-25 last">' . apply_filters('the_content', get_sub_field('content_4')) . '</div>';

				break;

		}

	// Close Panel
	closeFlexible();





// ========== Hero Grid ========== //
elseif( get_row_layout() == 'herogrid' ):

	// Fields
	$grid_height = get_sub_field('grid_height');
	$v_align = get_sub_field('v_align');
	$boxes = get_sub_field('boxes');
	$num_boxes = count($boxes);
	$i = 0;

	// Open Panel
	openFlexible('herogrid', null, true);

		// Boxes Container
		echo '<div class="fhg-boxes white-text fhg-height-' . $grid_height . ' fhg-num-' . $num_boxes . ' fhg-v-align-' . $v_align . '">';

		// Boxes loop
		foreach($boxes as $box){

			// last two container
			$i++;
			if( $num_boxes == 3 && $i == 2 ) echo '<div class="fhg-last-two">';

			// Generate Box
			echo '<div class="fhg-box fhg-box-' . $i . '">';

				// Background
				$bg_type = $box['bg_type'];

				switch($bg_type){

					// Colour Fill
					case 'color':
						$color_fill = $box['colour_fill'];
						echo '<div class="fhg-box-bg fhg-box-color fhg-bc-' . $color_fill . '"></div>';
						break;

					// Image
					case 'image':
						$img = $box['image'];
						echo '<div class="fhg-box-bg fhg-box-image hbi-large" style="background-image:url(\'' . $img['sizes']['large'] . '\')"></div>';
						echo '<div class="fhg-box-bg fhg-box-image hbi-medium" style="background-image:url(\'' . $img['sizes']['medium'] . '\')"></div>';
						break;

					// Video
					case 'video':

						$video_still = $box['video_still'];
						$video_mp4 = $box['video_mp4'];
						$video_webm = $box['video_webm'];
						$video_ogg = $box['video_ogg'];

						// Still image for mobile
						echo '<div class="fhg-box-bg fhg-box-video-still" style="background-image:url(\'' . $video_still['sizes']['large'] . '\')"></div>';

						// Video
						echo '<div class="fhg-box-video"><video preload autoplay muted loop poster="' . $video_still['sizes']['large'] . '">';

							if( $video_mp4 ) echo '<source src="' . $video_mp4 . '" type="video/mp4">';
							if( $video_webm ) echo '<source src="' . $video_webm . '" type="video/webm">';
							if( $video_ogg ) echo '<source src="' . $video_ogg . '" type="video/ogg">';

						echo 'Your browser does not support the video tag.</video></div>';

						break;
				}


				// Overlay
				if( $bg_type == 'image' || $bg_type == 'video' ){
					$overlay = $box['overlay'];
					if($overlay != 'none') echo '<div class="fhg-box-overlay hbo-' . $overlay . '"></div>';
				}


				// Content
				echo '<div class="fhg-box-content">' . apply_filters('the_content', $box['content']) . '</div>';

			echo '</div>';

			// last two container
			if( $num_boxes == 3 && $i == 3 ) echo '</div>';

		}

		// Boxes Container
		echo '</div>';


	// Close Panel
	closeFlexible(true);





// ========== Tabs ========== //
elseif( get_row_layout() == 'tabs' ):

	// Enqueue script
	wp_enqueue_script('flexible-common');

	// Open Panel
	openFlexible('tabs');

		// Prepare Content
		$tabs_headings = '';
		$tabs_contents = '';

		if( have_rows('tabs') ):

			echo '<div class="flexible-tab">';

				while( have_rows('tabs') ): the_row();

					// Prepare Headings
					$heading = get_sub_field('heading');
					$heading_clean = preg_replace('/[^A-Za-z0-9 ]/', '', $heading);
					$heading_clean = str_replace(' ', '-', $heading_clean);

					$tabs_headings .= '<li><a href="#tab-' . $heading_clean . '">' . $heading . '</a></li>';

					// Prepare Contents
					$tabs_contents .= '<div id="tab-' . $heading_clean . '">' . apply_filters('the_content', get_sub_field('content')) . '</div>';

				endwhile;

				// Output Headings
				echo '<ul>' . $tabs_headings . '</ul>';

				// Output Contents
				echo $tabs_contents;

			echo '</div>';

		endif;

	// Close Panel
	closeFlexible();



// ========== Accordions ========== //
elseif( get_row_layout() == 'accordions' ):

	// Enqueue script
	wp_enqueue_script('flexible-common');

	// Open Panel
	openFlexible('accordions');

		// Open first by default?
		$open_first = get_sub_field('open_first');

		if( have_rows('accordions') ):

			echo '<div class="flexible-accordion" ' . ( ( $open_first == true ) ? 'data-open="true"' : 'data-open="false"') . '>';

				while( have_rows('accordions') ): the_row();

					echo '<h2>' . get_sub_field('heading') . '</h2>';
					echo '<div>' . apply_filters('the_content', get_sub_field('content')) . '</div>';

				endwhile;

			echo '</div>';

		endif;

	// Close Panel
	closeFlexible();



// ========== Photo Gallery ========== //
elseif( get_row_layout() == 'gallery' ):

	// Master count
	global $flexible_master_count;

	// Open Panel
	openFlexible('gallery');

    	// Prepare fields
    	$type = get_sub_field('type');
    	$gallery = get_sub_field('gallery');

    	// Enqueue scripts
    	if( $type == 'slider' ){

			// Slider scripts
			wp_enqueue_script('flexslider');
			wp_enqueue_script('flexible-flexslider');

    	} elseif( $type == 'lightbox') {

			// Lightbox scripts and styles
			wp_enqueue_style('lightgallery-css');
			wp_enqueue_script('lightgallery-js');
			wp_enqueue_script('flexible-lightbox');

    	}

		// Gallery
		$images = get_sub_field('gallery');

		if( $type == 'slider' ){

			// === Slider Gallery === //

			$nav = get_sub_field('nav');

			if( $images ):

				// Slide Wrap & Loading
				echo '<div id="fgsw-' . $flexible_master_count . '" class="flexible-gallery-slider-wrap" data-nav="' . $nav . '" data-count="' . $flexible_master_count . '"><div class="fgs-loading"></div>';

					// Main Slider
					$slides = '<ul class="slides">';

						foreach( $images as $image ):

							$slides .= '<li>';

								// Image
								$slides .= '<div class="helper-1"><div class="helper-2"><img class="slide-image slide-image-large" src="' . $image['sizes']['large'] . '" width="' . $image['sizes']['large-width'] . '" height="' . $image['sizes']['large-height'] . '" alt="' . $image['alt'] . '" /><img class="slide-image slide-image-medium" src="' . $image['sizes']['medium'] . '" width="' . $image['sizes']['medium-width'] . '" height="' . $image['sizes']['medium-height'] . '" alt="' . $image['alt'] . '" /></div></div>';

								// Caption
								$caption = $image['caption'];
								if( $caption ){
									$slides .= '<p class="slide-caption">' . $caption . '</p>';
								}

							$slides .= '</li>';

						endforeach;

					$slides .= '</ul>';

					echo '<div id="fgs-' . $flexible_master_count . '" class="flexible-gallery-slider">' . $slides . '</div>';


					// Carousel Slider
					if( $nav == 'carousel' ){

						$carousel = '<ul class="slides">';

							foreach( $images as $image ):

								$carousel .= '<li><img class="carousel-thumb" src="' . $image['sizes']['thumbnail'] . '" width="' . $image['sizes']['thumbnail-width'] . '" height="' . $image['sizes']['thumbnail-height'] . '" alt="' . $image['alt'] . '" /></li>';

							endforeach;

						$carousel .= '</ul>';

						echo '<div id="fgc-' . $flexible_master_count . '" class="flexible-gallery-carousel">' . $carousel . '</div>';

					}


				echo '</div>';

			endif;

		} elseif( $type == 'lightbox' ) {

			// === Lightbox Gallery === //

			if( $images ):

				echo '<div class="flexible-gallery-lightbox"><ul class="thumbnails lightgallery-gallery">';

					foreach( $images as $image ):

						echo '<li>';

							// Image
							$caption = $image['caption'];

							echo '<a class="lightgallery-item" href="' . $image['sizes']['large'] . '" ' . ($caption ? 'data-sub-html="' . $caption . '"' : '') . '><img class="slide-image" src="' . $image['sizes']['thumbnail'] . '" width="' . $image['sizes']['thumbnail-width'] . '" height="' . $image['sizes']['thumbnail-height'] . '" alt="' . $image['alt'] . '" /></a>';

						echo '</li>';

					endforeach;

				echo '</ul><div class="flex-control-wrap"></div></div>';

			endif;

		}

	// Close Panel
	closeFlexible();





// ========== Video Gallery ========== //
elseif( get_row_layout() == 'videos' ):

	// Open Panel
	openFlexible('videos');

		// Fields
		$layout = get_sub_field('layout');

		if( $layout == 'thumbs' ){

			// Lightbox scripts and styles
			wp_enqueue_style('lightgallery-css');
			wp_enqueue_script('lightgallery-js');
			wp_enqueue_script('flexible-lightbox');

		}

		if( $layout == 'embed' ){

			// Videos (Embedded)
			if( have_rows('videos') ):

				echo '<ul class="flexible-videos-embed">';

					while( have_rows('videos') ): the_row();

						// Source
						$source = get_sub_field('source');

						// Dimensions
						$width = 680;
						$height = 380;

						// Title
						$video_title = get_sub_field('video_title');

						echo '<li><div class="flexible-video-wrap">';

							// Title
							if( $video_title ) echo '<h3 class="video-title">' . $video_title . '</h3>';

							// Embed code
							if( $source == 'youtube' ){

								$embed_code = '<div class="video-iframe-wrap"><iframe class="video-iframe" width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . get_sub_field('youtube_id') . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';

							} elseif( $source == 'vimeo' ){

								$embed_code = '<div class="video-iframe-wrap"><iframe class="video-iframe" src="//player.vimeo.com/video/' . get_sub_field('vimeo_id') . '" width="' . $width . '" height="' . $height . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';

							}

							echo $embed_code;

						echo '</div></li>';

					endwhile;

				echo '</ul>';

			endif;

		} elseif($layout == 'thumbs') {

			// Videos (Lightbox)
			if( have_rows('videos') ):

				echo '<ul class="flexible-videos-thumbs">';

					while( have_rows('videos') ): the_row();

						// Source
						$source = get_sub_field('source');

						// Title
						$video_title = get_sub_field('video_title');

						// Source
						if( $source == 'youtube' ){

							$youtube_id = get_sub_field('youtube_id');
							$link = '//www.youtube.com/watch?v=' . $youtube_id . '&rel=0';
							$thumb_img = '//img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg';

						} elseif( $source == 'vimeo' ){

							$vimeo_id = get_sub_field('vimeo_id');
							$link = '//vimeo.com/' . $vimeo_id;
							$hash = unserialize(file_get_contents('//vimeo.com/api/v2/video/' . $vimeo_id . '.php'));
							$thumb_img = $hash[0]['thumbnail_medium'];

						}

						echo '<li><a class="lightgallery-video" href="' . $link . '" style="background-image:url(\'' . $thumb_img . '\')">' . ($video_title != '' ? '<span>' . $video_title . '</span>' : '') . '</a></li>';

					endwhile;

				echo '</ul>';

			endif;

		}

	// Close Panel
	closeFlexible();





// ========== Quote ========== //
elseif( get_row_layout() == 'blockquote' ):

	// Open Panel
	openFlexible('blockquote');

		// Fields
		$quote = get_sub_field('quote');
		$author = get_sub_field('author');
		$role = get_sub_field('role');

		echo '<blockquote>';

			// Quote
			echo '<p>' . $quote . '</p>';

			// Author/Role
			if( $author || $role ){

				echo '<cite>';

					if( $author ) echo '<span class="author">' . $author . '</span>';
					if( $role ){
						if( $author ) echo '<br />';
						echo '<span class="role">' . $role . '</span>';
					}

				echo '</cite>';
			}

		echo '</blockquote>';

	// Close Panel
	closeFlexible();





// ========== Plain Code ========== //
elseif( get_row_layout() == 'code' ):

	// Open Panel
	openFlexible('code');

		echo get_sub_field('code');

	// Close Panel
	closeFlexible();





// ========== Google Map ========== //
elseif( get_row_layout() == 'map' ):

	// Enqueue Scripts
	wp_enqueue_script('script-acf-maps');

	// Fields
	$map_height = get_sub_field('map_height');
	$map_width = get_sub_field('map_width');
		$bypass_row = $map_width == 'full' ? true : false;

	// Map Options
	$map_options = array('scrollwheel', 'maptype', 'draggable', 'streetview', 'zoomcontrol');
	$map_options_data = '';
	foreach( $map_options as $option ){
		$option_value = get_sub_field($option);
		if( $option_value ){
			$map_options_data .= ' data-' . $option . '="true"';
		} else {
			$map_options_data .= ' data-' . $option . '="false"';
		}
	}

	// Map Zoom
	$zoom = get_sub_field('zoom');
	if( ! $zoom ) $zoom = 15;
	$map_options_data .= ' data-zoom="' . $zoom . '"';

	// Open Panel
	openFlexible('map', null, $bypass_row);

		// Map overlay
		echo '<div class="flexible-map-overlay"><span>Tap to interact</span></div>';

		// ACF Map
		echo '<div class="acf-map height-' . $map_height . '"' . $map_options_data . '>';

			// Markers
			$markers = get_sub_field('markers');

			if( $markers ){
				foreach( $markers as $marker ){

					// Marker Fields
					$marker_heading = $marker['marker_heading'];
					$marker_text = $marker['marker_text'];
					$marker_colour = $marker['marker_colour'];
					if( $marker_colour == 'custom' ){
						$marker_colour = $marker['marker_colour_custom'];
					} else {
						$marker_colour = 'default';
					}

					echo '<div class="marker" data-lat="' . $marker['marker']['lat'] . '" data-lng="' . $marker['marker']['lng'] . '" data-color="' . $marker_colour . '">';

						// infowindow
						if( $marker_heading || $marker_text ){

							echo '<div class="marker-infowindow">';

								if( $marker_heading ) echo '<h3>' . $marker_heading . '</h3>';
								if( $marker_text ) echo '<p>' . $marker_text . '</p>';

							echo '</div>';

						}

					echo '</div>';

				}
			}

		echo '</div>';


	// Close Panel
	closeFlexible($bypass_row);



endif;

endwhile;

endif;
?>
