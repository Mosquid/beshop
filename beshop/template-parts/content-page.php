<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package beshop
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if (is_singular('page') && !is_front_page()): ?>
        <header class="entry-header">
          <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        </header>
    <?php endif; ?>

    <?php beshop_post_thumbnail(); ?>

    <div class="entry-content">

        <?php if (is_product_category()): ?>
            <?php
            $cate = get_queried_object();
            $cateID = $cate->term_id;
            ?>
            <?php echo do_shortcode('[custom_product_categories parent="' . $cateID . '"]') ?>
        <?php endif; ?>

        <?php
        the_content();

        wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'beshop'),
                    'after' => '</div>',
                )
        );
        ?>
    </div><!-- .entry-content -->

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                    sprintf(
                            wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Edit <span class="screen-reader-text">%s</span>', 'beshop'), array(
                'span' => array(
                    'class' => array(),
                ),
                                    )
                            ), wp_kses_post(get_the_title())
                    ), '<span class="edit-link">', '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
