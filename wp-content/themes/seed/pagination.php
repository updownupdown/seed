<?php
global $wp_query;

$big = 99999999;
$paginate_args = array(
    'base' => str_replace($big, '%#%', get_pagenum_link($big)),
    'format' => '?paged=%#%',
    'total' => $wp_query->max_num_pages,
    'current' => max(1, get_query_var('paged')),
    'show_all' => false,
    'end_size' => 2,
    'mid_size' => 3,
    'prev_next' => true,
    'prev_text' => 'Previous',
    'next_text' => 'Next',
    'type' => 'list'
);

echo '<div id="pagination">';
	echo paginate_links($paginate_args);
echo '</div>';
?>