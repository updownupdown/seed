<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="utf-8" />

	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('url'); ?>/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('url'); ?>/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('url'); ?>/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('url'); ?>/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('url'); ?>/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('url'); ?>/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/apple-touch-icon-152x152.png" sizes="152x152" />
	<link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon-16x16.png" sizes="16x16" />
	<meta name="application-name" content="<?php bloginfo('name'); ?>"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="<?php bloginfo('url'); ?>/mstile-144x144.png" />

	<!-- Google Chrome Mobile Tab Color -->
	<!-- <meta name="theme-color" content="#db5945"> -->

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<!-- <link rel="pingback" href="< ?php bloginfo('pingback_url'); ?>" /> -->

	<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_url'); ?>/js/html5shiv.min.js"></script>
	<![endif]-->	

	<?php wp_head(); ?>

	<?php
	// Header Scripts
	$scripts_status = get_field('scripts_status', 'options');
	if( $scripts_status == 'live' ){
		echo get_field('header_scripts', 'options');
	}
	?>

</head>
<body <?php body_class(); ?>>


	<header id="sticky">

		<div id="sticky-top" class="sticky-show">

			<ul id="sticky-sec-menu">
				<li><a id="ssm-phone" href="tel:5551241234">555-123-1235</a></li>
				<li><a id="ssm-email" href="<?php bloginfo('url'); ?>/contact/">Email Us</a></li>
			</ul>

			<a id="sticky-search-toggle" class="sticky-toggle" href="javascript:void(0);"></a>
			<a id="sticky-hamburger" class="sticky-toggle" href="javascript:void(0);"><div><span></span><span></span><span></span><span></span></div></a>

		</div>

		<div id="sticky-slideout">

			<div id="sticky-search">
				<?php get_search_form(); ?>
			</div>

			<?php
			// Sticky nav
			wp_nav_menu( array(
				'menu' => 'Main Menu',
				'menu_id' => 'sticky-main-menu',
				'menu_class' => 'menu',
				'container' => false,
				'items_wrap' => '<ul id="%1$s" class="%2$s"><li><a href="' . get_bloginfo('url') . '">Home</a></li>%3$s</ul>'
			));
			?>

		</div>

		<div id="sticky-mask" class="sticky-toggle"></div>
		
	</header>


	<header id="nav">
		<div class="row">	
			<div class="col span_12">

				<div id="nav-inner">

					<?php /*
					<a id="nav-logo" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/image.svg" onerror="this.src='<?php bloginfo('template_url'); ?>/images/image.png';this.onerror=null;" width="" height="" alt="" /></a>
					*/ ?>

					<?php
					// Main nav
					wp_nav_menu( array(
						'menu' => 'Main Menu',
						'menu_id' => 'main-menu',
						'menu_class' => 'menu',
						'container' => false
					));
					?>

				</div>
			
			</div>
		</div>
	</header>


	<div id="nav-spacer"></div>