<?php
/**
 * pandublog enqueue scripts
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'pandublog_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function pandublog_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.css' );
		wp_enqueue_style( 'pandublog-styles', get_template_directory_uri() . '/css/theme.css', array(), $css_version );

		wp_enqueue_style( 'pandublog-adding-styles', get_template_directory_uri() . '/css/theme-adding.css' );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.js' );
		wp_enqueue_script( 'pandublog-scripts', get_template_directory_uri() . '/js/theme.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'pandublog_scripts' ).

add_action( 'wp_enqueue_scripts', 'pandublog_scripts' );
