<?php
/**
 * Patrika Theme: Customizer
 *
 * @package WordPress
 * @subpackage Patrika_Theme
 * @since 1.0
 */

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function patrika_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Patrika theme customizer options
 *
 * @since Patrika 1.0
 *
 * @param string $wp_customize Link to single post/page.
 */
function patrika_theme_customizer( $wp_customize ) {

	$wp_customize->add_panel(
		'patrika_theme_options',
		array(
			'priority'       => 30,
			'theme_supports' => '',
			'title'          => __( 'Patrika Theme Options', 'patrika' ),
			'description'    => __( 'Several settings of Patrika Theme', 'patrika' ),
		)
	);

	$wp_customize->add_section(
		'patrika_category_color_option',
		array(
			'title'    => __( 'Category Color Options', 'patrika' ),
			'priority' => 150,
			'panel'    => 'patrika_theme_options',
		)
	);

	$categories = get_categories();
	$cats       = array();
	$i          = 0;
	foreach ( $categories as $category ) {
		if ( 0 === $i ) {
			$default = $category->term_id;
			$i++;
		}
		$catname = $category->name;
		$catid                      = $category->term_id;
		$wp_customize->add_setting(
			'patrika_category_color_' . $catid,
			array(
				'default'           => 250,
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'patrika_category_color_' . $catid,
				array(
					'label'    =>  sprintf( __( 'Category: %s', 'patrika' ), $catname ),
					'section'  => 'patrika_category_color_option',
					'settings' => 'patrika_category_color_' . $catid,
				)
			)
		);
	}

	$wp_customize->add_section(
		'patrika_homepage_category_blog',
		array(
			'title'    => __( 'Categories Option', 'patrika' ),
			'priority' => 150,
			'panel'    => 'patrika_theme_options',
		)
	);

	$wp_customize->add_setting(
		'patrika_homepage_category_blog_1',
		array(
			'default'           => $default,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'patrika_homepage_category_blog_1',
			array(
				'label'       => __( 'Select Category', 'patrika'),
				'description' => __( 'Select Category For Front Page', 'patrika'),
				'section'     => 'patrika_homepage_category_blog',
				'settings'    => 'patrika_homepage_category_blog_1',
				'type'        => 'select',
				'choices'     => $cats,
			)
		)
	);

	$wp_customize->add_setting(
		'patrika_homepage_category_blog_2',
		array(
			'default'           => $default,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'patrika_homepage_category_blog_2',
			array(
				'label'       => __('Select Category', 'patrika'),
				'description' => __('Select Category For Front Page', 'patrika'),
				'section'     => 'patrika_homepage_category_blog',
				'settings'    => 'patrika_homepage_category_blog_2',
				'type'        => 'select',
				'choices'     => $cats,
			)
		)
	);

	$wp_customize->add_setting(
		'patrika_homepage_category_blog_3',
		array(
			'default'           => $default,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'patrika_homepage_category_blog_3',
			array(
				'label'       => __( 'Select Category', 'patrika'),
				'description' => __( 'Select Category For Front Page', 'patrika'),
				'section'     => 'patrika_homepage_category_blog',
				'settings'    => 'patrika_homepage_category_blog_3',
				'type'        => 'select',
				'choices'     => $cats,
			)
		)
	);

	/**
	* Patrika Header Image Slider
	*/
	$wp_customize->add_section(
		'patrika_image_slider',
		array(
			'title'    => __( 'Header Image Slider', 'patrika' ),
			'priority' => 30,
			'panel'    => 'patrika_theme_options',
		)
	);

	$wp_customize->add_setting(
		'patrika_slider_activation',
		array(
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'patrika_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'patrika_slider_activation',
			array(
				'label'    => __( 'Check to turn on image slider ( If unchecked, header background image will be shown.)', 'patrika' ),
				'section'  => 'patrika_image_slider',
				'settings' => 'patrika_slider_activation',
				'type'     => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'patrika_slider_post_IDs_setting',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'patrika_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'patrika_slider_post_IDs',
		array(
			'label'    => __( 'Post IDs For Slider (comma separated)', 'patrika' ),
			'section'  => 'patrika_image_slider',
			'settings' => 'patrika_slider_post_IDs_setting',
			'type'     => '',
		)
	);

	/**
	* Patrika Header Background Image
	*/

	$wp_customize->add_section(
		'patrika_header_image_section',
		array(
			'title'    => __( 'Header Background Image', 'patrika' ),
			'priority' => 30,
			'panel'    => 'patrika_theme_options',
		)
	);

	$wp_customize->add_setting(
		'patrika_header_image_setting',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'patrika_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'patrika_header_image_control',
		array(
			'label'    => __( 'Choose A Page For Header Image', 'patrika' ),
			'section'  => 'patrika_header_image_section',
			'settings' => 'patrika_header_image_setting',
			'type'     => 'dropdown-pages',
		)
	);

	/**
	 * Side-Bar Option Customization
	*/

	$wp_customize->add_section(
		'patrika_sidebar_option',
		array(
			'title'    => __( 'Sidebar Option', 'patrika' ),
			'priority' => 30,
			'panel'    => 'patrika_theme_options',
		)
	);

	$wp_customize->add_setting(
		'patrika_sidebar_option',
		array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'patrika_sanitize_radio',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'patrika_sidebar_option',
			array(
				'label'    => __( 'Choose your sidebar option', 'patrika' ),
				'section'  => 'patrika_sidebar_option',
				'settings' => 'patrika_sidebar_option',
				'type'     => 'radio',
				'choices'  => array(
					'null'  => __( 'Without Sidebar', 'patrika' ),
					'left'  => __( 'Left Sidebar', 'patrika' ),
					'right' => __( 'Right Sidebar', 'patrika' ),
				),
			)
		)
	);

	/**
	 * Patrika Footer Options
	 */
	$wp_customize->add_section(
		'patrika_footer',
		array(
			'title'    => __( 'Footer Options', 'patrika' ),
			'priority' => 30,
			'panel'    => 'patrika_theme_options',
		)
	);

		$wp_customize->add_setting(
			'patrika_to_the_top',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'patrika_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'patrika_to_the_top',
				array(
					'label'    => __( 'Check to turn on to the top option', 'patrika' ),
					'section'  => 'patrika_footer',
					'settings' => 'patrika_to_the_top',
					'type'     => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting(
			'patrika_show_footer_copyright',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'patrika_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'patrika_show_footer_copyright',
				array(
					'label'    => __( 'Check to show copyright link', 'patrika' ),
					'section'  => 'patrika_footer',
					'settings' => 'patrika_show_footer_copyright',
					'type'     => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting(
			'patrika_footer_user_copyright',
			array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'patrika_footer_user_copyright',
				array(
					'label'    => __( 'Add Footer Copyright', 'patrika' ),
					'section'  => 'patrika_footer',
					'settings' => 'patrika_footer_user_copyright',
					'type'     => 'text',
				)
			)
		);
}
add_action( 'customize_register', 'patrika_theme_customizer' );



/**
 * Bind JS handlers to instantly live-preview changes.
 */
function patrika_customize_preview_js() {
	wp_enqueue_script( 'patrika-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'patrika_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function patrika_panels_js() {
	wp_enqueue_script( 'patrika-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'patrika_panels_js' );


/**
 * Patrika theme sanitize checkbox
 *
 * @since Patrika 1.0
 *
 * @param string $checked for boolen.
 */
function patrika_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Patrika theme sanitize radio
 *
 * @since Patrika 1.0
 *
 * @param string $input for radio.
 * @param string $setting for radio.
 */
function patrika_sanitize_radio( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * Patrika theme sanitize file
 *
 * @since Patrika 1.0
 *
 * @param string $file for file.
 * @param string $setting for file.
 */
function patrika_sanitize_file( $file, $setting ) {
	// allowed file types.
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
	);

	// check file type from file name.
	$file_ext = wp_check_filetype( $file, $mimes );

	// if file has a valid mime type return it, otherwise return default.
	return ( $file_ext['ext'] ? $file : $setting->default );
}

/**
 * Patrika theme sanitize file
 *
 * @since Patrika 1.0
 *
 * @param string $input for float.
 */
function patrika_sanitize_float( $input ) {
		return filter_var( $input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
}

/**
 * Add iFrame to allowed wp_kses_post tags
 *
 * @param string $tags Allowed tags, attributes, and/or entities.
 * @param string $context Context to judge allowed tags by. Allowed values are 'post'.
 *
 * @return mixed
 */
function patrika_wpkses_post_tags( $tags, $context ) {
	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);
	}
	return $tags;
}
add_filter( 'wp_kses_allowed_html', 'patrika_wpkses_post_tags', 10, 2 );


/**
 * Patrika theme sanitize file
 *
 * @since Patrika 1.0
 *
 * @param string $input for text.
 */
function patrika_sanitize_text( $input ) {
	$temp          = explode( ',', $input );
	$int_ids_array = [];
	$count         = count( $temp );
	for ( $i = 0; $i < $count; $i++ ) {
		if ( is_numeric( $temp[ $i ] ) ) {
			$int_ids_array[] = $temp[ $i ];
		}
	}
	return $int_ids_array;
}


