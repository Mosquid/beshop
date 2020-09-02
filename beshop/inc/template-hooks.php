<?php

function custom_single_product() {

    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

    add_action('woocommerce_single_product_summary', 'beshop_single_product_description', 10);
    add_action('woocommerce_single_product_summary', 'beshop_single_product_attributes', 15);

    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
}

add_action('woocommerce_single_product_summary', 'custom_single_product', 1);

// Removes comments from product page
add_action('init', 'remove_comment_support');

function remove_comment_support() {
    remove_post_type_support('product', 'comments');
}

/* Force currency change for user */

function force_change_currency() {
    if (defined('BESHOP_FORCE_CURRENCY_SET') && function_exists('alg_wc_cs_session_set') && function_exists('alg_wc_cs_session_get')) {
        if (alg_wc_cs_session_get('alg_currency') != BESHOP_FORCE_CURRENCY_SET) {
            alg_wc_cs_session_set('alg_currency', BESHOP_FORCE_CURRENCY_SET);
        }
    }
}

add_action("template_redirect", "force_change_currency");


/* Override page title */
add_filter('woocommerce_show_page_title', 'beshop_woocommerce_page_title');

function beshop_woocommerce_page_title($true) {
    return false;
}

add_filter('woocommerce_after_cart_item_name', 'beshop_after_cart_item_name');

function beshop_after_cart_item_name($cart_item) {
    error_log(print_r($cart_item, true));
}

//function default_no_quantities($individually, $product) {
//    $individually = true;
//    return $individually;
//}
//
//add_filter('woocommerce_is_sold_individually', 'default_no_quantities', 10, 2);
