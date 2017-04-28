<?php
// Open Panel
openFlexible('full-img', null, true);

    $img = get_sub_field('image');

    echo '<img class="full-img-img desktop" src="' . $img['sizes']['panel_bg'] . '" width="' . $img['sizes']['panel_bg-width'] . '" height="' . $img['sizes']['panel_bg-height'] . '" />';
    echo '<img class="full-img-img mobile" src="' . $img['sizes']['panel_bg_mobile'] . '" width="' . $img['sizes']['panel_bg_mobile-width'] . '" height="' . $img['sizes']['panel_bg_mobile-height'] . '" />';

closeFlexible();
?>
