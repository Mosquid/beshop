<?php

require_once( __DIR__ . '/shortcodes/banners.php');

/**
 * List all (or limited) product categories in tree.
 *
 * @param array $atts Attributes.
 * @return string
 */
function custom_product_categories($atts) {
    $categories = getAllCategories($atts);
    $tpl = '<div class="category_list"><div>%1$s</div></div>';
    $exclude = !empty($atts['exclude']) ? $atts['exclude'] : false;

    ob_start();
    echo '<div class="categories-header"><h4>';
    echo _e('Menu', 'beshop');
    echo '</h4><button class="categories-switcher" arial-label="Switch Categories View"></button>';
    echo '</div>';
    echo '<div class="categories-wrapper">';

    foreach ($categories as $cat) {
        if ((!empty($exclude) && (int) $exclude === $cat->term_id) || $cat->slug === "uncategorized")
            continue;

        $thumb_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $term_img = wp_get_attachment_url($thumb_id);

        echo '<div class="item">';
        if ($term_img) {
            echo '<div class="img-wrapper"><img src="' . $term_img . '" alt="' . get_post_meta($thumb_id, '_wp_attachment_image_alt', true) . '"></div>';
        }
        echo '<a class="parent" href="' . get_term_link($cat->term_id) . '">' . $cat->name . '</a>';
//        echo '<div class="childs">';
        foreach (getAllCategories(['parent' => $cat->term_id]) as $child) {
            echo '<a class="child" href="' . get_term_link($child->term_id) . '">' . $child->name . '</a>';
        }
//        echo '</div>';

        echo '</div>';
    }
    echo '</div>';

    return sprintf($tpl, ob_get_clean());
}

/**
 * Will return all categories
 *
 * @param array $atts Attributes.
 * @return array
 */
function getAllCategories($atts) {

    if (isset($atts['number'])) {
        $atts['limit'] = $atts['number'];
    }

    $atts = shortcode_atts(
            array(
        'limit' => '15',
        'orderby' => 'count',
        'order' => 'DESC',
        'columns' => '4',
        'hide_empty' => 1,
        'parent' => '0',
        'ids' => '',
            ), $atts, 'product_categories'
    );

    $ids = array_filter(array_map('trim', explode(',', $atts['ids'])));
    $hide_empty = ( true === $atts['hide_empty'] || 'true' === $atts['hide_empty'] || 1 === $atts['hide_empty'] || '1' === $atts['hide_empty'] ) ? 1 : 0;

    // Get terms and workaround WP bug with parents/pad counts.
    $args = array(
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
        'hide_empty' => $hide_empty,
        'include' => $ids,
        'pad_counts' => true,
        'child_of' => $atts['parent'],
    );

    $product_categories = apply_filters(
            'woocommerce_product_categories', get_terms('product_cat', $args)
    );

    if ('' !== $atts['parent']) {
        $product_categories = wp_list_filter(
                $product_categories, array(
            'parent' => $atts['parent'],
                )
        );
    }

    if ($hide_empty) {
        foreach ($product_categories as $key => $category) {
            if (0 === $category->count) {
                unset($product_categories[$key]);
            }
        }
    }

    $atts['limit'] = '-1' === $atts['limit'] ? null : intval($atts['limit']);
    if ($atts['limit']) {
        $product_categories = array_slice($product_categories, 0, $atts['limit']);
    }

    return $product_categories;
}

/**
 * Register custom_product_categories
 */
add_shortcode('custom_product_categories', 'custom_product_categories');

/**
 * Custom WooCommerce tag cloud shortcode.
 *
 * Use the follow shortcode in your pages: [my_wc_tag_cloud]
 */
function custom_tag_cloud_shortcode() {

    $args = array(
        'smallest' => 10,
        'largest' => 10,
        'unit' => 'px',
        'format' => 'flat',
        'orderby' => 'name',
        'order' => 'ASC',
        'link' => 'view',
        'taxonomy' => 'product_tag',
        'echo' => false
    );

    return wp_tag_cloud($args);
}

add_shortcode('beshop_tag_cloud', 'custom_tag_cloud_shortcode');
