<?php
$title = get_sub_field('title');
$categories = get_terms([
    'taxonomy' => 'category',
    'hide_empty' => true,
]);
$news_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => -1, // Get all for the slider
]);
?>
<section class="section-news-page section-py lg:pt-15">
    <div class="container"> 
        <div class="news-page"> 
            <div class="new-page-header flex-y-center flex-col gap-y-5">
                <?php if ($title) : ?>
                    <h2 class="news-page-title heading-1"><?= $title ?></h2>
                <?php endif; ?>
                <?php if ($categories && !is_wp_error($categories)) : ?>
                    <ul class="events-header-tab-list">
                        <li class="events-header-tab-item active"><a href="#!">Tất cả</a></li>
                        <?php foreach ($categories as $cat) : ?>
                            <li class="events-header-tab-item"> <a href="<?= get_term_link($cat) ?>"><?= $cat->name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="news-main mt-base">
                <?php if ($news_query->have_posts()) : 
                    $posts = $news_query->posts;
                    $chunks = array_chunk($posts, 3); // Group by 3
                ?>
                    <div class="swiper-column-auto news-main-block-slide mt-base">
                        <div class="swiper"> 
                            <div class="swiper-wrapper"> 
                                <?php foreach ($chunks as $chunk) : ?>
                                    <div class="swiper-slide"> 
                                        <div class="news-list-grid">
                                            <?php if (isset($chunk[0])) : $post = $chunk[0]; setup_postdata($post); ?>
                                                <div class="block-news-first">
                                                    <div class="news-item-big zoom-img-parent">
                                                        <div class="block-thumb"> 
                                                            <div class="thumb img-zoom">
                                                                <?= get_the_post_thumbnail($post->ID, 'full', ['class' => 'lozad']) ?>
                                                            </div>
                                                        </div>
                                                        <div class="news-info"> 
                                                            <h3 class="info-name"><?= get_the_title($post->ID) ?></h3>
                                                            <div class="info-desc">
                                                                <p><?= get_the_excerpt($post->ID) ?></p>
                                                            </div>
                                                            <a class="btn btn-white btn-seemore" href="<?= get_permalink($post->ID) ?>">Xem chi tiết</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if (count($chunk) > 1) : ?>
                                                <div class="side-news"> 
                                                    <?php for ($i = 1; $i < count($chunk); $i++) : $post = $chunk[$i]; setup_postdata($post); ?>
                                                        <div class="news-item zoom-img-parent h-full">
                                                            <div class="block-thumb"> 
                                                                <div class="thumb img-zoom">
                                                                    <?= get_the_post_thumbnail($post->ID, 'full', ['class' => 'lozad']) ?>
                                                                </div>
                                                            </div>
                                                            <div class="news-info"> 
                                                                <h3 class="info-name"><?= get_the_title($post->ID) ?></h3>
                                                                <a class="btn btn-white btn-seemore" href="<?= get_permalink($post->ID) ?>">Xem chi tiết</a>
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
</section>