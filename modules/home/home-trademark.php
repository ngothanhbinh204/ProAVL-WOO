<?php
$title = get_sub_field('title');
$trademarks = get_sub_field('trademarks');
?>
<section class="section-bg bg-[linear-gradient(180deg,#F6F6F6_41.81%,#FFFFFF_100%]">
    <section class="section-trademark">
        <div class="container"> 
            <div class="trademark">
                <h2 class="trademark-title heading-1 text-center"><?= $title ?></h2>
                <div class="block-slide-trademark mt-base relative">
                    <div class="swiper swiper-trademark">
                        <div class="swiper-wrapper"> 
                            <?php if($trademarks): ?>
                                <?php foreach($trademarks as $item): ?>
                                    <?php 
                                        $image = $item['image'];
                                        $link = $item['link'];
                                    ?>
                                    <div class="swiper-slide"> 
                                        <a class="img-ratio ratio:pt-[106_213] rounded-1" href="<?= $link ? $link['url'] : '#!' ?>" <?= $link ? 'target="'.$link['target'].'"' : '' ?>>
                                            <?= get_image_attrachment($image) ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="wrap-button-slide in-static">
                        <button class="btn btn-slide btn-prev"><i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <button class="btn btn-slide btn-next"><i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
