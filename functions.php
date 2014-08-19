<?php
/**
 * Theme Functions
 *
 * @package    Ken and Hazel Hobbs
 * @subpackage  Genesis
 * @copyright   Copyright (c) 2014, Genesis Goodies
 * @license     GPL-2.0+
 * @since       0.1.0
 */

/**
 * Set Localization (do not remove).
 *
 * @since  0.1.0
 * @todo   change ken-and-hazel-hobbs to your child theme text domain.
 * @todo   change ken_and_hazel_hobbs to your child theme prefix.
 */
load_child_theme_textdomain( 'ken-and-hazel-hobbs', apply_filters( 'ken_and_hazel_hobbs_textdomain', get_stylesheet_directory() . '/languages', 'ken-and-hazel-hobbs' ) );

add_action( 'genesis_setup', 'ken_and_hazel_hobbs_setup', 15 );
/**
 * Set up the theme.
 *
 * @since  0.1.0
 * @todo   change ken_and_hazel_hobbs to your child theme prefix.
 */
function ken_and_hazel_hobbs_setup() {
	$ken_and_hazel_hobbs = wp_get_theme();

	//* Child theme (do not remove)
	define( 'CHILD_THEME_NAME', 'Ken and Hazel Hobbs' );
	define( 'CHILD_THEME_URL', 'http://genesisgoodies.com' );
	define( 'CHILD_THEME_VERSION', $ken_and_hazel_hobbs->get( 'Version' ) );

	//* Add HTML5 markup structure.
	add_theme_support( 'html5' );

	//* Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );

	//* Add support for custom background.
	add_theme_support( 'custom-background' );

	//* Add support for 3-column footer widgets.
	add_theme_support( 'genesis-footer-widgets', 3 );

	//* add support for After Entry Widget Area
	add_theme_support( 'genesis-after-entry-widget-area' );

	//* Reposition the secondary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

	//* Load the favicon from the assets folder.
	add_filter( 'genesis_pre_load_favicon', 'ken_and_hazel_hobbs_load_favicon' );

	//* Enqueue all required child theme CSS files.
	add_action( 'wp_enqueue_scripts', 'ken_and_hazel_hobbs_enqueue_styles' );

	//* Remove comment form allowed tags
	add_filter( 'comment_form_defaults', 'generate_remove_comment_form_allowed_tags' );
	function generate_remove_comment_form_allowed_tags( $defaults ) {

		$defaults['comment_notes_after'] = '';
		return $defaults;

	}
}

/**
 * Load the favicon from the assets folder.
 *
 * @param  string favicon url
 * @return string modified favicon uri
 * @since  0.1.0
 * @todo   change ken_and_hazel_hobbs to your child theme prefix.
 */
function ken_and_hazel_hobbs_load_favicon( $favicon ) {
	$favicon = get_stylesheet_directory_uri() . '/assets/images/favicon.ico';
	return $favicon;
}

/**
 * Thumbnails
 *
 * @since 0.1.0
 */
add_image_size( 'child-thumb-1', 1600, 1000 );
add_image_size( 'child-thumb-2', 1200, 750 );
add_image_size( 'child-thumb-3', 800, 500 );
add_image_size( 'child-thumb-4', 400, 250 );
add_image_size( 'child-thumb-5', 1200, 450, true );

/**
 * Enqueue all required child theme CSS and JS files.
 *
 * @since  0.1.0
 *
 */
function ken_and_hazel_hobbs_enqueue_styles() {

	// Load TypeKit Fonts To Genesis Child Theme
	wp_enqueue_script( 'ken-and-hazel-hobbs-typekit', '//use.typekit.net/avr8slc.js', array(), '1.0.0' );

	// Load Dashicons
	wp_enqueue_style( 'dashicons' );

	// Load Font Awesome styles.
	wp_enqueue_style( 'ken-and-hazel-hobbs-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css', array(), '4.1.0' );

}
