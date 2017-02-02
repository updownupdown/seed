<?php get_header(); ?>

<main>

<section class="section-padding">
	<div class="row">

		<div class="col span_8 col-margin">

			<h1>Blog</h1>

			<?php
			// If category or tag page, or author page
			$queried = $wp_query->queried_object;
			$queried_term = $queried->name;
			$queried_author = $queried->display_name;

			if($queried_term || $queried_author){

				if( $queried->taxonomy == 'category' ){

					$queried_kind = 'Posts categorized under';
					$queried_keyword = $queried_term;

				} elseif( $queried->taxonomy == 'post_tag' ) {

					$queried_kind = 'Posts tagged with';
					$queried_keyword = $queried_term;

				} elseif( $queried_author ){

					$queried_kind = 'Posts written by';
					$queried_keyword = $queried_author;

				}

				echo '<h3 class="blog-term-author">' . $queried_kind . ' <span>"' . $queried_keyword . '"</span></h3>';

			}
			?>

			<?php
			if(have_posts()):

				echo '<section class="loop-wrap index-loop">';

					while ( have_posts() ) : the_post();
						get_template_part('loop'); 
					endwhile;
				
				echo '</section>';

				include 'pagination.php';
			
			endif;

			wp_reset_query();			
			?>
		</div>

		<div class="col span_4">

			<?php get_sidebar('blog'); ?>

		</div>

	</div>
</section>

</main>

<?php get_footer(); ?>