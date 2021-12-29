<?php
/**
 * removal functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package removal
 */

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page();

}

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'removal_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function removal_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on removal, use a find and replace
		 * to change 'removal' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'removal', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu' => "Меню",
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'removal_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'removal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function removal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'removal_content_width', 640 );
}
add_action( 'after_setup_theme', 'removal_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function removal_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'removal' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'removal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'removal_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function removal_scripts() {
	wp_enqueue_style( 'removal-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'removal-style', 'rtl', 'replace' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/assets/lib/jquery/jquery.js');
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'removal-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'removal-form-styler', get_template_directory_uri() . '/assets/lib/form-styler/jquery.formstyler.min.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'removal-slick', get_template_directory_uri() . '/assets/lib/slick/slick.min.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'removal-ui-slider', get_template_directory_uri() . '/assets/lib/ui-slider/jquery-ui.min.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'removal-ui-slider-touch', get_template_directory_uri() . '/assets/lib/ui-slider/jquery.ui.touch-punch.min.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'removal-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'removal-script', get_template_directory_uri() . '/assets/js/script.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'removal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'removal_scripts' );

add_filter( 'get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});

add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){

    wp_localize_script( 'removal-script', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('myajax-nonce')
        )
    );

}
/*
function call_date() {
    $curHour = date('H');
    $res = [];
    while ($curHour <= 20) {
        array_push($res, 'Сегодня, в '.$curHour.':00');
        $curHour++;
    }
    $js = '<script>'
        $js .= 'if($('select[name=call_date]').length != 0) {'
            foreach ($res as $value) {
                $js .= '$("select[name=call_date]").append("<option value="'.$value.'">'.$value.'</option>");';
                $js .= '$('select[name=call_date']).append('<option value="'.$value.'">'.$value.'</option>')';
            }
        }
    </script>
}
wpcf7_add_form_tag('call_date_list', 'call_date');
 */
// Функции вукомерса
require get_template_directory() . '/inc/woocommerce-functions.php';

// Ajax функции
require get_template_directory() . '/inc/ajax-functions.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}
