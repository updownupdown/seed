<?php
// ================================== //
// ============ TINY MCE ============ //
// ================================== //


// Edit second row button
function custom_mce_buttons_2($buttons){	

	// Add buttons	
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';
	$buttons[] = 'styleselect';

	// Remove buttons
	$remove = array('forecolor');
	return array_diff($buttons,$remove);

	return $buttons;
}
add_filter('mce_buttons_2', 'custom_mce_buttons_2');



// Add Formats button custom content
function custom_tinymce_settings($settings){
	$new_styles = array(

		/*
		// Colours
		array(
			'title'	=> 'Colour',
			'items'	=> array(
				array(
					'title'		=> 'Blue',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'blue',
				),			
				array(
					'title'		=> 'Red',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'red',
				),
			),
		),	
		*/

		// Size
		array(
			'title'	=> 'Size',
			'items'	=> array(
				array(
					'title'		=> 'Small',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'small',
				),
				array(
					'title'		=> 'Large',
					'selector'	=> 'p,ol,ul',
					'classes'	=> 'large',
				),
			),
		),

		// Weight
		array(
			'title'	=> 'Weight',
			'items'	=> array(
				array(
					'title'		=> 'Thin',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'thin',
				),
				array(
					'title'		=> 'Normal',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'normal',
				),
				array(
					'title'		=> 'Bold',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'bold',
				),
				array(
					'title'		=> 'Thin (select span)',
					'inline'	=> 'span',
					'classes'	=> 'thin',
				),
				array(
					'title'		=> 'Normal (select span)',
					'inline'	=> 'span',
					'classes'	=> 'normal',
				),
				array(
					'title'		=> 'Bold (select span)',
					'inline'	=> 'span',
					'classes'	=> 'bold',
				),
			),
		),

		// Spacing
		array(
			'title'	=> 'Spacing',
			'items'	=> array(
				array(
					'title'		=> 'More Bottom Spacing',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p',
					'classes'	=> 'more-bottom-spacing',
				),				
				array(
					'title'		=> 'Less Bottom Spacing',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p',
					'classes'	=> 'less-bottom-spacing',
				),
				array(
					'title'		=> 'No Bottom Spacing',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p',
					'classes'	=> 'no-bottom-spacing',
				),
			),
		),

		// Images
		array(
			'title'	=> 'Images',
			'items'	=> array(				
				array(
					'title'		=> 'Image Shadow',
					'selector'	=> 'img',
					'classes'	=> 'shadow',
				),
				array(
					'title'		=> 'Image Border',
					'selector'	=> 'img',
					'classes'	=> 'border',
				),
			),
		),

		// Lists
		array(
			'title'	=> 'Lists',
			'items'	=> array(
				array(
					'title'		=> 'Large List',
					'selector'	=> 'ul',
					'classes'	=> 'large',
				),
			),
		),

		// Buttons
		array(
			'title'	=> 'Buttons',
			'items'	=> array(
				array(
					'title'		=> 'Button Link',
					'selector'	=> 'a',
					'classes'	=> 'button',
				),
			),
		),
	);	

	$settings['style_formats_merge'] = false;
	$settings['style_formats'] = json_encode($new_styles);

	// Toggle second row of buttons by default
	$settings['wordpress_adv_hidden'] = false;

	return $settings;
}
add_filter('tiny_mce_before_init', 'custom_tinymce_settings');
?>