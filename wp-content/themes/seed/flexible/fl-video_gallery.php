<?php
// Open Panel
openFlexible('videos');

    // Fields
    $layout = get_sub_field('layout');

    if( $layout == 'thumbs' ){

      // Lightbox scripts and styles
      wp_enqueue_style('lightgallery-css');
      wp_enqueue_script('theme-lightgallery');

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

                        // YouTube Embed
                        echo '<div class="video-iframe-wrap"><iframe class="video-iframe" width="' . $width . '" height="' . $height . '" src="//www.youtube.com/embed/' . get_sub_field('youtube_id') . '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';

                    echo '</div></li>';

                endwhile;

            echo '</ul>';

        endif;

    } elseif($layout == 'thumbs') {

        // Videos (Lightbox)
        if( have_rows('videos') ):

            echo '<ul class="flexible-videos-thumbs">';

                while( have_rows('videos') ): the_row();

                    // Title
                    $video_title = get_sub_field('video_title');

                    // YouTube Thumbnail
                    $youtube_id = get_sub_field('youtube_id');
                    $link = '//www.youtube.com/watch?v=' . $youtube_id . '&rel=0';
                    $thumb_img = '//img.youtube.com/vi/' . $youtube_id . '/hqdefault.jpg';

                    echo '<li><a class="lightgallery-video" href="' . $link . '" style="background-image:url(\'' . $thumb_img . '\')">' . svgi('play-btn') . ($video_title != '' ? '<span class="video-title">' . $video_title . '</span>' : '') . '</a></li>';

                endwhile;

            echo '</ul>';

        endif;

    }

// Close Panel
closeFlexible();
?>
