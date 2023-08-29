<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-heading">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php patrika_edit_link( get_the_ID() ); ?>
	</header><!-- .entry-header -->

	<div class="featured-image">
		<?php echo get_the_post_thumbnail( get_queried_object_id(), 'patrika-featured-image' ); ?>
	</div><!-- .featured-image -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'patrika' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
