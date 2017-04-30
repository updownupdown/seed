<article class="loop-post">

	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

	<ul class="post-details">
		<li class="post-details-date"><?php e_svgi('calendar'); ?><?php the_time('F j\<\s\u\p\>S\<\/\s\u\p\>, Y'); ?></li>
		<li class="post-details-cats"><?php e_svgi('folder'); ?><?php echo get_the_category_list(', '); ?></li>
		<?php echo the_tags('<li class="post-details-tags">' . svgi('tags'), ', ', '</li>'); ?>
	</ul>

	<?php echo get_the_post_thumbnail($post->ID,'thumbnail',array('class' => 'post-thumbnail') ); ?>

	<p><?php echo get_the_excerpt(); ?></p>

	<a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>" class="button post-read">Read more</a>

</article>
