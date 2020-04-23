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
