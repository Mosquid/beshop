<?php
/**
* Template Name: Validate
*
* @package WordPress
* @subpackage Beshop
* @since 1.1.1
*/

  global $wpdb;
  wp_head(); 
?>
<?php
  $validate = !empty($_REQUEST['validate']) ? true : false;
  $code = $_GET['code'];
  $post_id = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_excerpt='$code' and post_type='qr' and post_status='publish';");
  $active = !empty($post_id);
  $label = $active ? 'Activate' : 'Wrong code';

  if ($validate && $active) {
    $label = 'Thank you!';
  }
  echo do_shortcode(sprintf('[code_status label="%2$s" active="%1$s"]', $active, $label));
  
  if ($validate && $active) wp_trash_post($post_id[0]->ID);
?>
<?php wp_footer(); ?>
