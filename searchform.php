<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

?>

<?php $patrika_unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form-row">
		<input type="search" id="<?php echo esc_attr( $patrika_unique_id ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'patrika' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

		<button class="btn btn-md"><i class="fa fa-search"></i></span>
			</button>
	</div>
</form>
