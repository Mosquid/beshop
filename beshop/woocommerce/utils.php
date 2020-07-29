<?php
  function get_order_products($order_id) {
    if (empty($order_id)) return [];

		$order = wc_get_order($order_id);
		$products = $order->get_items();
    
    if (empty($products)) return [];
    
    $product_ids = [];

		foreach ($products as $product) {
      $product_id = $product->get_product_id();

      $product_ids[] = $product_id;
    }
    
    return $product_ids;
  }

  function get_posts_by_meta($meta_key = '', $meta_value = '', $post_type = 'post') {
    if (empty($meta_key) || empty($meta_value)) return null;

    $args = array(
      'post_type' => $post_type,
      'posts_per_page' => -1,
      'meta_query' => array(
        array(
          'key' => $meta_key,
          'value' => strval($meta_value),
          'compare' => '=',
        )
      )
   );

   $posts = get_posts($args);

   return $posts;
  }
?>