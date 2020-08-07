<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package beshop
 */

get_header();
$isArch = is_archive();
?>

	<div id="primary" class="content-area wooc <?php echo $isArch ? 'arch' : '' ?>">
    <?php if ($isArch) { ?>
    <aside id="filters-bar">
      <?php dynamic_sidebar( 'sidebar-1' ) ?>
    </aside>
    <?php } ?>
		<main id="main" class="site-main">

		<?php woocommerce_content(); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
