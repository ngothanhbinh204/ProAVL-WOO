<?php
$title = get_sub_field('title');
$business_info = get_sub_field('business_info');
$form_title = get_sub_field('form_title');
$form_subtitle = get_sub_field('form_subtitle');
$form_shortcode = get_sub_field('form_shortcode');
?>
<section class="section-contact section-py">
    <div class="container"> 
        <div class="contact"> 
            <h1 class="contact heading-1"><?= $title ?></h1>
            <div class="contact-main mt-3">
                <div class="contact-business-info">
                    <div class="contact-business-info-child flex flex-col h-full p-8 pr-3.5 bg-utility-gray-50">
                        <ul class="business-info-list lg:flex-[1_1_0] lg:overflow-y-auto lg:overflow-scroll-1 lg:pr-3.5">
                            <?php if($business_info): ?>
                                <?php foreach($business_info as $item): ?>
                                    <?php 
                                        $item_title = $item['title'];
                                        $address = $item['address'];
                                        $phone_1 = $item['phone_1'];
                                        $phone_2 = $item['phone_2'];
                                        $map_link = $item['map_link'];
                                    ?>
                                    <li class="business-info-item"> 
                                        <div class="title heading-4 text-primary-3"><?= $item_title ?></div>
                                        <ul class="content-list flex flex-col mt-3 gap-y-1">
                                            <li class="content-item flex items-baseline gap-x-2.5"> 
                                                <div class="icon text-base text-primary-3"><i class="fa-light fa-location-dot"></i></div>
                                                <div class="content"><?= $address ?></div>
                                            </li>
                                            <?php if($phone_1): ?>
                                                <li class="content-item flex items-center gap-x-2.5"> 
                                                    <div class="icon text-base text-primary-3"><i class="fa-light fa-location-dot"></i></div><a class="content" href="tel:<?= $phone_1 ?>"><?= $phone_1 ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($phone_2): ?>
                                                <li class="content-item flex items-center gap-x-2.5"> 
                                                    <div class="icon text-base text-primary-3"><i class="fa-light fa-location-dot"></i></div><a class="content" href="tel:<?= $phone_2 ?>"><?= $phone_2 ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                        <?php if($map_link): ?>
                                            <div class="block-map inline-flex items-center gap-x-2 text-primary-1 mt-3">
                                                <a href="<?= $map_link['url'] ?>" target="<?= $map_link['target'] ?>" class="map-content text-body-5 uppercase">XEM BẢN ĐỒ</a>
                                                <div class="icon text-base"><i class="fa-light fa-map"></i></div>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="block-contact-form">
                    <div class="block-form"> 
                        <h3 class="form-title heading-2-regular uppercase text-primary-1"><?= $form_title ?></h3>
                        <div class="subtitle mt-3 text-body-1 text-[rgba(39,37,31,1)]"><?= $form_subtitle ?></div>
                        <?php if($form_shortcode): ?>
                            <?= do_shortcode($form_shortcode) ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
