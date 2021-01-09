<?php
add_shortcode('banners', 'sc_banners');
add_shortcode('banner', 'sc_banner');

function sc_banners($atts = array(), $content = '')
{
  if (empty($content)) return '';

  $tpl = '<div class="sales_header swiper-container">
            <div class="swiper-wrapper">%1$s</div>
            <div class="swiper-pagination"></div>
            <div class="swiper-navigation">
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>';
  $output = do_shortcode($content);

  return sprintf($tpl, $output);
}

function sc_banner($atts = array(), $content = '')
{
  $atts = shortcode_atts(array(
    'title' => '',
    'image' => '',
    'description'=> ''
  ), $atts);

  $tpl = '<div class="swiper-slide">
            <img class="slide-img" src="%1$s" />
            %2$s
            %3$s
          </div>';

  return sprintf($tpl, $atts['image'], $atts['title'] ? '<h3>'.$atts['title'].'</h3>' : '', $atts['description'] ? '<p class="slide-description">' . $atts['description'] . '</p>' : '', $content);
}
