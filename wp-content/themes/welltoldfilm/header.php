<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WellToldFilm
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!--Media Element-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.23.4/mediaelementplayer.min.css" />
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'welltoldfilm' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'components/navigation/navigation', 'top' ); ?>

		<?php welltoldfilm_social_menu(); ?>
		
	</header>
	<div id="content" class="site-content">
