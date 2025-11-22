<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$services = get_sub_field('services');
$button_all = get_sub_field('button_all');
?>
<section class="section-service section-py bg-utility-gray-50">
    <div class="container"> 
        <div class="service flex flex-col gap-base items-center">
            <div class="service-header text-center">
                <h2 class="service-title heading-1"><?= $title ?></h2>
                <div class="service-subtitle text-body-1 mt-5">
                    <?= $subtitle ?>
                </div>
            </div>
            <ul class="service-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-base">
                <?php if($services): ?>
                    <?php foreach($services as $item): ?>
                        <?php 
                            $icon = $item['icon'];
                            $title = $item['title'];
                            $description = $item['description'];
                            $link = $item['link'];
                            $image = $item['image'];
                        ?>
                        <li class="service-item">
                            <?php if($image): ?>
                                <div class="block-thumb"> 
                                    <div class="thumb"> 
                                        <?= get_image_attrachment($image) ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="icon">
                                    <?= get_image_attrachment($icon) ?>
                                </div>
                            <?php endif; ?>
                            <div class="service-info"> 
                                <h3 class="info-name"><?= $title ?></h3>
                                <div class="info-desc">
                                    <?= $description ?>
                                </div>
                                <?php if($link): ?>
                                    <a class="btn <?= $image ? 'btn-white' : 'btn-primary' ?> btn-detail" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $link['title'] ?></a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <?php if($button_all): ?>
                <a class="btn btn-primary" href="<?= $button_all['url'] ?>" target="<?= $button_all['target'] ?>"><?= $button_all['title'] ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
