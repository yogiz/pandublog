<?php
/**
 * Custom hooks.
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'pandublog_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function pandublog_site_info() {
		do_action( 'pandublog_site_info' );
	}
}

if ( ! function_exists( 'pandublog_add_site_info' ) ) {
	add_action( 'pandublog_site_info', 'pandublog_add_site_info' );

	/**
	 * Add site info content.
	 */
	function pandublog_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'http://wordpress.org/', 'pandublog' ) ),
			sprintf(
				/* translators:*/
				esc_html__( 'Proudly powered by %s', 'pandublog' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators:*/
				esc_html__( 'Theme: %1$s by %2$s.', 'pandublog' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'http://pandublog.com', 'pandublog' ) ) . '">pandublog.com</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators:*/
				esc_html__( 'Version: %1$s', 'pandublog' ),
				$the_theme->get( 'Version' )
			)
		);

		echo apply_filters( 'pandublog_site_info_content', $site_info ); // WPCS: XSS ok.
	}
}
