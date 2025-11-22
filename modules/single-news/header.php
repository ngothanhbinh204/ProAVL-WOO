<?php
$title = get_field('news_header_title') ?: get_the_title();
$date = get_field('news_header_date') ?: get_the_date('d.m.Y');
$intro = get_field('news_header_intro') ?: get_the_excerpt(); // Or a custom field
$image_field = get_field('news_header_image');
$image = $image_field ? $image_field['url'] : get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<section class="section-news-detail-header section-py lg:pb-10">
    <div class="news-detail-header">
        <div class="block-content flex flex-col">
            <h1 class="title-news heading-4 text-primary-3"><?= $title ?></h1>
            <div class="date-social flex-y-center gap-x-5 mt-6"> 
                <div class="date flex-y-center gap-x-3 text-utility-gray-500">
                        <i class="fa-regular fa-clock text-2xl "></i>
                    <div class="data-content text-body-3"><?= $date ?></div>
                </div>
                <ul class="social-list"> 
                    <li class="social-item item-face"><a href="#!">
                                <i class="fa-brands fa-facebook"></i> </a></li>
                </ul>
            </div>
            <div class="main-content xl:flex-[1_1_0] xl:overflow-y-auto xl:overflow-scroll-1 flex flex-col gap-y-5 text-body-1 mt-10">
                <?= $intro ?>
            </div>
        </div>
        <div class="block-img"> 
            <div class="img img-ratio ratio:pt-[540_960]  rounded-l-4">
                <img class="lozad" data-src="<?= $image ?>" alt="<?= $title ?>"/>
            </div>
        </div>
    </div>
</section>