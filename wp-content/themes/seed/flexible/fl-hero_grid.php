<?php
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
?>
