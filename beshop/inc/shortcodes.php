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
    $tpl = '<div class="category_list">%1$s</div>';
    $exclude = !empty($atts['exclude']) ? $atts['exclude'] : false;

    ob_start();
    foreach ($categories as $cat) {
        if (!empty($exclude) && (int)$exclude === $cat->term_id) continue;

        $thumb_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
        $term_img = wp_get_attachment_url($thumb_id);

        echo '<div class="item">';
        echo '<a class="parent" href="' . get_term_link($cat->term_id) . '">' . $cat->name . '</a>';
        foreach (getAllCategories(['parent' => $cat->term_id]) as $child) {
            echo '<a class="child" href="' . get_term_link($child->term_id) . '">' . $child->name . '</a>';
        }
        if ($term_img) {
            echo '<img src="' . $term_img . '" alt="' . get_post_meta($thumb_id, '_wp_attachment_image_alt', true) . '">';
        }
        echo '</div>';
    }


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
        'limit' => '-1',
        'orderby' => 'name',
        'order' => 'ASC',
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
