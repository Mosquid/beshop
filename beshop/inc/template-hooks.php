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

/** Remove categories from shop and other pages
 * in Woocommerce
 */
function wc_hide_selected_terms($terms, $taxonomies, $args) {
    $new_terms = array();
    if (in_array('product_cat', $taxonomies) && !(is_shop() || is_home())) {
        foreach ($terms as $key => $term) {
            if (!in_array($term->slug, array('uncategorized'))) {
                $new_terms[] = $term;
            }
        }
        $terms = $new_terms;
    }
    return $terms;
}

add_filter('get_terms', 'wc_hide_selected_terms', 10, 3);
