<?php

/**
 * beshop Theme Customizer
 *
 * @package beshop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function beshop_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
                'blogname', array(
            'selector' => '.site-title a',
            'render_callback' => 'beshop_customize_partial_blogname',
                )
        );
        $wp_customize->selective_refresh->add_partial(
                'blogdescription', array(
            'selector' => '.site-description',
            'render_callback' => 'beshop_customize_partial_blogdescription',
                )
        );
    }
}

add_action('customize_register', 'beshop_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function beshop_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function beshop_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function beshop_customize_preview_js() {
    wp_enqueue_script('beshop-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20151215', true);
}

add_action('customize_preview_init', 'beshop_customize_preview_js');

/**
 * Add Shop info to customizer
 * 
 * @param type $wp_customize
 */
function beshop_customize_shopinfo($wp_customize) {
    $wp_customize->add_setting('beshop_shopinfo_email', array());
    $wp_customize->add_setting('beshop_shopinfo_phone', array());
    $wp_customize->add_setting('beshop_shopinfo_address', array());

    $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize, 
            'beshop_shopinfo_email', 
            array(
                'label' => __('Email', 'beshop'),
                'section' => 'title_tagline',
                'settings' => 'beshop_shopinfo_email',
                'priority' => 100
                )
            )
    );
    
    $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize, 
            'beshop_shopinfo_phone', 
            array(
                'label' => __('Phone', 'beshop'),
                'section' => 'title_tagline',
                'settings' => 'beshop_shopinfo_phone',
                'priority' => 110
                )
            )
    );
    
    $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize, 
            'beshop_shopinfo_address', 
            array(
                'label' => __('Address', 'beshop'),
                'section' => 'title_tagline',
                'settings' => 'beshop_shopinfo_address',
                'priority' => 120
                )
            )
    );    
}

add_action( 'customize_register', 'beshop_customize_shopinfo' );
