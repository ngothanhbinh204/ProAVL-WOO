<?php get_header() ?>
<?php
$title = get_the_title();
$date = get_the_date('d.m.Y');
$intro = get_the_excerpt();
$content = get_the_content();
$related_news = get_field('related_news');
?>

<section class="section-bg bg-utility-gray-50">
    <div class="space-header pt-[var(--header-height)]"></div>
    <?php get_template_part('modules/common/breadcrumb') ?>

    <!-- header-content -->
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
                <div
                    class="main-content xl:flex-[1_1_0] xl:overflow-y-auto xl:overflow-scroll-1 flex flex-col gap-y-5 text-body-1 mt-10">
                    <?= $intro ?>
                </div>
            </div>
            <div class="block-img">
                <div class="img img-ratio ratio:pt-[540_960]  rounded-l-4">
                    <?= get_image_post(get_the_ID(), 'image') ?>
                </div>
            </div>
        </div>
    </section>

    <!-- content  -->
    <section class="section-news-detail-main-content">
        <div class="container">
            <div class="news-detail-main-content py-10 lg:py-15 px-8 lg:px-12 rounded-4 bg-white">
                <div class="format-content">
                    <?= apply_filters('the_content', $content) ?>
                </div>
            </div>
        </div>
    </section>

    <!-- related posts -->

    <section class="section-other-news section-py lg:rem:pt-[105px]">
        <div class="container">
            <div class="other-news">
                <h2 class="other-news-title heading-1 text-center">Tin tức khác</h2>

                <?php 
            $related_args = [
                'post_type'      => 'post',
                'posts_per_page' => 6,               
                'post__not_in'   => [get_the_ID()], 
                'orderby'        => 'rand',        
                'post_status'    => 'publish',
            ];

            $related_news = get_posts($related_args);
            
            if ($related_news) :
            ?>
                <div class="swiper-column-auto auto-3-column py-4 mt-base">
                    <div class="swiper">
                        <ul class="swiper-wrapper other-news-list">
                            <?php foreach ($related_news as $p) : ?>
                            <li class="swiper-slide other-news-item">
                                <div class="news-item zoom-img-parent h-full">
                                    <div class="block-thumb">
                                        <div class="thumb img-zoom">
                                            <?php 
													echo get_image_post($p->ID, 'image');
                                            ?>

                                        </div>
                                    </div>
                                    <div class="news-info mt-3">
                                        <h3 class="info-name text-lg font-bold line-clamp-2">
                                            <a href="<?= get_permalink($p->ID) ?>"
                                                class="hover:text-primary transition-colors">
                                                <?= get_the_title($p->ID) ?>
                                            </a>
                                        </h3>
                                        <a class="btn btn-white btn-seemore mt-2 inline-block text-sm font-medium text-primary hover:underline"
                                            href="<?= get_permalink($p->ID) ?>">Xem chi tiết</a>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="wrap-button-slide static-mobile mt-5 flex justify-center gap-3">
                        <button
                            class="btn btn-slide-circ btn-prev w-10 h-10 rounded-full border border-gray-200 flex-center hover:bg-primary hover:text-white transition-all">
                            <i class="fa-light fa-angle-left"></i>
                        </button>
                        <button
                            class="btn btn-slide-circ btn-next w-10 h-10 rounded-full border border-gray-200 flex-center hover:bg-primary hover:text-white transition-all">
                            <i class="fa-light fa-angle-right"></i>
                        </button>
                    </div>
                </div>
                <?php endif; 
            ?>
            </div>
        </div>
    </section>
</section>

<?php get_footer() ?>