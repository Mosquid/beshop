<?php

/**
 * beshop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package beshop
 */
if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '2.0.6');
}

if (!function_exists('beshop_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function beshop_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on beshop, use a find and replace
         * to change 'beshop' to the name of your theme in all the template files.
         */
        load_theme_textdomain('beshop', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
                array(
                    'menu-1' => esc_html__('Primary', 'beshop'),
                )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
                'html5', array(
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
                'custom-background', apply_filters(
                        'beshop_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
                        )
                )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
                'custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
                )
        );
    }

endif;
add_action('after_setup_theme', 'beshop_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function beshop_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('beshop_content_width', 640);
}

add_action('after_setup_theme', 'beshop_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function beshop_widgets_init() {
    register_sidebar(
            array(
                'name' => esc_html__('Sidebar', 'beshop'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Add widgets here.', 'beshop'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<span class="widget-title" style="display:none">',
                'after_title' => '</span>',
            )
    );

    register_sidebar( array(
        'name'          => __( 'Header Sidebar', 'textdomain' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'The cart and search header area.', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
    ) );
}

add_action('widgets_init', 'beshop_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function beshop_scripts() {
    wp_enqueue_style('beshop-style', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION);

    wp_enqueue_script('beshop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('beshop-material', get_template_directory_uri() . '/js/material.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('beshop-slick', get_template_directory_uri() . '/js/slick.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('beshop-script', get_template_directory_uri() . '/js/script.js', array('jquery'), _S_VERSION, true);
    wp_enqueue_script('beshop-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), _S_VERSION, true);

    wp_enqueue_script('beshop-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('beshop-custom', 'beshopAjaxProps', array(
        'action_nonce' => wp_create_nonce('set_cart_qty'),
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_actions' => array(
            'setCartQty' => 'beshop_set_cart_qty'
        )
    ));

    /* Add google fonts */
    wp_enqueue_style('beshop-googlefonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;1,300&family=Rubik&display=swap', false);
    
    /* Ajax search*/
    wp_enqueue_script('beshop-search', get_template_directory_uri() . '/js/search.js', array('jquery'), _S_VERSION, true);
}

add_action('wp_enqueue_scripts', 'beshop_scripts', 99);

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
 * Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Template hooks
 */
require get_template_directory() . '/inc/template-hooks.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

function get_cart_total_count() {
    $cart = WC()->cart;
    
    return $cart->get_cart_contents_count();
}

function get_product_from_cart($product_id) {
    $cart = WC()->cart;
    $cart_items = $cart->get_cart_contents();

    foreach ($cart_items as $item) {
        if ($item['product_id'] !== (int) $product_id)
            continue;
        return $item;
    }

    return null;
};

/**
 * Add quantity field on the shop page.
 */
function ace_shop_page_add_quantity_field($html) {
    $product = get_product_from_cart(get_the_ID());
    $qty = !empty($product['quantity']) ? $product['quantity'] : 0;

    $tpl = '<div class="category_order_wrapper">
	<div class="category_order">
		<div style="display: none">%1$s</div>
		<span class="category_order_button">%2$s</span>
		<span class="category_order_capacity hide_bot">
				<input type="button" data-action="minus" class="qty-control category_order_select_minus">
				<input type="number" step="1" min="1" class="item_number" value="%3$d">
				<input type="button" data-action="plus" class="qty-control category_order_select_plus">
		</span>
	</div>
	</div>';

    return sprintf($tpl, $html, __("Add to cart", 'beshop'), $qty);
}

;

add_filter('woocommerce_add_to_cart_validation', function ($valid, $product_id) {
    $qty = !empty($_POST['quantity']) ? $_POST['quantity'] : 0;
    $cart = WC()->cart;
    $cart_items = $cart->get_cart_contents();

    if (empty($cart_items))
        return $valid;

    $product = get_product_from_cart($product_id);

    if (empty($product))
        return $valid;

    if (!$qty) {
        $cart->remove_cart_item($product['key']);
        WC_AJAX::get_refreshed_fragments();
    }

    $cart->set_quantity($product['key'], 0);

    return $valid;
}, 10, 5);



add_action('woocommerce_loop_add_to_cart_link', 'ace_shop_page_add_quantity_field');
add_action('init', function(){
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
});

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
    function woocommerce_get_product_thumbnail( $size = 'woocommerce_single' ) {
        global $post, $woocommerce;
        $output = '<div class="aspect-ratio" style="background-image: url('.get_the_post_thumbnail_url( $post->ID, $size ).')">';
        $output .= '</div>';
        return $output;
    }
}
add_filter( 'the_content', 'shortcode_unautop', 100 );
function my_product_carousel_options($options) {
    $options['controlNav'] = false;
    return $options;
  }
  add_filter("woocommerce_single_product_carousel_options", "my_product_carousel_options", 10);
  
add_filter('wp_headers', function ($headers) {
    $headers['Cache-Control'] = 'no-store';
    return $headers;
});

add_filter( 'woocommerce_countries_shipping_country_states', 'bbloomer_custom_woocommerce_states' );
 
function bbloomer_custom_woocommerce_states( $states ) {
    // var_dump($states);
    return $states;
}
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

add_filter( 'woocommerce_checkout_fields' , 'bbloomer_remove_billing_postcode_checkout' );
 
function bbloomer_remove_billing_postcode_checkout( $fields ) {
  unset($fields['billing']['billing_postcode']);
  return $fields;
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');

  function fix_svg_thumb_display() {
    echo '
    <style>
      td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
        width: 100% !important; 
        height: auto !important; 
      }
      </style>
    ';
  }
  add_action('admin_head', 'fix_svg_thumb_display');
