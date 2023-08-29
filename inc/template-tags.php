<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 */

if ( ! function_exists( 'patrika_post_comments' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function patrika_post_comments() {

		// Get the author name; wrap it in a link.
		// $post_comment = sprintf(.

		/*
		Translators: %s: post author
		*/
		?><span class="post-comments"><i class="far fa-comments"></i><?php comments_popup_link( 'No comment yet', '1', '%' ); ?></span>
		<?php
	}
endif;

if ( ! function_exists( 'patrika_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function patrika_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="byline"> <i class="fas fa-user"></i> ' . wp_kses(
			$byline,
			array(
				'span' => array(
					'class' => array(),
				),
				'a'    => array(
					'href'  => array(),
					'class' => array(),
				),
			)
		) . '</span><span class="posted-on"><i class="fas fa-bookmark"></i>' . wp_kses(
			patrika_time_link(),
			array(
				'time' => array(
					'class'    => array(),
					'datetime' => array(),
				),
				'a'    => array(
					'href' => array(),
					'rel'  => array(),
				),
			)
		) . '</span>';
	}
endif;


if ( ! function_exists( 'patrika_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function patrika_time_link() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		$modified_date = get_the_modified_date();
		if ( ! empty( $modified_date ) ) {
			// Wrap the time string in a link, and preface it with 'Posted on'.
			return sprintf(
				/* translators: %s: post date */
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);
		}
	}
endif;


if ( ! function_exists( 'patrika_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function patrika_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'patrika' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		$categories  = get_the_category();
		$category_id = $categories[0]->cat_id;

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( ( ( patrika_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && patrika_categorized_blog() ) || $tags_list ) {

						// Make sure there's more than one category before displaying.
					if ( $categories_list && patrika_categorized_blog() ) {
						?>
							<?php
							foreach ( ( get_the_category() ) as $category ) {
								$cat_name = $category->cat_name;
								$cat_id   = $category->cat_id;
								?>
								<span class="cat-links" style="color:<?php echo esc_attr( get_theme_mod( 'patrika_category_color_' . $cat_id ) ); ?>">
									<i class="fas fa-folder-open"></i><a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?> "><?php echo esc_attr( $cat_name ); ?></a>
								</span>
							<?php } ?>
						<?php
					}

					if ( $tags_list && ! is_wp_error( $tags_list ) ) {
						echo '<span class="tags-links"><span class="tags-text">' . esc_attr__( '<i class="fas fa-tags"></i> ', 'patrika' ) . '</span>' . wp_kses(
							$tags_list,
							array(
								'a' => array(
									'href' => array(),
									'rel'  => array(),
								),
							)
						) . '</span>';
					}
				}
			}

			patrika_edit_link();

		}
	}
endif;


if ( ! function_exists( 'patrika_edit_link' ) ) :
	/**
	 * Returns an accessibility-friendly link to edit a post or page.
	 *
	 * This also gives us a little context about what exactly we're editing
	 * (post or page?) so that users understand a bit more where they are in terms
	 * of the template hierarchy and their content. Helpful when/if the single-page
	 * layout with multiple posts/pages shown gets confusing.
	 */
	function patrika_edit_link() {
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'patrika' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function patrika_categorized_blog() {
	$category_count = get_transient( 'patrika_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'patrika_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in patrika_categorized_blog.
 */
function patrika_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'patrika_categories' );
}
add_action( 'edit_category', 'patrika_category_transient_flusher' );
add_action( 'save_post', 'patrika_category_transient_flusher' );
