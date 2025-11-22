<?php
$title = get_field('related_news_title');
$related_news_list = get_field('related_news_list');
if ($related_news_list) {
    $related_news = $related_news_list;
} else {
    $related_news = get_posts([
        'post_type' => 'post',
        'posts_per_page' => 5,
        'post__not_in' => [get_the_ID()],
        'category__in' => wp_get_post_categories(get_the_ID()),
    ]);
}
?>
<section class="section-other-news section-py lg:rem:pt-[105px]">
    <div class="container">
        <div class="other-news">
            <?php if ($title) : ?>
                <h2 class="other-news-title heading-1 text-center"><?= $title ?></h2>
            <?php endif; ?>
            <div class="swiper-column-auto auto-3-column py-4 mt-base">
                <div class="swiper">
                    <ul class="swiper-wrapper other-news-list">
                        <?php foreach ($related_news as $p) : ?>
                            <li class="swiper-slide other-news-item">
                                <div class="news-item zoom-img-parent h-full">
                                    <div class="block-thumb"> 
                                        <div class="thumb img-zoom">
                                            <?= get_the_post_thumbnail($p->ID, 'full', ['class' => 'lozad']) ?>
                                        </div>
                                    </div>
                                    <div class="news-info"> 
                                        <h3 class="info-name"><?= get_the_title($p->ID) ?></h3>
                                        <a class="btn btn-white btn-seemore" href="<?= get_permalink($p->ID) ?>">Xem chi tiết</a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="wrap-button-slide static-mobile"> 
                    <button class="btn btn-slide-circ btn-prev"><i class="fa-light fa-angle-left"></i>
                    </button>
                    <button class="btn btn-slide-circ btn-next"><i class="fa-light fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
</section>