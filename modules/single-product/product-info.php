<?php
$images = get_field('product_images');
$title_field = get_field('product_custom_title');
$title = $title_field ? $title_field : get_the_title();
$description = get_field('product_description');
$file_download = get_field('product_file_download');
$contact_button_text = get_field('product_contact_btn_text');
?>
<section class="section-detail-prd section-py lg:rem:pt-[150px] !pb-0">
    <div class="container">
        <div class="detail-product">
            <div class="detail-prd-banner-main">
                <div class="banner-prd-thumb flex lg:flex-col">
                    <div class="w-full relative lg:flex-1">
                        <div class="swiper swiper-detail-prd-thumbs lg:absolute lg:top-0 lg:left-0 lg:w-full lg:h-full">
                            <div class="swiper-wrapper">
                                <?php if ($images) : foreach ($images as $img) : ?>
                                <div class="swiper-slide">
                                    <div class="img img-ratio border border-transparent rounded-2 overflow-hidden">
                                        <img class="lozad" data-src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" />
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-prd-main">
                    <div class="swiper swiper-detail-prd-main rounded-4 overflow-hidden border border-utility-gray-200">
                        <div class="swiper-wrapper">
                            <?php if ($images) : foreach ($images as $img) : ?>
                            <div class="swiper-slide">
                                <div class="img img-ratio ratio:pt-[650_650]">
                                    <img class="lozad" data-src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" />
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-prd-main-content">
                <h1 class="name-prd heading-6"><?= $title ?></h1>
                <div class="desc-prd text-body-1 mt-5">
                    <?= $description ?>
                </div>
                <div class="action-prd flex-y-center gap-x-5 mt-5">
                    <?php if ($file_download) : ?>
                    <a class="btn btn-primary" href="<?= $file_download['url'] ?>" target="_blank">Tải PDF</a>
                    <?php endif; ?>
                    <button
                        class="btn btn-primary active btn-openPopupForm"><?= $contact_button_text ?: 'Liên hệ ngay' ?></button>
                </div>
            </div>
        </div>
    </div>
</section>