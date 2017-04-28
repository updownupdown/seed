<?php
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
?>
