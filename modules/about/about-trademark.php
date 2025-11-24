<?php
$title = get_sub_field('title');
$selected_brands = get_sub_field('thuong_hieu_page_gioi_thieu'); 
?>
<section class="section-bg section-py">
    <section class="section-trademark">
        <div class="container">
            <div class="trademark">

                <?php if ($title) : ?>
                <h2 class="trademark-title heading-1 text-center"><?= $title ?></h2>
                <?php endif; ?>

                <div class="block-slide-trademark mt-base relative">
                    <div class="swiper swiper-trademark">
                        <div class="swiper-wrapper">

                            <?php if ( $selected_brands ) : ?>
                            <?php foreach ($selected_brands as $brand_item) : 
                                    if ( is_object($brand_item) ) {
                                        $brand = $brand_item;
                                    } else {
                                        $brand = get_term( $brand_item, 'product_brand' );
                                    }
                                    if ( ! $brand || is_wp_error($brand) ) continue;
                                    $term_id    = $brand->term_id;
                                    $brand_link = get_term_link($brand);
                                    $image_html = '';
                                    $thumbnail_id = get_term_meta( $term_id, 'thumbnail_id', true );
                                    if ( ! $thumbnail_id ) {
                                        $thumbnail_id = get_term_meta( $term_id, 'product_search_image_id', true );
                                    }
                                    if ( $thumbnail_id ) {
                                        $image_html = get_image_attrachment( $thumbnail_id, 'image' );
                                    } 
                                    else {
                                        $image_html = '<img src="' . wc_placeholder_img_src() . '" class="w-full h-full object-contain grayscale opacity-50" alt="No Logo">';
                                    }
                                ?>
                            <div class="swiper-slide">
                                <a class="img-ratio ratio:pt-[106_213] rounded-1" href="<?= esc_url($brand_link) ?>"
                                    title="<?= esc_attr($brand->name) ?>">
                                    <?= $image_html ?>
                                </a>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <!-- Fallback nếu không chọn brand nào -->
                            <div class="swiper-slide">
                                <p class="text-center w-full py-4">Chưa có thương hiệu nào được chọn.</p>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="wrap-button-slide in-static">
                        <button class="btn btn-slide btn-prev"><i class="fa-solid fa-arrow-left"></i></button>
                        <button class="btn btn-slide btn-next"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </section>
</section>