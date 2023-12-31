<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="col-lg-4 all-sidebar" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'patrika' ); ?>">
	<?php
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		dynamic_sidebar( 'sidebar-1' );
	}
	?>
</div>
