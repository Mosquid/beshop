<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package beshop
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function beshop_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    if (is_product_tag()) {
        $classes[] = 'taxonomy-page';
    }

    return $classes;
}

add_filter('body_class', 'beshop_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function beshop_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'beshop_pingback_header');

function beshop_single_product_description() {
    $product = wc_get_product();
    $product_details = $product->get_data();
    set_query_var('description_heading', 'Description');
    set_query_var('description_content', $product_details['description']);
    get_template_part('template-parts/single-product-description');
}

function beshop_single_product_attributes() {
    $product = wc_get_product();

    wc_display_product_attributes($product);
}

/**
 * Insert a widget in a sidebar.
 * 
 * @param string $widget_id   ID of the widget (search, recent-posts, etc.)
 * @param array $widget_data  Widget settings.
 * @param string $sidebar     ID of the sidebar.
 */
function insert_widget_in_sidebar($widget_id, $widget_data, $sidebar) {
    // Retrieve sidebars, widgets and their instances
    $sidebars_widgets = get_option('sidebars_widgets', array());
    $widget_instances = get_option('widget_' . $widget_id, array());

    // Retrieve the key of the next widget instance
    $numeric_keys = array_filter(array_keys($widget_instances), 'is_int');
    $next_key = $numeric_keys ? max($numeric_keys) + 1 : 2;

    // Add this widget to the sidebar
    if (!isset($sidebars_widgets[$sidebar])) {
        $sidebars_widgets[$sidebar] = array();
    }
    $sidebars_widgets[$sidebar][] = $widget_id . '-' . $next_key;

    // Add the new widget instance
    $widget_instances[$next_key] = $widget_data;

    // Store updated sidebars, widgets and their instances
    update_option('sidebars_widgets', $sidebars_widgets);
    update_option('widget_' . $widget_id, $widget_instances);
}

/**
 * Check is widget is present in the sidebar
 * 
 * @param string $sidebar
 * @param string $widget_id
 * @return bool
 */
function check_widget_exists_in_sidebar($sidebar, $widget_id) {
    $widgets = [];
    $all_widgets = wp_get_sidebars_widgets();
    $siudebar_widgets = $all_widgets[$sidebar];

    foreach ($siudebar_widgets as $widget) {
        array_push($widgets, _get_widget_id_base($widget));
    }

    return in_array($widget_id, $widgets);
}

/**
 * Add search widget to the Header Sidebar
 */
if (!check_widget_exists_in_sidebar('sidebar-2', 'search')) {
    insert_widget_in_sidebar('search', array(), 'sidebar-2');
}

/**
 * Register ajax callback for search
 */
add_action('wp_ajax_beshop_search', 'beshop_ajax_search');
add_action('wp_ajax_nopriv_beshop_search', 'beshop_ajax_search');

function beshop_ajax_search($term = '') {

    if (empty($term) && isset($_POST['term'])) {
        $term = (string) wc_clean(wp_unslash($_POST['term']));
    }

    if (empty($term)) {
        wp_die();
    }

    $limit = absint(apply_filters('woocommerce_json_search_limit', 30));

    $exclude_types = array();

    $data_store = WC_Data_Store::load('product');
    $ids = $data_store->search_products($term, '', false, false, $limit, [], []);

    $product_objects = array_filter(array_map('wc_get_product', $ids), 'wc_products_array_filter_readable');
    $products = array();

    foreach ($product_objects as $product_object) {
        $formatted_name = $product_object->get_formatted_name();

        if (in_array($product_object->get_type(), $exclude_types, true)) {
            continue;
        }

        $products[$product_object->get_id()] = [
            'name' => rawurldecode($formatted_name),
            'url' => get_permalink($product_object->get_id())
        ];
    }

    // don't know why the woocommerce_json_search_found_products doesnt work on different env
    // wp_send_json(apply_filters('woocommerce_json_search_found_products', $products));
    wp_send_json($products);

    wp_die();
}

if (is_search()) {
    wc_get_template_part('content', 'product-category');
}

/**
 * Will add `current` class to current tag
 * 
 * @param array $tags_data
 * @return array
 */
function beshop_tag_cloud_class($tags_data) {

    $current_tag = get_queried_object()->term_id;

    foreach ($tags_data as $key => $tag) {
        if ($tag['id'] == $current_tag) {
            $tags_data[$key]['class'] = $tags_data[$key]['class'] . " current";
        }
    }
    return $tags_data;
}

/**
 * Filter tag cloud tags
 */
add_filter('wp_generate_tag_cloud_data', 'beshop_tag_cloud_class');

/**
 * Will add manage menu item to the left sidebar menu
 * 
 * @param string $items
 * @param stdClass $args
 * @return string
 */
function predefined_menu_items($items, $args) {
    if ($args->menu_id === "primary-menu") {
        return $items . '<li class="menu-item"><a href="/manage#/" aria-current="page">Manage</a></li>';
    }
}

add_filter('wp_nav_menu_items', 'predefined_menu_items', 10, 2);

