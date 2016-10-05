<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"?>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=10" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id='header'>

		<div class='limit-perfection'>
			<?php

				get_template_part( 'header-templates/header', 'default' );

			?>
		</div>
	</div>

<?php if (function_exists('perfection_render_slider')) perfection_render_slider(); ?>

<?php if (function_exists('perfection_video_slider')) perfection_video_slider(); ?>

<?php if (function_exists('perfection_breadcrumbs')) perfection_breadcrumbs(); ?>