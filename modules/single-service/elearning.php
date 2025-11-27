<?php
$title = get_field('elearning_title');
$description = get_field('elearning_desc');
$button_link_array = get_field('elearning_btn_link'); 
$images = get_field('elearning_images');
?>
<section class="section-service-4 section-py lg:pt-30 lg:pb-15">
    <div class="container">
        <div class="service-4">
            <div class="service-4-header text-center text-white">
                <?php if ($title) : ?>
                <h2 class="service-4-title heading-1 text-center text-inherit"><?= $title ?></h2>
                <?php endif; ?>
                <?php if ($description) : ?>
                <div class="subtitle mt-5 text-inherit">
                    <?= $description ?>
                </div>
                <?php endif; ?>

                <?php 
                if ($button_link_array) : 
                    $url = $button_link_array['url'];
                    $title = $button_link_array['title'];
                    $target = $button_link_array['target'] ? $button_link_array['target'] : '_self';
                    
                    if ($url) :
                ?>
                <a class="btn btn-white mt-5" href="<?= esc_url($url) ?>" target="<?= esc_attr($target) ?>">
                    <?= esc_html($title) ?>
                </a>
                <?php 
                    endif;
                endif; 
                ?>

            </div>
            <?php if ($images) : ?>
            <div class="swiper-column-auto block-service-4-slide mt-base lg:mt-15">
                <div class="swiper">
                    <ul class="swiper-wrapper">
                        <?php foreach ($images as $img) : ?>
                        <li class="swiper-slide">
                            <div class="img img-ratio ratio:pt-[650_1400] rounded-4 zoom-img">
                                <img class="lozad" data-src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" />
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="wrap-button-slide static-mobile">
                    <button class="btn btn-slide btn-prev"><i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <button class="btn btn-slide btn-next"><i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>