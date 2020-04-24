<?php
add_shortcode('banners', 'sc_banners');
add_shortcode('banner', 'sc_banner');

function sc_banners($atts = array(), $content = '')
{
  if (empty($content)) return '';

  $tpl = '<div class="sales_header">%1$s</div>';
  $output = do_shortcode($content);

  return sprintf($tpl, $output);
}

function sc_banner($atts = array(), $content = '')
{
  $atts = shortcode_atts(array(
    'title' => '',
    'image' => ''
  ), $atts);

  $tpl = '<div class="sales_header_item">
    <img src="%1$s" alt="">
    <h3>%2$s</h3>
    %3$s
  </div>';

  return sprintf($tpl, $atts['image'], $atts['title'], $content);
}
