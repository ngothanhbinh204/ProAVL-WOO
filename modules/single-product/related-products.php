<?php
$title = get_field('related_products_title'); 

$related_products = [];

$terms = get_the_terms(get_the_ID(), 'product_cat');

if ($terms && !is_wp_error($terms)) {
    $term_ids = wp_list_pluck($terms, 'term_id');
    
    $related_products = get_posts([
        'post_type' => 'product',
        'posts_per_page' => 4,
        'post__not_in' => [get_the_ID()], 
        'tax_query' => [
            [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $term_ids,
                'operator' => 'IN', 
            ]
        ]
    ]);
}

if (!$related_products) {
    return; 
}
?>

<section class="section-other-products section-py">
    <div class="container">
        <div class="other-products">
            <?php if ($title) : ?>
            <h2 class="other-products-title heading-1 text-center"><?= $title ?></h2>
            <?php endif; ?>

            <div class="swiper-column-auto auto-4-column block-other-products-slide mt-base">
                <div class="swiper">
                    <ul class="swiper-wrapper other-products-list">
                        <?php 
                        foreach ($related_products as $p) : 
                            $p_id = is_object($p) ? $p->ID : $p;
                        ?>
                        <li class="swiper-slide other-products-item">
                            <div class="product-item zoom-img-parent h-full">
                                <div class="product-thumb">
                                    <a class="img-zoom" href="<?= get_permalink($p_id) ?>">
                                        <?= get_the_post_thumbnail($p_id, 'full', ['class' => 'lozad']) ?>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <div class="info-child">
                                        <h3 class="info-name">
                                            <a href="<?= get_permalink($p_id) ?>"><?= get_the_title($p_id) ?></a>
                                        </h3>
                                        <a class="btn btn-seemore product-seemore" href="<?= get_permalink($p_id) ?>">
                                            Xem thêm<i class="fa-regular fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="wrap-button-slide mobile-static">
                    <button class="btn btn-slide btn-prev"><i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button class="btn btn-slide btn-next"><i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>