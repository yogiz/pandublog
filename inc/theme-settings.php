<?php
/**
 * Check and setup theme's default settings
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'pandublog_setup_theme_default_settings' ) ) {
	function pandublog_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$pandublog_posts_index_style = get_theme_mod( 'pandublog_posts_index_style' );
		if ( '' == $pandublog_posts_index_style ) {
			set_theme_mod( 'pandublog_posts_index_style', 'default' );
		}

		// Sidebar position.
		$pandublog_sidebar_position = get_theme_mod( 'pandublog_sidebar_position' );
		if ( '' == $pandublog_sidebar_position ) {
			set_theme_mod( 'pandublog_sidebar_position', 'right' );
		}

		// Container width.
		$pandublog_container_type = get_theme_mod( 'pandublog_container_type' );
		if ( '' == $pandublog_container_type ) {
			set_theme_mod( 'pandublog_container_type', 'container' );
		}
	}
}
