<?php /* Template name: Page - Product */ ?>
<?= get_header() ?>
<?php get_template_part('modules/common/banner') ?>
<?php get_template_part('modules/common/breadcrumb')?>
<?php
$title = get_field('title');
$description = get_field('subtitle');
$categories = get_field('categories');
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
            <?php if ($categories) : ?>
            <ul class="block-product-list flex flex-col gap-base lg:gap-20 mt-base">
                <?php foreach ($categories as $term_id) : 
                        $term = get_term($term_id);
                        $products = new WP_Query([
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'tax_query' => [
                                [
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $term_id,
                                ]
                            ]
                        ]);
                    ?>
                <?php if ($products->have_posts()) : ?>
                <li class="block-product-item">
                    <h3 class="title-category heading-2-regular uppercase pb-4 border-b border-primary-1">
                        <?= $term->name ?></h3>
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
                        <?php endwhile; wp_reset_postdata(); ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= get_footer() ?>