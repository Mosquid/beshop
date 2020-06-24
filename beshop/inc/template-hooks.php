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

// Action to add several products from the request parameter
// Forked from WC_Form_Handler::add_to_cart_action
// Example parameter: ?add-to-cart-products=1298|1,1260|2
add_action('wp_loaded', 'add_to_cart_from_link', 30);

function add_to_cart_from_link($url = false) {
    if (!isset($_REQUEST['add-to-cart-products'])) {
        return;
    }

    wc_nocache_headers();

    $product_ids = explode(',', wp_unslash($_REQUEST['add-to-cart-products']));

    foreach ($product_ids as $product_item) {
        list($pid, $quantity) = explode("|", $product_item);
        $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($pid));
        $adding_to_cart = wc_get_product($product_id);
        if (!$adding_to_cart) {
            continue;
        }
        $was_added = add_to_cart_handler_simple($product_id, $quantity);
    }

    wp_safe_redirect(wc_get_cart_url());
    exit;
}

/**
 * Handle adding simple products to the cart.
 *
 * @since 2.4.6 Split from add_to_cart_action.
 * @param int $product_id Product ID to add to the cart.
 * @return bool success or not
 */
function add_to_cart_handler_simple($product_id, $quantity) {
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);

    if ($passed_validation && false !== WC()->cart->add_to_cart($product_id, $quantity)) {
        wc_add_to_cart_message(array($product_id => $quantity), true);
        return true;
    }
    return false;
}
