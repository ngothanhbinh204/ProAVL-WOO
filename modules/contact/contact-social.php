<?php
$title = get_sub_field('title');
$social_items = get_sub_field('social_items');
?>
<section class="section-social section-py">
    <div class="container"> 
        <div class="social">
            <h2 class="social-title heading-1"><?= $title ?></h2>
            <div class="swiper-social swiper"> 
                <ul class="swiper-wrapper social-list">
                    <?php if($social_items): ?>
                        <?php foreach($social_items as $item): ?>
                            <?php 
                                $icon = $item['icon'];
                                $name = $item['name'];
                                $link = $item['link'];
                                $qr_code = $item['qr_code'];
                            ?>
                            <li class="swiper-slide social-item">
                                <div class="flex-between-center gap-2 p-5 lg:p-8 rounded-2 shadow-shadow-4"> 
                                    <div class="meta-data flex flex-col gap-y-3">
                                        <div class="icon-brand"> 
                                            <?= get_image_attrachment($icon) ?>
                                        </div>
                                        <h4 class="name-brand text-body-1 break-all"><a href="<?= $link ? $link['url'] : '#!' ?>" <?= $link ? 'target="'.$link['target'].'"' : '' ?>><?= $name ?></a></h4>
                                    </div>
                                    <div class="qa-code shrink-0 w-17 xl:w-20 h-17 xl:h-20">
                                        <?= get_image_attrachment($qr_code) ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
