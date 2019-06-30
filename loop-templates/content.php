<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="row">

		<div class="col-lg-4 col-md-4 col-sm-4">
			<!-- Post thumbnail -->
			<?php if ( has_post_thumbnail() ) { 
				the_post_thumbnail();
				} else { ?>
				<img src="https://via.placeholder.com/300x200/6747c7/fff?text=..." alt="<?php the_title(); ?>" />
			<?php } ?>
		</div>

		<div class="content-archive col-lg-8 col-md-8 col-sm-8">

			<header class="entry-header">

				<?php
				the_title(
					sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h2>'
				);
				?>

				<?php if ( 'post' == get_post_type() ) : ?>

					<div class="entry-meta">
						<?php pandublog_posted_on(); ?>
					</div><!-- .entry-meta -->

				<?php endif; ?>

			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php the_excerpt(); ?>

				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'pandublog' ),
						'after'  => '</div>',
					)
				);
				?>

			</div><!-- .entry-content -->

	<!-- 		<footer class="entry-footer">

				<?php pandublog_entry_footer(); ?>

			</footer> -->
			<!-- .entry-footer -->
			
		</div>

	</div>

</article><!-- #post-## -->
