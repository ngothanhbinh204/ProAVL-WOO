<?php
/**
 * File: template-parts/layout-archive.php
 * Updated: Slider hiển thị all pages, không loại trừ bài viết
 */

$queried_object = get_queried_object();

$acf_source_id = false;

if ( is_home() ) {
    $archive_title = single_post_title( '', false );
    $archive_desc  = '';
    $acf_source_id = get_option( 'page_for_posts' ); 
    
    if ( $queried_object instanceof WP_Post ) {
         $archive_desc = apply_filters( 'the_content', $queried_object->post_content );
    }
} else {
    $archive_title = get_the_archive_title();
    $archive_desc  = get_the_archive_description();
    if ( is_category() || is_tax() ) {
        $acf_source_id = $queried_object;
    }
}

// --- 2. XỬ LÝ FILTER TABS (Giữ nguyên) ---
$is_news_archive = (is_home() || is_category() || is_tag()) && 'post' === get_post_type();
$categories = [];
if ($is_news_archive) {
    $categories = get_terms(['taxonomy' => 'category', 'hide_empty' => true]);
}

// [ĐÃ BỎ]: $exclude_ids = []; -> Không cần biến này nữa
?>

<main class="relative">
    <section class="section-bg bg-utility-gray-50">

        <?php get_template_part('modules/common/banner') ?>
        <?php get_template_part('modules/common/breadcrumb'); ?>

        <section class="section-news-page section-py lg:pt-15">
            <div class="container">
                <div class="news-page">

                    <div class="new-page-header flex-y-center flex-col gap-y-5">
                        <h1 class="news-page-title heading-1"><?= $archive_title ?></h1>

                        <?php if ($archive_desc) : ?>
                        <div class="archive-description text-body-1"><?= $archive_desc ?></div>
                        <?php endif; ?>

                        <?php if ($is_news_archive && !empty($categories) && !is_wp_error($categories)) : ?>
                        <ul class="events-header-tab-list">
                            <li class="events-header-tab-item <?= (is_home() && !is_category()) ? 'active' : '' ?>">
                                <a href="<?= get_post_type_archive_link('post') ?>">Tất cả</a>
                            </li>
                            <?php foreach ($categories as $cat_item) : 
                                $is_active = (isset($queried_object->term_id) && $queried_object->term_id === $cat_item->term_id) ? 'active' : '';
                            ?>
                            <li class="events-header-tab-item <?= $is_active ?>">
                                <a href="<?= get_term_link($cat_item) ?>"><?= $cat_item->name ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>

                    <div class="news-main mt-base">

                        <?php 
                        $blog_page_id = get_option( 'page_for_posts' );
                        $slider_posts = get_field('post_sliders', $blog_page_id);

                        if ( $slider_posts ) : 
                        ?>
                        <div class="swiper-column-auto news-main-block-slide mt-base">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <?php 
                                        // Chia nhóm 3 bài (Chunking)
                                        $chunks = array_chunk($slider_posts, 3);
                                        
                                        foreach ($chunks as $chunk) : 
                                        ?>
                                    <div class="swiper-slide">
                                        <div class="news-list-grid">

                                            <?php if (isset($chunk[0])) : $post = $chunk[0]; setup_postdata($post); ?>
                                            <div class="block-news-first">
                                                <div class="news-item-big zoom-img-parent">
                                                    <div class="block-thumb">
                                                        <div class="thumb img-zoom">
                                                            <a href="<?= get_permalink($post->ID) ?>">
                                                                <?= get_the_post_thumbnail($post->ID, 'full', ['class' => 'lozad']) ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="news-info">
                                                        <h3 class="info-name"><a
                                                                href="<?= get_permalink($post->ID) ?>"><?= get_the_title($post->ID) ?></a>
                                                        </h3>
                                                        <div class="info-desc line-clamp-2">
                                                            <?= get_the_excerpt($post->ID) ?></div>
                                                        <a class="btn btn-white btn-seemore"
                                                            href="<?= get_permalink($post->ID) ?>">Xem chi tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <?php if (count($chunk) > 1) : ?>
                                            <div class="side-news">
                                                <?php for ($i = 1; $i < count($chunk); $i++) : 
                                                        if (isset($chunk[$i])) : $post = $chunk[$i]; setup_postdata($post);
                                                    ?>
                                                <div class="news-item zoom-img-parent h-full">
                                                    <div class="block-thumb">
                                                        <div class="thumb img-zoom">
                                                            <a href="<?= get_permalink($post->ID) ?>">
                                                                <?= get_the_post_thumbnail($post->ID, 'full', ['class' => 'lozad']) ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="news-info">
                                                        <h3 class="info-name"><a
                                                                href="<?= get_permalink($post->ID) ?>"><?= get_the_title($post->ID) ?></a>
                                                        </h3>
                                                        <a class="btn btn-white btn-seemore"
                                                            href="<?= get_permalink($post->ID) ?>">Xem chi tiết</a>
                                                    </div>
                                                </div>
                                                <?php endif; endfor; ?>
                                            </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <?php endforeach; wp_reset_postdata(); ?>
                                </div>
                            </div>
                            <div class="wrap-button-slide">
                                <button class="btn btn-slide-circ btn-prev"><i
                                        class="fa-light fa-angle-left"></i></button>
                                <button class="btn btn-slide-circ btn-next"><i
                                        class="fa-light fa-angle-right"></i></button>
                            </div>
                        </div>
                        <?php endif; // End check Slider Posts ?>


                        <?php if ( have_posts() ) : ?>
                        <ul class="news-main-list grid-cols-3-res gap-base mt-10 pt-10 border-t border-primary-1">
                            <?php 
                            while ( have_posts() ) : the_post(); 
                                // [ĐÃ BỎ]: Logic check $exclude_ids -> Hiển thị mọi bài viết được query ra
                            ?>
                            <li class="news-item zoom-img-parent h-full">
                                <div class="block-thumb">
                                    <div class="thumb img-zoom">
                                        <a href="<?= get_permalink() ?>">
                                            <?php 
                                            if (has_post_thumbnail()) {
                                                echo get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'lozad']);
                                            }
                                            ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="news-info">
                                    <h3 class="info-name"><a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
                                    </h3>
                                    <a class="btn btn-white btn-seemore" href="<?= get_permalink() ?>">Xem chi tiết</a>
                                </div>
                            </li>
                            <?php endwhile; ?>
                        </ul>

                        <div class="pagination justify-center mt-10">
                            <?php 
                                if (function_exists('custom_pagination')) {
                                    custom_pagination();
                                }
                            ?>
                        </div>

                        <?php else : ?>
                        <?php if ( empty($slider_posts) ) : ?>
                        <div class="no-results not-found text-center py-20">
                            <h3 class="heading-3">Không tìm thấy nội dung</h3>
                            <p>Hiện chưa có bài viết nào trong mục này.</p>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>
    </section>
</main>