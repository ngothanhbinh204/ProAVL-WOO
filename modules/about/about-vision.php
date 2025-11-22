<?php
$title = get_sub_field('title');
$visions = get_sub_field('visions');
?>
<section class="section-vision">
    <div class="container">
        <div class="vision">
            <h2 class="vision-title heading-1 text-center"><?= $title ?></h2>
            <div class="swiper-column-auto slide-vision-content-list auto-3-column mt-base-24">
                <div class="swiper">
                    <ul class="swiper-wrapper vision-content-list">
                        <?php if($visions): ?>
                        <?php foreach($visions as $item): ?>
                        <?php 
                                    $icon = $item['icon'];
                                    $item_title = $item['title'];
                                    $description = $item['description'];
                                ?>
                        <li class="swiper-slide">
                            <div
                                class="vision-content-item text-center py-6 px-10 flex flex-col justify-between h-full">
                                <div class="header">
                                    <div class="icon w-30 h-30 mx-auto">
                                        <?= get_image_attrachment($icon) ?>
                                    </div>
                                    <h3 class="title mt-10 heading-2-regular text-primary-3 uppercase">
                                        <?= $item_title ?>
                                    </h3>
                                </div>
                                <div class="desc text-body-1 mt-5">
                                    <?= $description ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
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