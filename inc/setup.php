<?php
/**
 * Theme basic setup.
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

add_action( 'after_setup_theme', 'pandublog_setup' );

if ( ! function_exists ( 'pandublog_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pandublog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pandublog, use a find and replace
		 * to change 'pandublog' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'pandublog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'head-top'=> __( 'Head 1' , 'pandublog'),
			'primary' => __( 'Head 2', 'pandublog' ),
			'head-bottom' => __( 'Head 3', 'pandublog' ),
			'footer' => __('Footer', 'pandublog')
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pandublog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Set up the WordPress Theme logo feature.
		add_theme_support( 'custom-logo' );
		
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Check and setup theme default settings.
		pandublog_setup_theme_default_settings();

	}
}


add_filter( 'excerpt_more', 'pandublog_custom_excerpt_more' );

if ( ! function_exists( 'pandublog_custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function pandublog_custom_excerpt_more( $more ) {
		if ( ! is_admin() ) {
			$more = '';
		}
		return $more;
	}
}

add_filter( 'wp_trim_excerpt', 'pandublog_all_excerpts_get_more_link' );

if ( ! function_exists( 'pandublog_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function pandublog_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . '...<p><a class="btn btn-secondary pandublog-read-more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Baca selengkapnya...',
			'pandublog' ) . '</a></p>';
		}
		return $post_excerpt;
	}
}


add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
