<?php
// ========== Flexible Content Panels Loop ========== //
if( have_rows('panels') ) :
	while ( have_rows('panels') ) : the_row();

		$layout = get_row_layout();

		switch( $layout ){

			// ===== Default Layouts ===== //

			// Full Width Content
			case 'content_cols':
				require_once(locate_template('flexible/fl-content_cols.php'));
				break;

			// Hero Grid
			case 'hero_grid':
				require_once(locate_template('flexible/fl-hero_grid.php'));
				break;

			// Full Width Image
			case 'full_img':
				require_once(locate_template('flexible/fl-full_img.php'));
				break;

			// Tabs
			case 'tabs':
				require_once(locate_template('flexible/fl-tabs.php'));
				break;

			// Accordions
			case 'accordions':
				require_once(locate_template('flexible/fl-accordions.php'));
				break;

			// Photo Gallery
			case 'photo_gallery':
				require_once(locate_template('flexible/fl-photo_gallery.php'));
				break;

			// Video Gallery
			case 'video_gallery':
				require_once(locate_template('flexible/fl-video_gallery.php'));
				break;

			// Quote
			case 'quote':
				require_once(locate_template('flexible/fl-quote.php'));
				break;

			// Plain Code
			case 'plain_code':
				require_once(locate_template('flexible/fl-plain_code.php'));
				break;

			// Google Map
			case 'google_map':
				require_once(locate_template('flexible/fl-google_map.php'));
				break;


			// ===== Custom Layouts ===== //

			/*
			Nothing here...
			*/

		}

	endwhile;
endif;
?>
