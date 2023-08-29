<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

?>
	<?php if ( get_theme_mod( 'patrika_show_footer_copyright' ) ) : ?>
		<?php
		$patrika_footer_copyright = get_theme_mod( 'patrika_footer_user_copyright' );

		?>
			<p class="patrika_site_copyright">
				<?php
				if ( ! empty( $patrika_footer_copyright ) ) :
					echo esc_html( get_theme_mod( 'patrika_footer_user_copyright' ) );
				endif;
				?>
			</p>
			<p class="patrika_site_copyright"> &copy; 
			<?php
			echo esc_html( date( 'Y' ) );
			echo ' ' . esc_html( get_bloginfo( 'name' ) );
			?>
			<span><?php echo esc_html( __( ' | Developed By ', 'patrika' ) ); ?></span><span><a href="<?php echo esc_url( __( 'http://www.themesmandu.com/', 'patrika' ) ); ?>" target="_blank"><?php echo esc_html( __( ' ThemesMandu.com', 'patrika' ) ); ?></a> </span> </p>

	<?php endif; ?>
