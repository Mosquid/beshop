<?php

/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */
defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;
/*
  $attachment_ids = $product->get_gallery_image_ids();

  if ( $attachment_ids && $product->get_image_id() ) {
  foreach ( $attachment_ids as $attachment_id ) {
  echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
  }
  }
 * 
 */

if (ICL_LANGUAGE_CODE == 'he') {
    $ru_product_id = apply_filters('wpml_object_id', $product->get_id(), 'product', false, 'ru');
    $product = wc_get_product($ru_product_id);
}

$meta_images = $product->get_meta('meta_other_images');

if (!empty($meta_images)) {
    $images = explode(',', $meta_images);
    foreach ($images as $image) {

        $image_info = getimagesize($image);
        $image_path = parse_url($image);

        $resize_path = 'https://d2bsgiz6lkfyqo.cloudfront.net/fit-in/';

        $thumbnail_src = $resize_path . '475x365' . $image_path['path'];

        $thumbhtml = sprintf('<div data-thumb="%4$s" data-thumb-alt="" class="woocommerce-product-gallery__image"><a href="%1$s"><img width="%2$s" height="%3$s" src="%4$s" class="b-lazy" alt="" title="%5$s" data-caption="" data-src="%1$s" data-large_image="%1$s" data-large_image_width="%2$s" data-large_image_height="%3$s" /></a></div>', $image, $image_info[0], $image_info[1], $thumbnail_src, $product->get_title());
        echo apply_filters('woocommerce_single_product_image_thumbnail_html', $thumbhtml, 0);
    }
}
