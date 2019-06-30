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

		// Footer.
		$wp_customize->add_section(
			'pandublog_footer',
			array(
				'title'       => __( 'Footer', 'pandublog' ),
				'capability'  => 'edit_theme_options',
				'description' => __( '', 'pandublog' ),
				'priority'    => 165,
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


		#######################  ygz  ##########################


		###   	Adding in color custumizer

	   // Primary
	    $wp_customize->add_setting( 'primary_color', array(
	      'default'   => '#6747c7',
	      'transport' => 'refresh',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
	      'section' => 'colors',
	      'label'   => esc_html__( 'Primary color', 'theme' ),
	    ) ) );

	    // secondary
	    $wp_customize->add_setting( 'secondary_color', array(
	      'default'   => '#5335af',
	      'transport' => 'refresh',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
	      'section' => 'colors',
	      'label'   => esc_html__( 'Secondary color', 'theme' ),
	    ) ) );


	    // Quote Background
	    $wp_customize->add_setting( 'quote_background', array(
	      'default'   => '#f4ebd3',
	      'transport' => 'refresh',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'quote_background', array(
	      'section' => 'colors',
	      'label'   => esc_html__( 'Quote Background', 'theme' ),
	    ) ) );

	   	// Quote text
	    $wp_customize->add_setting( 'quote_text', array(
	      'default'   => '#f4ebd3',
	      'transport' => 'refresh',
	    ) );

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'quote_text', array(
	      'section' => 'colors',
	      'label'   => esc_html__( 'Quote text', 'theme' ),
	    ) ) );


		// footer setting
		$wp_customize->add_setting( 'footer_text',
		   array(
		      'default' => '©2019, Pandublog Theme With Wordpress',
		      'transport' => 'postMessage',
		      'sanitize_callback' => 'wp_filter_nohtml_kses'
		   )
		);
		 
		$wp_customize->add_control( 'footer_text',
		   array(
		      'label' => __( 'Footer Text' ),
		      'description' => esc_html__( 'Set Footer Copyright Text' ),
		      'section' => 'pandublog_footer',
		      'priority' => 10, // Optional. Order priority to load the control. Default: 10
		      'type' => 'textarea', // Can be either text, email, url, number, hidden, or date
		      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
		      'input_attrs' => array( // Optional.
		         'class' => 'my-custom-class',
		         'style' => 'border: 1px solid rebeccapurple',
		         'placeholder' => __( 'Enter the text...' ),
		      ),
		   )
		);

	    $wp_customize->selective_refresh->add_partial('footer_text', array(
	        'selector' => 'p.copyright', // You can also select a css class
	    ));


		// footer social
		$wp_customize->add_setting( 'footer_facebook',
		   array(
		      'default' => 'https://www.facebook.com/',
		      'transport' => 'refresh',
		      'sanitize_callback' => 'skyrocket_text_sanitization'
		   )
		);
		 
		$wp_customize->add_control( 'footer_facebook',
		   array(
		      'label' => __( 'Facebook Link' ),
		      'section' => 'pandublog_footer',
		      'priority' => 10, // Optional. Order priority to load the control. Default: 10
		      'type' => 'text', // Can be either text, email, url, number, hidden, or date
		      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
		   )
		);

		$wp_customize->add_setting( 'footer_twitter',
		   array(
		      'default' => 'https://twitter.com/" ',
		      'transport' => 'refresh',
		      'sanitize_callback' => 'skyrocket_text_sanitization'
		   )
		);
		 
		$wp_customize->add_control( 'footer_twitter',
		   array(
		      'label' => __( 'Twitter Link' ),
		      'section' => 'pandublog_footer',
		      'priority' => 10, // Optional. Order priority to load the control. Default: 10
		      'type' => 'text', // Can be either text, email, url, number, hidden, or date
		      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
		   )
		);

		$wp_customize->add_setting( 'footer_youtube',
		   array(
		      'default' => 'https://www.youtube.com/',
		      'transport' => 'refresh',
		      'sanitize_callback' => 'skyrocket_text_sanitization'
		   )
		);
		 
		$wp_customize->add_control( 'footer_youtube',
		   array(
		      'label' => __( 'Youtube Link' ),
		      'section' => 'pandublog_footer',
		      'priority' => 10, // Optional. Order priority to load the control. Default: 10
		      'type' => 'text', // Can be either text, email, url, number, hidden, or date
		      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
		   )
		);


		$wp_customize->add_setting( 'footer_instagram',
		   array(
		      'default' => 'https://www.instagram.com/',
		      'transport' => 'refresh',
		      'sanitize_callback' => 'skyrocket_text_sanitization'
		   )
		);
		 
		$wp_customize->add_control( 'footer_instagram',
		   array(
		      'label' => __( 'Instagram Link' ),
		      'section' => 'pandublog_footer',
		      'priority' => 10, // Optional. Order priority to load the control. Default: 10
		      'type' => 'text', // Can be either text, email, url, number, hidden, or date
		      'capability' => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
		   )
		);


		$wp_customize->selective_refresh->add_partial('footer_facebook', array(
	        'selector' => 'li.social-facebook', // You can also select a css class
	    ));
		$wp_customize->selective_refresh->add_partial('footer_twitter', array(
	        'selector' => 'li.social-twitter', // You can also select a css class
	    ));
		$wp_customize->selective_refresh->add_partial('footer_youtube', array(
	        'selector' => 'li.social-youtube', // You can also select a css class
	    ));
		$wp_customize->selective_refresh->add_partial('footer_instagram', array(
	        'selector' => 'li.social-instagram', // You can also select a css class
	    ));
	    #######################  ygz  ########################## 

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















#############  ygz ##################################

# apply customizer column

function theme_get_customizer_css() {
	ob_start();
	$primary_color = get_theme_mod( 'primary_color', '' );
	if ( ! empty( $primary_color ) ) {
		?>
		.bg-primary, .btn-primary {
		    background-color:  <?php echo $primary_color; ?> !important;
		    border-color:  <?php echo $primary_color; ?> !important;
		}
		a {
			color:  <?php echo $primary_color; ?>;
		}
  		a:hover { border-bottom: 2px solid <?php echo $primary_color; ?>; }
  		.widget ul li a:hover { color : <?php echo $primary_color; ?>; border:0px!important;}

  		.site-footer .menu .menu-item:nth-last-child(1) a:hover {
  			color : <?php echo $primary_color; ?>!important;}

		<?php
	}


	$secondary_color = get_theme_mod( 'secondary_color', '' );
	if ( ! empty( $secondary_color ) ) {
		?>
		.secondary-color{
		    background-color:  <?php echo $secondary_color; ?> !important;
		    border-color:  <?php echo $secondary_color; ?> !important;
		    transition: border-bottom .15s ease-in;
		}
		<?php
	}


	$quote_background = get_theme_mod( 'quote_background', '' );
	if ( ! empty( $quote_background ) ) {
		?>
		.entry-content blockquote {
		    background-color:  <?php echo $quote_background; ?> !important;
		    transition: border-bottom .15s ease-in;
		}
		<?php
	}

	$quote_text = get_theme_mod( 'quote_text', '' );
	if ( ! empty( $quote_text ) ) {
		?>
		.entry-content blockquote, .entry-content blockquote:before {
		    color:  <?php echo $quote_text; ?> !important;
		}

		<?php
	}

    $css = ob_get_clean();
    return $css;
}


function theme_enqueue_styles() {
	wp_enqueue_style( 'theme-styles', get_stylesheet_uri() ); // This is where you enqueue your theme's main stylesheet
	$custom_css = theme_get_customizer_css();
	wp_add_inline_style( 'theme-styles', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

