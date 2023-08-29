<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
			<div id="page-col" class="col-lg-12 single-col">
		<?php } else { ?>
			<div id="page-col" class="col-lg-8 single-col">
		<?php } ?>
			<main id="page-main" class="site-main">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/page/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #page-col -->
		<?php
		if ( 'null' !== $patrika_sidebar_position ) :
			get_sidebar();
		endif;
		?>
	</div><!-- .row -->
</div>

<?php
get_footer();
