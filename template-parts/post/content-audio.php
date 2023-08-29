<?php
/**
 * Template part for displaying audio posts
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
	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
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
			};
				echo '</div><!-- .entry-meta -->';
		};
		?>
	</header><!-- .entry-header -->

	<?php
		$patrika_content = apply_filters( 'the_content', get_the_content() );
		$patrika_audio   = false;

		// Only get audio from the content if a playlist isn't present.
	if ( false === strpos( $patrika_content, 'wp-playlist-script' ) ) {
		$patrika_audio = get_media_embedded_in_content( $patrika_content, array( 'audio' ) );
	}

	?>

	<div class="entry-content">

		<?php
		if ( ! is_single() ) {

			// If not a single post, highlight the audio file.
			if ( ! empty( $patrika_audio ) ) {
				foreach ( $patrika_audio as $patrika_audio_html ) {
					echo '<div class="entry-audio">';
					echo wp_kses(
						$patrika_audio_html,
						array(
							'div'                 => array(
								'class'      => array(),
								'id'         => array(),
								'role'       => array(),
								'aria-label' => array(),
								'aria-live'  => array(),
								'tabindex'   => array(),
								'style'      => array(),
							),
							'mediaelementwrapper' => array(
								'id' => array(),
							),
							'audio'               => array(
								'class'   => array(),
								'id'      => array(),
								'preload' => array(),
								'src'     => array(),
							),
							'source'              => array(
								'type' => array(),
								'src'  => array(),
							),
							'a'                   => array(
								'class'         => array(),
								'href'          => array(),
								'aria-label'    => array(),
								'aria-valuemin' => array(),
								'aria-valuemax' => array(),
								'role'          => array(),
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
					echo '</div><!-- .entry-audio -->';
				}
			};

		};

		if ( is_single() || empty( $patrika_audio ) ) {

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
