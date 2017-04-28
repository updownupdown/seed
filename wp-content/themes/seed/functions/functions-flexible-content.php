<?php
// ==================================== //
// ========= FLEXIBLE CONTENT ========= //
// ==================================== //

/*
 * Required Field Names
 *
 * top_spacing, bottom_spacing (default, less, none)
 * bg_type (none, white/palegrey/green/etc., image)
 * bg_image
 * bg_overlay (none, black40/black60/etc.)
 * white_text (bool)
 *
 */

$flexible_master_count = 0;
$flexible_width = 'full';

// Include Flexible Content
function flexibleContent($width = 'full'){

	// Set master count
	global $flexible_master_count;
	$flexible_master_count = 0;

	// Set flexible width for all panels
	global $flexible_width;
	$flexible_width = $width;

	// Include flexible content template
	include(locate_template('flexible/flexible-layouts.php'));

}


// Default Panel Classes
function defaultPanelClasses(){

	// Classes
	$panel_classes = array();

	// Top Spacing (top_spacing)
	$top_spacing = get_sub_field('top_spacing');
	if($top_spacing) $panel_classes[] = 'fts-' . $top_spacing;

	// Bottom Spacing (bottom_spacing)
	$bottom_spacing = get_sub_field('bottom_spacing');
	if($bottom_spacing) $panel_classes[] = 'fbs-' . $bottom_spacing;

	// Invert Text Colours (invert_colours)
	$white_text = get_sub_field('white_text');
	global $flexible_width;
	if( $flexible_width != 'column' && $white_text ) $panel_classes[] = 'white-text';

	// Background Type
	$bg_type = get_sub_field('bg_type');
	if($bg_type){
		$panel_classes[] = 'fbg-type-' . $bg_type;

		if($bg_type == 'colour'){
			$bg_colour = get_sub_field('bg_colour');
			$panel_classes[] = 'fbg-color-' . $bg_colour;
		}
	}

	return $panel_classes;
}


// Panel Background
function getPanelBackground(){

	// Background Type & Overlay
	$bg_type = get_sub_field('bg_type');
	$bg_overlay = get_sub_field('bg_overlay');

	if( $bg_type && $bg_type == 'image'){

		// Background Image
		$bg_img = get_sub_field('bg_image');
		$bg_img_output = '<div class="flexible-bg fbg-large" style="background-image:url(\'' . $bg_img['sizes']['panel_bg'] . '\')"></div>';
		$bg_img_output .= '<div class="flexible-bg fbg-mobile" style="background-image:url(\'' . $bg_img['sizes']['panel_bg_mobile'] . '\')"></div>';

		// Overlay
		if( $bg_overlay && $bg_overlay != 'none' ) $bg_img_output .= '<div class="flexible-overlay fo-' . $bg_overlay . '"></div>';

	} else{
		$bg_img_output = '';
	}

	return $bg_img_output;
}


// Open Flexible Panel
function openFlexible($label = 'default', $panel_classes_extra = '', $bypass_row = false){

	// Increment master count
	global $flexible_master_count;
	$flexible_master_count++;

	// Panel Classes
	$panel_classes_default = defaultPanelClasses();

	if( is_array($panel_classes_extra) ){
		$panel_classes_all = array_merge($panel_classes_default, $panel_classes_extra);
		$panel_classes_clean = join(' ', $panel_classes_all);
	} elseif ( $panel_classes_extra != '' ) {
		$panel_classes_default[] = $panel_classes_extra;
		$panel_classes_clean = join(' ', $panel_classes_default);
	} else {
		$panel_classes_clean = join(' ', $panel_classes_default);
	}

	// Panel ID
	$panel_id = get_sub_field('panel_id');
	$panel_id = preg_replace('@[^0-9a-z\-\_]+@i', '', $panel_id);

	echo '<section ' . ( $panel_id ? 'id="' . $panel_id . '"' : '' ) . ' class="flexible flexible-' . $label . ' ' . $panel_classes_clean . '">';

		// Panel Background
		$panel_bg = getPanelBackground();

		if($panel_bg != '') echo $panel_bg;

		echo '<div class="flexible-content">';

			// Include rows?
			global $flexible_width;
			if($flexible_width == 'full' && $bypass_row == false ) echo '<div class="row"><div class="col span-12">';

}


// Close Flexible Panel
function closeFlexible($bypass_row = false){

		// Include rows?
		global $flexible_width;
		if($flexible_width == 'full' && $bypass_row == false ) echo '</div></div>'; // close .col, .row

	echo '</div></section>'; // close .flexible-content, .flexible
}


// Generate Button (Clone Field)
// usage: echo generateButton($item['button'], 'button');
function generateButton($button, $classes = ''){

	// Get Link
	$link_type = $button['link_type'];

	if($link_type == 'page'){
		$button_url = $button['link_page'];
	} elseif($link_type == 'custom'){
		$button_url = $button['link_custom'];
	}

	// Return button
	return '<a href="' . $button_url . '" ' . ( $button['link_target'] ? 'target="_blank"' : '' ) . ' class="' . $classes . '">' . $button['label'] . '</a>';
}
?>
