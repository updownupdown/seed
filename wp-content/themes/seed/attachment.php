<?php get_header(); ?>

<main>

<section class="section-padding">
	<div class="row">
		<div class="col span-12">

			<h1>File Attachment</h1>

			<p><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><?php the_title(); ?></a></p>
			
			<hr />

			<?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>

			<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php $post->post_excerpt; ?>" /></a>

			<?php else : ?>

			<a href="<?php echo wp_get_attachment_url($post->ID) ?>" title="<?php echo wp_specialchars( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
			<?php endif; ?>

		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>