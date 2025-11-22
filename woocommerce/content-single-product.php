<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<?php get_template_part('modules/single-product/product-info'); ?>
<?php get_template_part('modules/single-product/tech-specs'); ?>
<?php get_template_part('modules/single-product/real-images'); ?>
<?php get_template_part('modules/single-product/core-values'); ?>
<?php get_template_part('modules/single-product/related-products'); ?>
<?php get_template_part('modules/single-product/popup-form'); ?>

<?php do_action('woocommerce_after_single_product'); ?>