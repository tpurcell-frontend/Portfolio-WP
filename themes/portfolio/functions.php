<?php
/**
 * Portfolio functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Portfolio
 * @since Portfolio 1.0
 */

// Portfolio Theme

// Adds theme support for post formats.
if ( ! function_exists( 'portfolio_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return void
	 */
	function portfolio_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'portfolio_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'portfolio_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return void
	 */
	function portfolio_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'portfolio_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'portfolio_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return void
	 */
	function portfolio_enqueue_styles() {
		// Enqueue the main style.css
		wp_enqueue_style(
			'portfolio-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);

		// Enqueue Google Fonts
		wp_enqueue_style(
			'portfolio-google-fonts',
			'https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap',
			array(),
			null
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_styles' );

// Enqueues Bootstrap CSS framework
function enqueue_bootstrap_assets() {
    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        array(),
        '5.3.3'
    );

    // Bootstrap JS (depends on Popper)
    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        array('jquery'), // optional dependency
        '5.3.3',
        true // load in footer
    );
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_assets');

// Registers custom block styles.
if ( ! function_exists( 'portfolio_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return void
	 */
	function portfolio_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'portfolio' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'portfolio_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'portfolio_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return void
	 */
	function portfolio_pattern_categories() {

		register_block_pattern_category(
			'portfolio_page',
			array(
				'label'       => __( 'Pages', 'portfolio' ),
				'description' => __( 'A collection of full page layouts.', 'portfolio' ),
			)
		);

		register_block_pattern_category(
			'portfolio_post-format',
			array(
				'label'       => __( 'Post formats', 'portfolio' ),
				'description' => __( 'A collection of post format patterns.', 'portfolio' ),
			)
		);
	}
endif;
add_action( 'init', 'portfolio_pattern_categories' );

/**
 * Register custom patterns
 */
function intro_section_register_patterns() {
    if ( function_exists( 'register_block_pattern' ) ) {

        // Register the category
        register_block_pattern_category(
            'intro-section',
            array(
                'label'       => _x( 'Intro Section', 'Block pattern category', 'intro-section' ),
                'description' => __( 'Patterns for the intro section.', 'intro-section' ),
            )
        );

        // Register the pattern
        register_block_pattern(
            'intro-section/intro-section', 
            array(
                'title'       => __( 'Intro Section', 'intro-section' ),
                'description' => __( 'An intro section for your pages.', 'intro-section' ),
                'categories'  => array( 'intro-section' ),
                'content'     => file_get_contents( get_stylesheet_directory() . '/patterns/intro-section.php' ),
            )
        );
    }
}
add_action( 'init', 'intro_section_register_patterns' );

// Registers block binding sources.
if ( ! function_exists( 'portfolio_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return void
	 */
	function portfolio_register_block_bindings() {
		register_block_bindings_source(
			'portfolio/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'portfolio' ),
				'get_value_callback' => 'portfolio_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'portfolio_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'portfolio_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function portfolio_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;
