<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'pandublog_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>




<footer class="wrapper bg-primary" id="wrapper-footer">

	<div class="container site-footer">

		<div class="row logo-menu">

			<div class="site-logo">

					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>


					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->
			</div><!-- .site-info -->

			<?php
				wp_nav_menu( array( 
				    'theme_location' => 'footer', 
				    'container_class' => 'site-nav nav-footer'
				) ); 
			?>
		</div><!-- row end -->


		<div class="row copy-sm">
			<div class="copy">
				<p class="copyright"><?php echo get_theme_mod( 'footer_text', '©2019, Pandublog Theme With Wordpress' ); ?></p>
			</div>

			<div class="sm">
				<span class="title">Follow me around the web</span>
				<ul class="menu-social-media">
					<li class="menu-item social-facebook">
						<a href="<?php echo get_theme_mod( 'footer_facebook', 'https://www.facebook.com/' ); ?>" target="_blank">
							<i class="fa fa-facebook-square"></i>
						</a>
					</li>
					<li class="menu-item social-twitter">
						<a href="<?php echo get_theme_mod( 'footer_twitter', 'https://www.twitter.com/' ); ?>" target="_blank">
							<i class="fa fa-twitter-square"></i>
						</a>
					</li>
					<li class="menu-item social-youtube">
						<a href="<?php echo get_theme_mod( 'footer_youtube', 'https://www.youtube.com/' ); ?>" target="_blank">
							<i class="fa fa-youtube-square"></i>
						</a>
					</li>
					<li class="menu-item social-instagram">
						<a href="<?php echo get_theme_mod( 'footer_instagram', 'https://www.instagram.com/' ); ?>" target="_blank">
							<i class="fa fa-instagram"></i>
						</a>
					</li>
				</ul>
			</div>
			
		</div>

	</div><!-- container end -->

</footer><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>





