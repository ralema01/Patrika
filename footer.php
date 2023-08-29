<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.2
 */

?>
</div><!-- #content -->

<?php if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-5' ) ) { ?>

	<div id="footer">
	<div class="container">

		<div class="row footer-row">
			<div class="col-lg-4 footer-widget-one">

				<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
				<div class="widget-column footer-widget-1">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
				<?php } ?>

				<section class="footer-social-icons">
					<?php if ( get_theme_mod( 'patrika_show_social_icons' ) === '1' ) : ?>
					<div class="social-icons">
						<?php
						$patrika_facebook = get_theme_mod( 'patrika_facebook' );
						if ( ! empty( $patrika_facebook ) ) :
							?>
						<a class="facebook" href="<?php echo esc_url( get_theme_mod( 'patrika_facebook' ) ) ? esc_url( get_theme_mod( 'patrika_facebook' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-facebook-f"></i></a>
						<?php endif; ?>

						<?php
						$patrika_plus_google = get_theme_mod( 'patrika_plus_google' );
						if ( ! empty( $patrika_plus_google ) ) :
							?>
						<a class="google-plus-g" href="<?php echo esc_url( get_theme_mod( 'patrika_plus_google' ) ) ? esc_url( get_theme_mod( 'patrika_plus_google' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-google-plus-g"></i></a>
						<?php endif; ?>

						<?php
						$patrika_behance = get_theme_mod( 'patrika_behance' );
						if ( ! empty( $patrika_behance ) ) :
							?>
						<a class="behance" href="<?php echo esc_html( get_theme_mod( 'patrika_behance' ) ) ? esc_url( get_theme_mod( 'patrika_behance' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-behance"></i></a>
							<?php endif; ?>

						<?php
						$patrika_vimeo = get_theme_mod( 'patrika_vimeo' );
						if ( ! empty( $patrika_vimeo ) ) :
							?>
						<a class="vimeo" href="<?php echo esc_html( get_theme_mod( 'patrika_vimeo' ) ) ? esc_url( get_theme_mod( 'patrika_vimeo' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-vimeo"></i></a>
						<?php endif; ?>

						<?php
						$patrika_tumblr = get_theme_mod( 'patrika_tumblr' );
						if ( ! empty( $patrika_tumblr ) ) :
							?>
						<a class="tumblr" href="<?php echo esc_html( get_theme_mod( 'patrika_tumblr' ) ) ? esc_url( get_theme_mod( 'patrika_tumblr' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-tumblr"></i></a>
						<?php endif; ?>

						<?php
						$patrika_linkedin = get_theme_mod( 'patrika_linkedin' );
						if ( ! empty( $patrika_linkedin ) ) :
							?>
						<a class="linkedin-in" href="<?php echo esc_url( get_theme_mod( 'patrika_linkedin' ) ) ? esc_url( get_theme_mod( 'patrika_linkedin' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-linkedin-in"></i></a>
						<?php endif; ?>

						<?php
						$patrika_twitter = get_theme_mod( 'patrika_twitter' );
						if ( ! empty( $patrika_twitter ) ) :
							?>
						<a class="twitter" href="<?php echo esc_url( get_theme_mod( 'patrika_twitter' ) ) ? esc_url( get_theme_mod( 'patrika_twitter' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-twitter"></i></a>
						<?php endif; ?>

						<?php
						$patrika_instagram = get_theme_mod( 'patrika_instagram' );
						if ( ! empty( $patrika_instagram ) ) :
							?>
						<a class="instagram" href="<?php echo esc_url( get_theme_mod( 'patrika_instagram' ) ) ? esc_url( get_theme_mod( 'patrika_instagram' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-instagram"></i></a>
						<?php endif; ?>

						<?php
						$patrika_youtube = get_theme_mod( 'patrika_youtube' );
						if ( ! empty( $patrika_youtube ) ) :
							?>
						<a class="youtube" href="<?php echo esc_url( get_theme_mod( 'patrika_youtube' ) ) ? esc_url( get_theme_mod( 'patrika_youtube' ) ) : '#'; ?>" target = "_blank"><i class="fab fa-youtube"></i></a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</section>

			</div>

			<div class="col-lg-4 footer-widget-two">

				<?php if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
				<div class="widget-column footer-widget-2">
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
				<?php } ?>

			</div>

			<div class="col-lg-4 footer-widget-three">

				<?php if ( is_active_sidebar( 'sidebar-5' ) ) { ?>
				<div class="widget-column footer-widget-3">
					<?php dynamic_sidebar( 'sidebar-5' ); ?>
				</div>
				<?php } ?>

			</div>

			</div>
	</div><!-- .container -->
	</div><!-- #footer -->

<?php } ?>


	<div class="last_footer">
	<div class="container">
		<?php
		get_template_part( 'template-parts/footer/site', 'info' );
		if ( get_theme_mod( 'patrika_to_the_top' ) ) :
			?>
		<button id="up-btn" title="<?php echo esc_html( __( 'Go to top', 'patrika' ) ); ?>" style="display: block;">&uarr;</button>
			<?php endif; ?>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
		<div class="footer-menu">
			<?php
			if ( has_nav_menu( 'footer' ) ) :
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'footer-nav',
					)
				);
				?>
		</div>
		<?php endif; ?>
	</div>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
