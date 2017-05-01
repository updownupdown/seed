<?php
// Enqueue Scripts
wp_enqueue_script('acf-maps');

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
?>
