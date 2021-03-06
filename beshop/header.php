<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package beshop
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div id="page" class="site">
    <header class="header">
      <nav class="main_navigation">
        <div class="nav-wrapper">
          <div class="logo-wrapper">
            <?php the_custom_logo() ?>
          </div>

          <div class="nav-buttons">
            <a href="<?php echo get_home_url(); ?>" class="home">
              <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.5612 10.2809H23.7504C24.3462 10.2809 24.8337 10.7684 24.8337 11.3642L24.8012 11.6567L22.0495 21.6992C21.7895 22.6092 20.9554 23.2809 19.9587 23.2809H5.87537C4.8787 23.2809 4.04453 22.6092 3.79537 21.6992L1.0437 11.6567C1.0112 11.5592 1.00037 11.4617 1.00037 11.3642C1.00037 10.7684 1.48787 10.2809 2.0837 10.2809H7.27287L12.0179 3.18507C12.2237 2.8709 12.5704 2.71924 12.917 2.71924C13.2637 2.71924 13.6104 2.8709 13.8162 3.17424L18.5612 10.2809ZM15.9504 10.2809L12.917 5.73091L9.88372 10.2809H15.9504ZM19.9587 21.1142L5.8862 21.1251L3.50287 12.4476H22.342L19.9587 21.1142ZM10.7504 16.7809C10.7504 15.5892 11.7254 14.6142 12.917 14.6142C14.1087 14.6142 15.0837 15.5892 15.0837 16.7809C15.0837 17.9726 14.1087 18.9476 12.917 18.9476C11.7254 18.9476 10.7504 17.9726 10.7504 16.7809Z" fill="#333333"/>
              </svg>
              <?php echo _e('Home', 'beshop'); ?>
            </a>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-button">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.2469 9.97508C14.9636 10.4917 14.4136 10.8334 13.7886 10.8334H7.58024L6.66357 12.5001H16.6636V14.1667H6.66357C5.39691 14.1667 4.59691 12.8084 5.20524 11.6917L6.33024 9.65841L3.33024 3.33341H1.66357V1.66675H4.38857L5.17191 3.33341H17.5052C18.1386 3.33341 18.5386 4.01675 18.2302 4.56675L15.2469 9.97508ZM16.0885 5.00008H5.96355L7.93855 9.16675H13.7885L16.0885 5.00008ZM6.66361 15.0001C5.74695 15.0001 5.00528 15.7501 5.00528 16.6667C5.00528 17.5834 5.74695 18.3334 6.66361 18.3334C7.58028 18.3334 8.33028 17.5834 8.33028 16.6667C8.33028 15.7501 7.58028 15.0001 6.66361 15.0001ZM13.3386 16.6667C13.3386 15.7501 14.0803 15.0001 14.9969 15.0001C15.9136 15.0001 16.6636 15.7501 16.6636 16.6667C16.6636 17.5834 15.9136 18.3334 14.9969 18.3334C14.0803 18.3334 13.3386 17.5834 13.3386 16.6667Z" fill="#333333"/>
              </svg>
              <?php if (get_cart_total_count() > 0): ?>
                <span><?php echo get_cart_total_count(); ?></span>
              <?php endif; ?>
              <?php echo _e('Cart', 'beshop'); ?>
            </a>
            <a href="<?php echo get_home_url(); ?>/my-account" class="profile">
              <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M13 4.3335C10.6059 4.3335 8.66671 6.27266 8.66671 8.66683C8.66671 11.061 10.6059 13.0002 13 13.0002C15.3942 13.0002 17.3334 11.061 17.3334 8.66683C17.3334 6.27266 15.3942 4.3335 13 4.3335ZM15.1667 8.66683C15.1667 7.47516 14.1917 6.50016 13 6.50016C11.8084 6.50016 10.8334 7.47516 10.8334 8.66683C10.8334 9.8585 11.8084 10.8335 13 10.8335C14.1917 10.8335 15.1667 9.8585 15.1667 8.66683ZM19.5 19.5002C19.2834 18.731 15.925 17.3335 13 17.3335C10.0859 17.3335 6.74921 18.7202 6.50004 19.5002H19.5ZM4.33337 19.5002C4.33337 16.6185 10.1075 15.1668 13 15.1668C15.8925 15.1668 21.6667 16.6185 21.6667 19.5002V21.6668H4.33337V19.5002Z" fill="#333333" />
              </svg>
              <?php echo _e('Profile', 'beshop'); ?>
            </a>
            <a href="<?php echo get_home_url(); ?>/about" class="about-us">
              <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.833 2.1665C6.85297 2.1665 1.99963 7.01984 1.99963 12.9998C1.99963 18.9798 6.85297 23.8332 12.833 23.8332C18.813 23.8332 23.6663 18.9798 23.6663 12.9998C23.6663 7.01984 18.813 2.1665 12.833 2.1665ZM11.7496 7.58317V9.74984H13.9163V7.58317H11.7496ZM11.7496 11.9165V18.4165H13.9163V11.9165H11.7496ZM4.1663 12.9998C4.1663 17.7773 8.05547 21.6665 12.833 21.6665C17.6105 21.6665 21.4996 17.7773 21.4996 12.9998C21.4996 8.22234 17.6105 4.33317 12.833 4.33317C8.05547 4.33317 4.1663 8.22234 4.1663 12.9998Z" fill="#333333" />
              </svg>
              <?php echo _e('About Us', 'beshop'); ?>
            </a>
          </div>

          <div class="header_buttons">
            <?php dynamic_sidebar('sidebar-4'); ?>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-button"><span><?php echo get_cart_total_count(); ?></span></a>
            <button class="open-search" aria-lable="Open Search pannel">
              <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1234 15.0872H16.1436L22.5882 21.5456L20.6639 23.4702L14.2064 17.0247V16.0043L13.8577 15.6427C12.3854 16.9085 10.474 17.6706 8.39469 17.6706C3.75824 17.6706 0 13.9118 0 9.27474C0 4.63766 3.75824 0.878906 8.39469 0.878906C13.0311 0.878906 16.7894 4.63766 16.7894 9.27474C16.7894 11.3543 16.0274 13.266 14.7617 14.7385L15.1234 15.0872ZM2.58311 9.27487C2.58311 12.4911 5.179 15.0874 8.39481 15.0874C11.6106 15.0874 14.2065 12.4911 14.2065 9.27487C14.2065 6.05862 11.6106 3.46237 8.39481 3.46237C5.179 3.46237 2.58311 6.05862 2.58311 9.27487Z" fill="#333333"/>
              </svg>
            </button>
          </div>

        </div>
        <?php // dynamic_sidebar('sidebar-2'); ?>
      </nav>

      <div class="sidenav" id="mobile-demo">

        <div class="menu">
          <?php
            if (!dynamic_sidebar('sidebar-1')) {
              wp_nav_menu(
                array(
                  'theme_location' => 'menu-1',
                  'menu_id' => 'primary-menu',
                )
              );
            }
          ?>
          <div class="menu_contacts">
            <div class="logo_contacts">
              <?php the_custom_logo() ?>
            </div>
            <a href="mailto:<?php echo get_theme_mod("beshop_shopinfo_email") ?>" class="menu_contacts_mail"><?php echo get_theme_mod("beshop_shopinfo_email") ?></a>
            <a href="tel:" class="menu_contacts_phone"><?php echo get_theme_mod("beshop_shopinfo_phone") ?></a>
            <a href="#" class="menu_contacts_map"><?php echo get_theme_mod("beshop_shopinfo_address") ?></a>
          </div>
        </div>

      </div>

      <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'beshop'); ?></a>

      <?php // if (is_product_category() || is_product_tag()): ?>
        <!-- <div class="tag-cloud"> -->
          <?php // echo do_shortcode("[beshop_tag_cloud]"); ?>
        <!-- </div> -->
      <?php // endif; ?>
    </header>

    <div id="content" class="site-content">
