<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="featured-image">
				<?php if ( ! is_single() ) : ?>
				<a href="<?php the_permalink(); ?>">
				<?php endif; ?>
					<?php the_post_thumbnail( 'patrika-featured-image' ); ?>
				<?php if ( ! is_single() ) : ?>
				</a>
				<?php endif; ?>
			</div><!-- .featured-image -->

			<div class="entry-content">
				<div class="entry-header">
					<?php
					if ( is_single() ) {
						the_title( '<h1 class="entry-title">', '</h1>' );
					} elseif ( is_front_page() && is_home() ) {
						patrika_entry_footer();
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					} else {
						patrika_entry_footer();
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					}
					if ( is_single() ) {
						if ( 'post' === get_post_type() ) {
							echo '<div class="entry-meta">';
							patrika_posted_on();
							patrika_entry_footer();
							echo '</div><!-- .entry-meta -->';
						}
					};
					?>
				</div><!-- .entry-header -->
				<?php
				/* translators: %s: Name of current post */
				the_content(
					sprintf(
						__( '...', 'patrika' )
					)
				);

				if ( ! is_single() ) {
					if ( 'post' === get_post_type() ) {
						echo '<div class="entry-meta">';
						patrika_posted_on();
						patrika_edit_link();
					}
				};

				wp_link_pages(
					array(
						'before'      => '<div class="page-links">' . __( 'Pages:', 'patrika' ),
						'after'       => '</div>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					)
				);
				?>
			</div><!-- .entry-content -->

</article><!-- #post-## -->
