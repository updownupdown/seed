<?php get_header(); ?>

<main>

<section class="section-padding">
	<div class="row">
		<div class="col span-12">

			<h1 class="light less-bottom-padding"><strong>404 Error</strong><br />
			<small>Page Not Found</small></h1>

			<hr />

			<p class="more-bottom-padding">Oops, we can't find the page you are looking for.<br />
				This may be because of a <strong>mistyped URL</strong>, <strong>faulty referral</strong> or <strong>out-of-date search engine listing</strong>.<br />
				Try the <a href="<?php bloginfo('url'); ?>">home page</a> instead.</p>

			<a href="<?php bloginfo('url'); ?>" class="button">Home Page</a>

		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>