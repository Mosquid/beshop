<?php
if( ! function_exists('sc_product_list') ) {

    
    function sc_product_list( $atts ) {
        global $woocommerce_loop;

        $atts = shortcode_atts(
            array(
                'category' => '',
                'limit'     => '16'
            ),
            $atts, 'product_list'
        );


        $woocommerce_loop['columns'] = '2';
        
        $current = absint(
            max(
              1,
              get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' )
            )
          );

        $products = new WP_Query( array (
            'post_type' => 'product',
            'product_cat' => $atts['category'],
            'post_status'       => 'publish',
            'posts_per_page'    => $atts['limit'],
            'orderby' => 'data',
            'paged' => $current
        ));

        ob_start();

        if ( $products->have_posts() ) { ?>

            <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>
            
            <?php woocommerce_product_loop_end(); ?>
            <?php
        } else {
            do_action( "woocommerce_shortcode_products_loop_no_results", $atts );
            echo "<p>There is no results.</p>";
        }
        woocommerce_reset_loop();
        
        wp_reset_postdata();
        echo paginate_links( [
            'current' => $current,
            'total'   => $products->max_num_pages,
        ] );
        echo paginate_links();

        return '<div class="woocommerce columns-' . 2 . '">' . ob_get_clean() . '</div>';
    }
    

    add_shortcode('product_list', 'sc_product_list');
}

?>