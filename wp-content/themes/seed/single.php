<?php get_header(); ?>

<main>

<section class="section-padding">
	<div class="row">
		<div class="col span-8 col-margin">

			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
			?>

				<h2 class="post-title"><?php the_title(); ?></h2>

				<ul class="post-details">
					<li class="post-details-date"><?php e_svgi('calendar'); ?><?php the_time('F j\<\s\u\p\>S\<\/\s\u\p\>, Y'); ?></li>
					<li class="post-details-cats"><?php e_svgi('folder'); ?><?php echo get_the_category_list(', '); ?></li>
					<?php echo the_tags('<li class="post-details-tags">' . svgi('tags'), ', ', '</li>'); ?>
				</ul>

			<?php
			// Content
			the_content();
			?>

			<?php
			// Prev & Next Posts
			echo '<ul id="prevnext">';

				$prev_post = get_adjacent_post(false, '', true);
				if(!empty($prev_post)) {
					echo '<li><a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '">' . svgi('arrow-left') . '<small>Previous:</small><br />' . $prev_post->post_title . '</a></li>';
				} else {
					echo '<li class="empty"></li>';
				}

				$next_post = get_adjacent_post(false, '', false);
				if(!empty($next_post)) {
					echo '<li><a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '">' . svgi('arrow-right') . '<small>Next:</small><br />' . $next_post->post_title . '</a></li>';
				} else {
					echo '<li class="empty"></li>';
				}

			echo '</ul>';
			?>

			<?php endwhile; else: ?>

				<p>Sorry, no posts matched your criteria.</p>

			<?php endif; ?>

		</div>
		<div class="col span-4">

			<?php get_sidebar('blog'); ?>

		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
