<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$solutions = get_sub_field('solutions');
?>
<section class="section-solution section-py">
    <div class="container">
        <div class="solution flex flex-col gap-base items-center">
            <div class="solution-header text-center">
                <h2 class="solution-title heading-1"><?= $title ?></h2>
                <div class="subtitle text-body-1 mt-5">
                    <?= $subtitle ?>
                </div>
            </div>
            <div class="swiper-column-auto block-solution-list auto-4-column w-full">
                <div class="swiper">
                    <ul class="swiper-wrapper solution-list">
                        <?php if($solutions): ?>
                        <?php foreach($solutions as $p): ?>
                        <li class="swiper-slide">
                            <div class="solution-item">
                                <div class="solution-thumb"> <a href="<?= get_permalink($p->ID) ?>"><img class="lozad"
                                            data-src="<?= get_the_post_thumbnail_url($p->ID, 'full') ?>"
                                            alt="<?= get_the_title($p->ID) ?>" /></a></div>
                                <div class="solution-info">
                                    <h3 class="info-name"> <a
                                            href="<?= get_permalink($p->ID) ?>"><?= get_the_title($p->ID) ?></a></h3><a
                                        class="btn-discover" href="<?= get_permalink($p->ID) ?>">
                                        <i class="fa-regular fa-arrow-right icon"></i>
                                        <div class="content">Khám phá</div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                    <div class="pointer-animate"> <img class="lozad undefined" data-src="./img/HandPointing.svg"
                            alt="" />
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>