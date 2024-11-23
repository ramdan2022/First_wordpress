<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<!--  bloginfo('name');  display information for blog  like name-->

	<title>
		<?php wp_title(':', true, 'right') ?>
		<?php bloginfo('name'); ?>
	</title>
	<link rel='pingback' href="<?php bloginfo('pingback_url'); ?> " />
	<?php wp_head(); ?>
</head>

<body class="body">

	<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
		<button class="menu-icon" type="button" data-toggle="example-menu"></button>
		<div class="title-bar-title">Menu</div>
	</div>

	<div class="top-bar" id="example-menu">
		<div class="top-bar-left">
			<?php Show_nav();  ?>

		</div>

	</div>