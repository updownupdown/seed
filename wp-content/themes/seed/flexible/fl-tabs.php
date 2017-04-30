<?php
// Enqueue script
wp_enqueue_script('theme-jquery-ui');

// Open Panel
openFlexible('tabs');

    // Intro Content
    if( get_sub_field('include_intro') ){
      echo '<div class="intro-content">' . apply_filters('the_content', get_sub_field('intro_content')) . '</div>';
    }

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
?>
