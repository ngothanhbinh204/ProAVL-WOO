<?php
$title = get_field('learners_title');
$items = get_field('learners_items'); // Repeater: image, text
?>
<section class="section-learners-can section-py lg:pt-15 pb-30">
    <div class="container"> 
        <div class="learners-can">
            <?php if ($title) : ?>
                <h2 class="learners-can-title heading-1 text-center"><?= $title ?></h2>
            <?php endif; ?>
            <?php if ($items) : ?>
                <div class="swiper-column-auto block-learners-can-slide auto-4-column mt-base">
                    <div class="swiper"> 
                        <ul class="swiper-wrapper learners-can-list">
                            <?php foreach ($items as $item) : ?>
                                <li class="swiper-slide learners-can-item">
                                    <div class="learners-can-item zoom-img-parent h-full">
                                        <div class="block-thumb"> 
                                            <div class="thumb img-zoom">
                                                <img class="lozad" data-src="<?= $item['image']['url'] ?>" alt="<?= $item['image']['alt'] ?>"/>
                                            </div>
                                        </div>
                                        <div class="learners-can-info">
                                            <div class="info-content"> 
                                                <p><?= $item['text'] ?></p>
                                            </div>
                                        </div>
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