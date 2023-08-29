<?php
/**
 * The template for displaying archive pages
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

	<?php if ( have_posts() ) : ?>
		<header class="page-heading">
			<?php
				echo '<h1 class="page-title">' . single_cat_title( '', false ) . '</h1>';
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>
	<div class="row <?php echo esc_html( $patrika_class ); ?>">
		<?php if ( ! is_active_sidebar( 'sidebar-1' ) || 'null' === $patrika_sidebar_position || empty( $patrika_sidebar_position ) ) : ?>
			<div id="archive-col" class="col-lg-12 single-col">
		<?php else : ?>
			<div id="archive-col" class="col-lg-8 single-col">
		<?php endif; ?>
			<div id="archive-main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :
				?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile;

				the_posts_pagination(
					array(
						'prev_text' => '<span class="screen-reader-text"> &larr; ' . __( 'Previous Post', 'patrika' ) . '</span>',
						'next_text' => '<span class="screen-reader-text">' . __( ' Next Post', 'patrika' ) . '&rarr; </span>',
					)
				);

				else :

					get_template_part( 'template-parts/post/content', 'none' );

			endif;
				?>

			</div><!-- #main -->
		</div><!-- #archive-col -->
		<?php
		if ( 'null' !== $patrika_sidebar_position ) :
			get_sidebar();
		endif;
		?>
	</div><!-- .row -->
</div>

<?php
get_footer();
