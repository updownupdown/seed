<?php
// Enqueue script
wp_enqueue_script('theme-jquery-ui');

// Open Panel
openFlexible('accordions');

  // Intro Content
  if( get_sub_field('include_intro') ){
    echo '<div class="intro-content">' . apply_filters('the_content', get_sub_field('intro_content')) . '</div>';
  }

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
?>
