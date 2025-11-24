<?php
/**
 * The template for displaying search results pages
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 */
do_action('woocommerce_before_main_content');
?>

<?php get_template_part('modules/common/banner') ?>
<div class="space-header pt-[var(--header-height)]"></div>
<?php get_template_part('modules/common/breadcrumb') ?>

<section class="section-product section-py lg:pt-15 lg:pb-30">
    <div class="container">
        <div class="product">
            <div class="product-header text-center">
                <h2 class="header-title heading-1"><?= __('Kết quả tìm kiếm', 'canhcamtheme') ?>:
                    "<?= get_search_query() ?>"</h2>
            </div>

            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
            // 1. Products Search
            $product_args = array(
                'post_type' => 'product',
                'posts_per_page' => 12,
                'paged' => $paged,
                's' => get_search_query()
            );
            $products = new WP_Query($product_args);

            if ($products->have_posts()) :
            ?>
            <div class="block-product-item mt-10">
                <h3 class="title-category heading-2-regular uppercase pb-4 border-b border-primary-1">
                    <?= __('Sản phẩm', 'canhcamtheme') ?>
                </h3>
                <ul class="product-list grid-cols-4-res gap-base mt-base">
                    <?php while ($products->have_posts()) : $products->the_post(); ?>
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
            </div>
            <?php wp_reset_postdata(); endif; ?>

            <?php
            // 2. Posts Search
            $post_args = array(
                'post_type' => 'post',
                'posts_per_page' => 12,
                'paged' => $paged,
                's' => get_search_query()
            );
            $posts_query = new WP_Query($post_args);

            if ($posts_query->have_posts()) :
            ?>
            <div class="block-product-item mt-10">
                <h3 class="title-category heading-2-regular uppercase pb-4 border-b border-primary-1">
                    <?= __('Tin tức', 'canhcamtheme') ?>
                </h3>
                <ul class="product-list grid-cols-4-res gap-base mt-base">
                    <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
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
            </div>
            <?php wp_reset_postdata(); endif; ?>

            <?php if ( !$products->have_posts() && !$posts_query->have_posts() ) : ?>
            <div class="no-results not-found text-center py-20">
                <h3 class="heading-3"><?= __('Không tìm thấy nội dung', 'canhcamtheme') ?></h3>
                <p><?= __('Vui lòng thử lại với từ khóa khác.', 'canhcamtheme') ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer('shop');
?>