<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="container">
	<?php
	$patrika_sidebar_position = get_theme_mod( 'patrika_sidebar_option' );
	if ( is_active_sidebar( 'sidebar-1' ) ) :
		if ( 'left' === $patrika_sidebar_position ) :
			$patrika_class = 'left-sidebar';
		elseif ( 'right' === $patrika_sidebar_position ) :
			$patrika_class = '';
		elseif ( '' === $patrika_sidebar_position || 'null' === $patrika_sidebar_position ) :
			$patrika_class = '';
		endif;
	endif;
	?>

<div class="row <?php echo esc_attr( $patrika_class ); ?>">
	<?php if ( ! is_active_sidebar( 'sidebar-1' ) || 'null' === $patrika_sidebar_position || empty( $patrika_sidebar_position ) ) { ?>
		<div id="single-col" class="col-lg-12 single-col">
	<?php } else { ?>
		<div id="single-col" class="col-lg-8 single-col">
	<?php } ?>
		<div id="single-main" class="site-main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation(
					array(
						'prev_text' => '<span class="screen-reader-text"> &larr; ' . __( 'Previous Post', 'patrika' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . __( ' Next Post', 'patrika' ) . '&rarr; </span>',
					)
				);

			endwhile; // End of the loop.
			?>

		</div><!-- #main -->
	</div><!-- .col-sm-7 -->
	<?php
	if ( 'null' !== $patrika_sidebar_position ) :
		get_sidebar();
		endif;
	?>
</div><!-- .row -->
</div>

<?php
get_footer();
