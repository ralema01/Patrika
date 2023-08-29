<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

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

<div class="container">

	<div class="page-heading">
		<?php if ( have_posts() ) : ?>
		<h1 class="page-title">
			<?php /* translators: %s: search term */ ?>
			<?php printf( esc_html_e( 'Search Results for: %s', 'patrika' ), '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
		<?php else : ?>
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'patrika' ); ?></h1>
		<?php endif; ?>
	</div><!-- .page-heading -->
	<div class="row <?php echo esc_attr( $patrika_class ); ?>">
		<?php if ( ! is_active_sidebar( 'sidebar-1' ) || 'null' === $patrika_sidebar_position || empty( $patrika_sidebar_position ) ) : ?>
		<div id="main-col" class="col-lg-12 search-col">
			<?php else : ?>
			<div id="main-col" class="col-lg-8 search-col">
				<?php endif; ?>
				<div id="search-main" class="site-main">

					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/post/content', 'excerpt' );

						endwhile; // End of the loop.

						the_posts_pagination(
							array(
								'prev_text'          => patrika_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'patrika' ) . '</span>',
								'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'patrika' ) . '</span>' . patrika_get_svg( array( 'icon' => 'arrow-right' ) ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'patrika' ) . ' </span>',
							)
						);

						else :
							?>

					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'patrika' ); ?>
					</p>
							<?php
							get_search_form();

				endif;
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
