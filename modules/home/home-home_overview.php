<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$content = get_sub_field('content');
$button = get_sub_field('button');
$image = get_sub_field('image');
?>
<section class="section-bg gradient-1">
    <section class="section-home-overview section-py lg:pb-10">
        <div class="container"> 
            <div class="home-overview">
                <div class="content-main">
                    <h2 class="home-overview-title heading-1"><?= $title ?></h2>
                    <div class="home-overview-subtitle heading-5 text-utility-gray-800 mt-base">
                        <?= $subtitle ?>
                    </div>
                    <div class="home-overview-content mt-5 text-body-1"> 
                        <?= $content ?>
                    </div>
                    <?php if($button): ?>
                        <a class="btn btn-primary mt-base" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
                    <?php endif; ?>
                </div>
                <div class="block-img"> 
                    <div class="thumb"> 
                        <?= get_image_attrachment($image) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
