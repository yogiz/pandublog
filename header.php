<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'pandublog_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'pandublog' ); ?></a>

			<div class="navbar navbar-expand-md navbar-dark navbar-top secondary-color d-none d-md-flex d-lg-flex">
				<div class="container">
					<div class="top-menu">
						<div class="top-menu-box">
						<?php wp_nav_menu(
								array(
									'theme_location'  => 'head-top',
									'container_class' => '',
									'container_id'    => 'navbarTop',
									'menu_class'      => 'navbar-nav head-top',
									'fallback_cb'     => '',
									'menu_id'         => 'top-menu',
									'depth'           => 2,
									'walker'          => new pandublog_WP_Bootstrap_Navwalker(),
								)
						); ?>
						</div>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-expand-md navbar-primary navbar-dark bg-primary">
				<div class="container">
					<div class="baris primary-menu">
						<!-- Your site title as branding in the menu -->
							<?php if ( ! has_custom_logo() ) { ?>

								<?php if ( is_front_page() && is_home() ) : ?>

									<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

								<?php else : ?>

									<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

								<?php endif; ?>


							<?php } else {
								the_custom_logo();
							} ?><!-- end custom logo -->
						<div class="primary-menu-box">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'pandublog' ); ?>">
								<span class="navbar-toggler-icon"></span>
							</button>

							<!-- The WordPress Menu goes here -->
							<?php wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'navbarNavDropdown',
									'menu_class'      => 'navbar-nav ml-auto',
									'fallback_cb'     => '',
									'menu_id'         => 'main-menu',
									'depth'           => 2,
									'walker'          => new pandublog_WP_Bootstrap_Navwalker(),
								)
							); ?>
						</div>
					</div>
				</div>
			</nav>
			<div class="navbar navbar-expand-md navbar-bottom navbar-dark secondary-color d-none d-md-flex d-lg-flex">
				<div class="container">
					<div class="bottom-menu">
						<?php wp_nav_menu(
								array(
									'theme_location'  => 'head-bottom',
									'container_class' => '',
									'container_id'    => 'navbarBottom',
									'menu_class'      => 'navbar-nav head-bottom',
									'fallback_cb'     => '',
									'menu_id'         => 'bottom-menu',
									'depth'           => 2,
									'walker'          => new pandublog_WP_Bootstrap_Navwalker(),
								)
						); ?>
					</div>
				</div>
			</div>
	
	</div><!-- #wrapper-navbar end -->
