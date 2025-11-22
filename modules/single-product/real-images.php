<?php
$title = get_field('real_images_title');
$images = get_field('real_images_gallery');
?>
<section class="section-real-image section-py lg:py-24">
    <div class="container">
        <div class="real-image">
            <?php if ($title) : ?>
            <h2 class="real-image-title heading-1 text-center"><?= $title ?></h2>
            <?php endif; ?>
            <div class="block-swiper-real-image relative">
                <div class="swiper-real-image swiper mt-base ">
                    <div class="swiper-wrapper">
                        <?php if ($images) : foreach ($images as $img) : ?>
                        <div class="swiper-slide">
                            <div class="img img-ratio ratio:pt-[675_1060] rounded-4">
                                <img class="lozad" data-src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" />
                            </div>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
                <div class="wrap-button-slide static-mobile">
                    <button class="btn btn-slide btn-prev"><i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button class="btn btn-slide btn-next"><i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>