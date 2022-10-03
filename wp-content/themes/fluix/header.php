<!doctype html>
<html class="no-js html" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="x-ua-compatible" content="IE=Edge" />

	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/roboto-v20-latin-regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/roboto-v20-latin-500.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/roboto-v29-latin-500italic.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/roboto-v20-latin-700.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/c49a6000-0e89-4b7c-948d-de48c656992f.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/70562c10-d8ab-42a5-888d-5c0e73ac7245.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/43bc1d39-e6ab-4d76-88b2-397cf5c92526.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri() . '/assets/fonts'; ?>/fluix-icons-v1.6.woff2" as="font" type="font/woff2" crossorigin="anonymous">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/* Calling the navigation.php file in the template-parts folder. */
	get_template_part('template-parts/navigation'); ?>