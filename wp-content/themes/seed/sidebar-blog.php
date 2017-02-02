<aside class="sidebar sidebar-blog">

	<?php get_search_form(); ?>

	<h3 class="sidebar-heading">Categories</h3>
	<ul class="sidebar-list">
	<?php wp_list_categories('orderby=name&title_li='); ?> 
	</ul>

	<h3 class="sidebar-heading">Recent Posts</h3>
	<ul class="sidebar-list">
	<?php
		$recent_posts = wp_get_recent_posts('numberposts=3&post_status=publish');
		foreach( $recent_posts as $recent ){
			echo '<li><a href="' . get_permalink($recent['ID']) . '" title="Look '.esc_attr($recent['post_title']).'" >' .   $recent['post_title'].'</a></li> ';
		}
	?>
	</ul>

	<h3 class="sidebar-heading">Tag Cloud</h3>
	<div id="tag-cloud">
		<?php wp_tag_cloud('smallest=12&largest=22&unit=px&number=20&orderby=name'); ?>
	</div>

</aside>