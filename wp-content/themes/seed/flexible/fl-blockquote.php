<?php
// Open Panel
openFlexible('blockquote');

    // Fields
    $quote = get_sub_field('quote');
    $author = get_sub_field('author');
    $role = get_sub_field('role');

    echo '<blockquote>';

        // Quote
        echo '<p>' . $quote . '</p>';

        // Author/Role
        if( $author || $role ){

            echo '<cite>';

                if( $author ) echo '<span class="author">' . $author . '</span>';
                if( $role ){
                    if( $author ) echo '<br />';
                    echo '<span class="role">' . $role . '</span>';
                }

            echo '</cite>';
        }

    echo '</blockquote>';

// Close Panel
closeFlexible();
?>
