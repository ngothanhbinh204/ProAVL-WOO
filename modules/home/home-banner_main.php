<?php
$slider = get_sub_field('slider');
?>
<section class="section-banner-main">
    <div class="swiper swiper-banner">
        <div class="user-guide absolute-x-center bottom-4 z-2 flex-center w-9 lg:w-15 h-9 lg:h-15 rounded-full border border-white text-base lg:text-2xl text-white pointer-events-none"><i class="fa-light fa-arrow-down"></i></div>
        <div class="swiper-wrapper"> 
            <?php if($slider): ?>
                <?php foreach($slider as $item): ?>
                    <?php 
                        $image = $item['image'];
                        $subtitle = $item['subtitle'];
                        $title = $item['title'];
                        $button = $item['button'];
                    ?>
                    <div class="swiper-slide relative">
                        <div class="img-banner"> 
                            <a class="img-ratio -md:h-[100dvh] -md:p-0 md:ratio:pt-[2_3] lg:ratio:pt-[960_1920]" href="#!">
                                <?= get_image_attrachment($image) ?>
                            </a>
                        </div>
                        <div class="container block-content-banner absolute-x-center rem:bottom-[8%] xl:rem:bottom-[157px] z-2">
                            <div class="content-banner -md:w-full md:rem:max-w-[480px]">
                                <div class="subtitle text-body-2 text-[#E1DDD9]">
                                    <?= $subtitle ?>
                                </div>
                                <h2 class="title heading-3 text-white mt-3"><?= $title ?></h2>
                                <?php if($button): ?>
                                    <a class="btn btn-black uppercase mt-6 lg:mt-10" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
