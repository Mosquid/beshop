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
            <div class="wrapper">
                <nav class="main_navigation">
                    <div class="nav-wrapper">
                        <div class="logo_wrapper">
                            <a name="back" onclick="history.back()" class="back_button"></a>
                            <a href="#" data-target="mobile-demo" class="sidenav-trigger menu_switcher"></a>
                            <?php the_custom_logo() ?>
                        </div>


                        <div class="header_buttons">
                          <?php dynamic_sidebar('sidebar-2'); ?>
                            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart_button"><span><?php echo get_cart_total_count(); ?></span></a>
                            <div class="cart_search"></div>
                        </div>
                    </div>
                </nav>
                <div class="sidenav" id="mobile-demo">

                    <!--          <div class="menu_close"></div>-->
                    <div class="menu">
                        <div class="sidebars">
                        <?php
                        if (!dynamic_sidebar( 'sidebar-1' )) {
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

                </div>

                <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'beshop'); ?></a>

                <?php if (is_product_category() || is_product_tag()): ?>
                    <div class="tag-cloud">
                      <?php echo do_shortcode("[beshop_tag_cloud]"); ?>
                    </div>
                <?php endif; ?>


                <div id="content" class="site-content">
