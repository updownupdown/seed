<?php
// Master count
global $flexible_master_count;

// Open Panel
openFlexible('gallery');

    // Prepare fields
    $type = get_sub_field('type');
    $gallery = get_sub_field('gallery');

    // Enqueue scripts
    if( $type == 'slider' ){

      wp_enqueue_script('theme-flexslider');

    } elseif( $type == 'lightbox') {

        // Lightbox scripts and styles
        wp_enqueue_style('lightgallery-css');
        wp_enqueue_script('theme-lightgallery');

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
?>
