<?php get_header(); ?>

<main>

<section class="section-padding">
	<div class="row">

		<div class="col span-8 col-margin">
			<?php if(have_posts()) : ?>
			
				<?php
				// Search result count
				$num_results = $wp_query->found_posts;
				$result_text = ($num_results == 1) ? 'result' : 'results';
				?>

				<h1><span class="light">Searching for "</span><?php echo get_search_query(); ?><span class="light">":</span><br /><small><?php echo $num_results . ' ' . $result_text; ?></small></h1>

				<hr />

				<?php
				// Search loop
				echo '<section class="loop-wrap search-loop">';

					while(have_posts()) : the_post();
						$post_type = $post->post_type;

						switch($post_type){
							case 'post':
								get_template_part('loop');
								break;
							case 'page':
								get_template_part('loop', 'page');
								break;
							default:
								get_template_part('loop');
								break;
						}
						
					endwhile;

				echo '</section>';

				// Pagination
				include 'pagination.php';
				
				wp_reset_query();
				?>				
				
			<?php else : ?>

				<h1>No Results Found for: "<strong><?php echo get_search_query(); ?></strong>"</h1>

				<hr />

				<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>

				<div class="clear">
					<?php get_search_form(); ?>
				</div>

			<?php endif; ?>

		</div>

		<div class="col span-4">

			<?php get_sidebar('blog'); ?>

		</div>

	</div>
</section>

</main>

<?php get_footer(); ?>