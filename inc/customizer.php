<?php
/**
 * pandublog Theme Customizer
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'pandublog_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function pandublog_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'pandublog_customize_register' );

if ( ! function_exists( 'pandublog_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function pandublog_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'pandublog_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'pandublog' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'pandublog' ),
				'priority'    => 160,
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function pandublog_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

				// If the input is a valid key, return it; otherwise, return the default.
				return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'pandublog_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'pandublog_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pandublog_container_type',
				array(
					'label'       => __( 'Container Width', 'pandublog' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'pandublog' ),
					'section'     => 'pandublog_theme_layout_options',
					'settings'    => 'pandublog_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'pandublog' ),
						'container-fluid' => __( 'Full width container', 'pandublog' ),
					),
					'priority'    => '10',
				)
			)
		);

		$wp_customize->add_setting(
			'pandublog_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'pandublog_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'pandublog' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'pandublog'
					),
					'section'           => 'pandublog_theme_layout_options',
					'settings'          => 'pandublog_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'pandublog_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'pandublog' ),
						'left'  => __( 'Left sidebar', 'pandublog' ),
						'both'  => __( 'Left & Right sidebars', 'pandublog' ),
						'none'  => __( 'No sidebar', 'pandublog' ),
					),
					'priority'          => '20',
				)
			)
		);
	}
} // endif function_exists( 'pandublog_theme_customize_register' ).
add_action( 'customize_register', 'pandublog_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'pandublog_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function pandublog_customize_preview_js() {
		wp_enqueue_script(
			'pandublog_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'pandublog_customize_preview_js' );
