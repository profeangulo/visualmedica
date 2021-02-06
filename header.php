<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Chrome, Firefox OS, Opera and Vivaldi -->
    <meta name="theme-color" content="<?php echo getbowtied_theme_option( 'header_background_color', '#23282d' ); ?>">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="<?php echo getbowtied_theme_option( 'header_background_color', '#23282d' ); ?>">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="<?php echo getbowtied_theme_option( 'header_background_color', '#23282d' ); ?>">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body <?php body_class(); ?>>

    <?php get_template_part( 'header', 'default' ); ?>
    <?php get_template_part( 'header', 'mobiles' ); ?>

    <div class="offcanvas_container">

        <div class="offcanvas_main_content">

            <div class="page-wrapper">

            	<div class="site-content">
