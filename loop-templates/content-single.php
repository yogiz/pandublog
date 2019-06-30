<?php
/**
 * Single post partial template.
 *
 * @package pandublog
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php 






?>








<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<div class="right-author-card">
	<img src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ));  ?>" width="112" height="112" alt="Eglė Goleckytė" class="avatar">
	<a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );  ?>"><?php echo get_the_author_meta( 'display_name' );  ?></a>
	<div class="tambah-komen">
		<a href="#comments">Komentar</a>
	</div>
</div>

	<header class="entry-header">

		<div class="head-category"><?php the_category( ', ' ); ?></div>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php pandublog_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pandublog' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php pandublog_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
