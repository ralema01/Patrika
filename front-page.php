<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<?php
	$patrika_cat_id = patrika_get_theme_mod( 'patrika_homepage_category_blog_', 2 );
	if ( ! empty( $patrika_cat_id ) ) :
		$patrika_section_id = [ 'one', 'two' ];
		$patrika_count      = count( $patrika_cat_id );
		for ( $i = 0; $i < $patrika_count; $i++ ) :
			$patrika_category = $patrika_cat_id[ $i ];
			?>
			<section class="section-<?php echo esc_attr( $patrika_section_id[ $i ] ); ?>">
				<div class="container">
					<div class="cata-heading">
						<h1><?php echo esc_attr( get_cat_name( $patrika_category ) ); ?></h1>
						<a href="<?php echo esc_url( get_category_link( $patrika_category ) ); ?>"><?php esc_html_e( 'View All', 'patrika' ); ?></a>
					</div>
					<div class="row">
						<?php
						$patrika_args              = array(
							'post_type'      => 'post',
							'posts_per_page' => 4,
							'category__in'   => $patrika_category,
						);
								$patrika_query = new WP_Query( $patrika_args );
						while ( $patrika_query->have_posts() ) :
							$patrika_query->the_post();
							?>
							<div class="col-lg-3 col-sm-6 blog-column">
								<div class="hover-effect-image">
									<a href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_post_thumbnail(); ?>
										<div class="entry-featuredImg-border"></div>
									</a>
								</div>

								<a class="blog-heading" href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
								<?php the_excerpt(); ?>
							</div>
							<?php
						endwhile;
								wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
		<?php endfor; ?>

	<?php endif; ?>

	<section class="section-three">
		<div class="container">
			<div class="cata-heading">
				<h1><?php echo esc_html( __( 'More From Us', 'patrika' ) ); ?></h1>
			</div>
			<div class="row">

				<?php
				// Define our WP Query Parameters.
				$patrika_args      = array(
					'post_type'      => 'post',
					'posts_per_page' => '6',
					'orderby'        => 'post_date',
					'order'          => 'DESC',
				);
				$patrika_query = new WP_Query( $patrika_args );
				// Start our WP Query.
				while ( $patrika_query->have_posts() ) :
					$patrika_query->the_post();
					$patrika_post_id = get_the_ID();
					?>
					<div class="col-lg-4 col-sm-6 blog-section">
						<div class="blog-column">
							<div class="blog-column-image">
								<a href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_post_thumbnail(); ?>
									<div class="entry-featuredImg-border"></div>
								</a>
							</div>

							<div class="blog-column-content">
								<?php
								$patrika_categories = get_the_category();
								foreach ( $patrika_categories as $patrika_category ) :
									?>
									<cdata class="post-category" style="background-color:<?php echo esc_attr( get_theme_mod( 'patrika_category_color_' . $patrika_category->term_id ) ); ?>">
										<?php echo esc_attr( $patrika_category->name ); ?>
									</cdata>
								<?php endforeach; ?>

								<a class="blog-heading" href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>

								<span class="post-author"><i class="far fa-user"></i><?php echo get_the_author(); ?></span>

								<span class="post-date"><i class="far fa-clock"></i><?php echo get_the_date(); ?></span>
							</div>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>

	<?php
	$patrika_cat_id = get_theme_mod( 'patrika_homepage_category_blog_3' );
	if ( ! empty( $patrika_cat_id ) ) :
		?>
		<section class="section-four">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-8">
						<?php
						$patrika_args      = array(
							'post_type'      => 'post',
							'posts_per_page' => 2,
							'category__in'   => $patrika_cat_id,
						);
						$patrika_query = new WP_Query( $patrika_args );
						while ( $patrika_query->have_posts() ) :
							$patrika_query->the_post();
							?>
							<div class="blog-column">
								<div class="blog-column-image">
									<a href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_post_thumbnail(); ?>
										<div class="entry-featuredImg-border"></div>
									</a>
								</div>

								<div class="blog-column-content">
									<?php
									foreach ( ( get_the_category() ) as $patrika_category ) :
										?>
										<cdata class="post-category" style="background-color:<?php echo esc_attr( get_theme_mod( 'patrika_category_color_' . $patrika_category->term_id ) ); ?>">
											<?php echo esc_attr( $patrika_category->name ); ?>
										</cdata>
									<?php endforeach; ?>

									<a class="blog-heading" href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
															<?php the_excerpt(); ?>
									<div class="cata-description">
										<span class="post-author"><?php echo get_the_author(); ?></span>
										<span class="post-date"><?php echo get_the_date(); ?></span>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
					<div class="col-lg-3 col-md-4">
						<?php if ( is_active_sidebar( 'sidebar-6' ) ) { ?>
							<div class="widget-column footer-widget-6">
								<?php dynamic_sidebar( 'sidebar-6' ); ?>
							</div>
							<?php } ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

<?php
get_footer();
