<article class="loop-page">

	<h2><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

	<?php
	// Excerpt
	$excerpt = get_the_excerpt();
	if( $excerpt != '' ) $excerpt = $excerpt;
	if( $excerpt == '' ) $excerpt = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
	if( $excerpt ) echo '<p>' . $excerpt . '</p>';
	?>

	<a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>" class="button post-read">View page</a>

</article>
