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
	<meta charset="<?php bloginfo( 'charset' ); ?>">
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
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger menu_switcher"></a>
                    <a href="<?php echo site_url() ?>" class="logo">
                        <img src="<?php echo get_template_directory_uri() ?>/img/footer/logo.svg" alt="">
					</a>
				</div>
				
               
                <div class="header_buttons">
                    <a href="<?php echo site_url() ?>/cart/" class="cart_button"></a>
                    <div class="cart_search"></div>
                </div>
            </div>
        </nav>
        <div class="sidenav" id="mobile-demo">

            <!--          <div class="menu_close"></div>-->
            <div class="menu">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
                <div class="menu_contacts">
                    <div class="logo_contacts">
                        <img src="<?php echo get_template_directory_uri() ?>/img/logo.jpg" alt="">
                    </div>
                    <a href="mailto:storename@mail.com" class="menu_contacts_mail">storename@mail.com</a>
                    <a href="tel:" class="menu_contacts_phone">+72 548 96 154</a>
                    <a href="#" class="menu_contacts_map">Tel Aviv, Vallay Str. One Mall 716 Nm Floor4</a>
                </div>
            </div>

		</div>
		
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'beshop' ); ?></a>



	<div id="content" class="site-content">
