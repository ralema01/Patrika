<?php
/**
 * Template part for displaying video posts
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

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() && empty( $patrika_video ) ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'patrika-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			if ( is_single() ) {
				patrika_posted_on();
			} else {
				patrika_edit_link();
				echo wp_kses(
					patrika_time_link(),
					array(
						'time' => array(
							'class'    => array(),
							'datetime' => array(),
						),
						'a'    => array(
							'href' => array(),
							'rel'  => array(),
						),
					)
				);
			}
				echo '</div><!-- .entry-meta -->';
		};
		?>
	</header><!-- .entry-header -->

	<?php
		$patrika_content = apply_filters( 'the_content', get_the_content() );
		$patrika_video   = false;

		// Only get video from the content if a playlist isn't present.
	if ( false === strpos( $patrika_content, 'wp-playlist-script' ) ) {
		$patrika_video = get_media_embedded_in_content( $patrika_content, array( 'video', 'object', 'embed', 'iframe' ) );
	}
	?>

	<div class="entry-content">

		<?php
		if ( ! is_single() ) {

			// If not a single post, highlight the video file.
			if ( ! empty( $patrika_video ) ) {
				foreach ( $patrika_video as $patrika_video_html ) {
					echo '<div class="entry-video">';
						echo wp_kses(
							$patrika_video_html,
							array(
								'div'                 => array(
									'class'        => array(),
									'id'           => array(),
									'role'         => array(),
									'aria-label'   => array(),
									'aria-pressed' => array(),
									'aria-live'    => array(),
									'tabindex'     => array(),
									'style'        => array(),
								),
								'mediaelementwrapper' => array(
									'id' => array(),
								),
								'video'               => array(
									'class'   => array(),
									'id'      => array(),
									'width'   => array(),
									'height'  => array(),
									'preload' => array(),
									'src'     => array(),
									'style'   => array(),
								),
								'source'              => array(
									'type' => array(),
									'src'  => array(),
								),
								'a'                   => array(
									'class'            => array(),
									'href'             => array(),
									'aria-label'       => array(),
									'aria-valuemin'    => array(),
									'aria-valuemax'    => array(),
									'aria-orientation' => array(),
									'aria-valuenow'    => array(),
									'aria-valuetext'   => array(),
									'role'             => array(),
								),
								'span'                => array(
									'class'          => array(),
									'role'           => array(),
									'tabindex'       => array(),
									'aria-label'     => array(),
									'aria-valuemin'  => array(),
									'aria-valuemax'  => array(),
									'aria-valuenow'  => array(),
									'aria-valuetext' => array(),
									'style'          => array(),
								),
								'button'              => array(
									'type'          => array(),
									'aria-controls' => array(),
									'title'         => array(),
									'aria-label'    => array(),
									'tabindex'      => array(),
								),
							)
						);
					echo '</div>';
				}
			};

		};

		if ( is_single() || empty( $patrika_video ) ) {

			the_content(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'patrika' ),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'patrika' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			);
		};
		?>

	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		patrika_entry_footer();
	}
	?>

</article><!-- #post-## -->
