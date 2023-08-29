<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>

	<section class="image_slider_section">
		<?php if ( patrika_is_frontpage() || ( ! is_home() && is_front_page() ) ) : ?>
			<?php if ( get_theme_mod( 'patrika_slider_activation' ) ) : ?>
		<div class="container">
			<div id="image-slider" class="carousel slide carousel-fade" data-ride="carousel">
				<div class="carousel-inner">
					<?php
							$patrika_slider_post_ids = get_theme_mod( 'patrika_slider_post_IDs_setting' );
					if ( ! empty( $patrika_slider_post_ids ) ) :
						$patrika_count = 0;
						$patrika_args  = array(
							'post_type' => 'post',
							'post__in'  => $patrika_slider_post_ids,
						);
						$patrika_query = new WP_Query( $patrika_args );
						if ( $patrika_query->have_posts() ) :
							while ( $patrika_query->have_posts() ) :
								$patrika_query->the_post();
								?>
					<div
						class="item carousel-item carousel-item-<?php echo esc_attr( $patrika_count ); ?> <?php echo ( 0 === $patrika_count ) ? 'active' : ''; ?>">
						<div class="category listing">
								<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>">
									<?php echo get_the_post_thumbnail(); ?>
							</a>
							<?php endif; ?>

							<div class="carousel-caption">
								<h3>
									<i class="fas fa-circle"
										style="color: <?php echo esc_attr( get_theme_mod( 'patrika_category_color_' . $category->term_id ) ); ?>"></i>
									<?php the_category( ', ' ); ?>
								</h3>
								<h1 class="entry-title">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h1>
								<?php the_excerpt(); ?>
								<span><?php echo get_the_date(); ?></span>
							</div>

						</div>
					</div>
								<?php
								$patrika_count++;
							endwhile;
						endif;
							endif;
					?>
				</div>
				<a class="carousel-control-prev" href="#image-slider" data-slide="prev">
					<i class="fas fa-chevron-left"></i>
				</a>
				<a class="carousel-control-next" href="#image-slider" data-slide="next">
					<i class="fas fa-chevron-right"></i>
				</a>
			</div>
		</div>

		<?php else : ?>
			<?php
				$patrika_header_image = get_theme_mod( 'patrika_header_image_setting' );
			if ( ! empty( $patrika_header_image ) ) :
				$patrika_query = new WP_Query(
					array(
						'post_type'     => 'page',
						'post__in'      => $patrika_header_image,
						'post_per_page' => 1,
					)
				);
				if ( $patrika_query->have_posts() ) :
					while ( $patrika_query->have_posts() ) :
						$patrika_query->the_post();
						?>
		<div class="container">
			<div class="background-image">
						<?php if ( has_post_thumbnail() ) : ?>
				<img src="<?php echo esc_url( the_post_thumbnail_url() ); ?>" alt="<?php the_title(); ?>">
				<?php endif; ?>
				<div class="background-content">
					<h1><?php the_title(); ?></h1>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'patrika' ); ?></a>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
					<?php
				endif;
				wp_reset_postdata();
				?>
		<?php endif; ?>
		<?php endif; ?>
		<?php endif; ?>

	</section>

	<div id="content">
