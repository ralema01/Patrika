<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.2
 */

?>
<div class="wholebackgroundoverlay">

</div>

<nav class="navbar navbar-expand-lg main-navigation menu-navigation" id="main-nav" aria-label="<?php esc_attr_e( 'Top Menu', 'patrika' ); ?>">

	<div class="container">

		<?php
		if ( function_exists( 'the_custom_logo' ) ) :
			if ( has_custom_logo() ) :
				the_custom_logo();
			else :
				?>
				<a class="navbar-brand" href = '<?php echo esc_url( get_site_url() ); ?>' ><?php echo bloginfo( 'name' ); ?></a>
				<?php
			endif;
		endif;
		?>

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
			<button class="navbar-button" data-target="#collapsecollapse">
				<span></span>
				<span></span>
				<span></span>
			</button>
		<?php } ?>

		<button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span></span>
			<span></span>
			<span></span>
		</button>

		<div class="collapse navbar-collapse" id="collapsibleNavbar">

			<?php
			if ( has_nav_menu( 'top' ) ) :
				wp_nav_menu(
					array(
						'theme_location' => 'top',
						'menu_id'        => 'top-menu',
						'menu_class'     => 'nav navbar-nav',
					)
				);
			endif;
			?>
		</div>

	</div>

</nav>

<?php if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
	<div class="side-menu-open" id="collapsecollapse">
		<button class="navbar-button navbar-button-inside" data-target="#collapsecollapse">
			<span></span>
			<span></span>
			<span></span>
		</button>
		<div class="widget-column navbar-widget">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div>
	</div>
<?php } ?>
