<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

// // Define all variables at the top
// $term = get_queried_object();
// $title_category = get_field('category_title', 'product_cat_' . $term->term_id);
// $page_title = $title_category ? $title_category : $term->name;

// // Shortcode variables
// $product_filter_sort_shortcode = '[facetwp facet="product_filter_sort"]';
// $pagination_product_shortcode = '[facetwp facet="pagination_product"]';

// // Text strings
// $filter_by_text = __('Lọc theo', 'canhcamtheme');
// $filter_text = __('Bộ lọc', 'canhcamtheme');
// $product_filter_title_text = __('Bộ lọc sản phẩm', 'canhcamtheme');

// // Template directory path
// $template_directory = get_template_directory_uri();

get_header('shop');
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>
<?php get_template_part('modules/common/banner') ?>
<?php get_template_part('modules/common/breadcrumb') ?>
<?php
$current_object = get_queried_object();
$title = '';
$description = '';
$parent_id = 0;
$is_leaf = false;

if ( is_product_category() ) {
    $current_term = $current_object;
    $title = $current_term->name;
    $description = $current_term->description;
    $parent_id = $current_term->term_id;
    
    // Check for ACF overrides
    $acf_title = get_field('title', $current_term);
    if ($acf_title) $title = $acf_title;
    $acf_desc = get_field('subtitle', $current_term);
    if ($acf_desc) $description = $acf_desc;

} elseif ( is_shop() ) {
    $title = woocommerce_page_title(false);
    $parent_id = 0; // Root categories
    $shop_page_id = wc_get_page_id( 'shop' );
    $acf_title = get_field('title', $shop_page_id);
    if ($acf_title) $title = $acf_title;
    $acf_desc = get_field('subtitle', $shop_page_id);
    if ($acf_desc) $description = $acf_desc;
}

// Get direct children
$child_terms = get_terms([
    'taxonomy' => 'product_cat',
    'parent' => $parent_id,
    'hide_empty' => true
]);

if ( empty($child_terms) ) {
    $is_leaf = true;
}
?>
<section class="section-product section-py lg:pt-15 lg:pb-30">
    <div class="container">
        <div class="product">
            <div class="product-header text-center">
                <?php if ($title) : ?>
                <h2 class="header-title heading-1"><?= $title ?></h2>
                <?php endif; ?>
                <?php if ($description) : ?>
                <div class="subtitle text-body-1 mt-5"><?= $description ?></div>
                <?php endif; ?>
            </div>

            <?php if ( ! $is_leaf ) : ?>
            <ul class="block-product-list flex flex-col gap-base lg:gap-20 mt-base">
                <?php foreach ($child_terms as $child) : 
                        $grandchildren = get_terms([
                            'taxonomy' => 'product_cat',
                            'parent' => $child->term_id,
                            'hide_empty' => true
                        ]);
                        $has_grandchildren = !empty($grandchildren);
                    ?>
                <li class="block-product-item">
                    <h3 class="title-category heading-2-regular uppercase pb-4 border-b border-primary-1">
                        <a href="<?= get_term_link($child) ?>"><?= $child->name ?></a>
                    </h3>
                    <ul class="product-list grid-cols-4-res gap-base mt-base">
                        <?php if ($has_grandchildren) : ?>
                        <?php foreach ($grandchildren as $grandchild) : 
                                $thumbnail_id = get_term_meta( $grandchild->term_id, 'thumbnail_id', true );
                                $image = wp_get_attachment_image( $thumbnail_id, 'full', false, ['class' => 'lozad'] );
                                if (!$image) {
                                    $image = wc_placeholder_img('full', ['class' => 'lozad']);
                                }
                            ?>
                        <li class="product-item zoom-img-parent h-full">
                            <div class="product-thumb">
                                <a class="img-zoom" href="<?= get_term_link($grandchild) ?>">
                                    <?= $image ?>
                                </a>
                            </div>
                            <div class="product-info">
                                <div class="info-child">
                                    <h3 class="info-name"> <a
                                            href="<?= get_term_link($grandchild) ?>"><?= $grandchild->name ?></a>
                                    </h3>
                                    <a class="btn btn-seemore product-seemore"
                                        href="<?= get_term_link($grandchild) ?>">Xem thêm<i
                                            class="fa-regular fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php else : 
                             $products = new WP_Query([
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'tax_query' => [
                                    [
                                        'taxonomy' => 'product_cat',
                                        'field' => 'term_id',
                                        'terms' => $child->term_id,
                                    ]
                                ]
                            ]);
                            if ($products->have_posts()) :
                                while ($products->have_posts()) : $products->the_post();
                        ?>
                        <li class="product-item zoom-img-parent h-full">
                            <div class="product-thumb">
                                <a class="img-zoom" href="<?= get_permalink() ?>">
                                    <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'lozad']) ?>
                                </a>
                            </div>
                            <div class="product-info">
                                <div class="info-child">
                                    <h3 class="info-name"> <a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
                                    </h3>
                                    <a class="btn btn-seemore product-seemore" href="<?= get_permalink() ?>">Xem thêm<i
                                            class="fa-regular fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <?php endwhile; wp_reset_postdata(); endif; ?>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else : ?>
            <?php if ( have_posts() ) : ?>
            <ul class="product-list grid-cols-4-res gap-base mt-base">
                <?php while ( have_posts() ) : the_post(); ?>
                <li class="product-item zoom-img-parent h-full">
                    <div class="product-thumb">
                        <a class="img-zoom" href="<?= get_permalink() ?>">
                            <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'lozad']) ?>
                        </a>
                    </div>
                    <div class="product-info">
                        <div class="info-child">
                            <h3 class="info-name"> <a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
                            </h3>
                            <a class="btn btn-seemore product-seemore" href="<?= get_permalink() ?>">Xem thêm<i
                                    class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php 
                    do_action( 'woocommerce_after_shop_loop' );
                else:
                    do_action( 'woocommerce_no_products_found' );
                endif; 
                ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
get_footer('shop');
?>