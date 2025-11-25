<?php 
/* Template name: Page - Solution */ 
get_header(); 
?>

<main id="main-content">
    <?php 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); 

            $s_title       = get_the_title(); 
            $s_description = get_the_content(); 

            // --- 2. QUERY LẤY LIST SOLUTIONS CPT ---
            $solutions = new WP_Query([
                'post_type'      => 'solution',
                'posts_per_page' => -1,
                'post_status'    => 'publish', // Chỉ lấy bài đã đăng
                'orderby'        => 'date',    // Hoặc 'menu_order' nếu muốn sắp xếp tùy chỉnh
                'order'          => 'DESC',
            ]);
    ?>
    <?php get_template_part('modules/common/banner')?>

    <?php get_template_part('modules/common/breadcrumb')?>

    <section class="section-solution section-py lg:pt-15">
        <div class="container">
            <div class="solution flex flex-col gap-base items-center">
                <div class="solution-header text-center">
                    <?php if ($s_title) : ?>
                    <h1 class="solution-title heading-1"><?= esc_html($s_title) ?></h1>
                    <?php endif; ?>

                    <?php if ($s_description) : ?>
                    <div class="subtitle text-body-1 mt-5">
                        <?= wp_kses_post($s_description) ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- LIST SOLUTIONS: Lấy từ CPT Solution -->
                <?php if ($solutions->have_posts()) : ?>
                <div class="swiper-column-auto block-solution-list auto-4-column w-full">
                    <div class="swiper">
                        <ul class="swiper-wrapper solution-list">
                            <?php while ($solutions->have_posts()) : $solutions->the_post(); ?>
                            <li class="swiper-slide">
                                <div class="solution-item">

                                    <!-- Thumbnail -->
                                    <div class="solution-thumb">
                                        <a href="<?= get_permalink() ?>">
                                            <?php 
                                                    if (has_post_thumbnail()) {
                                                        echo get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'lozad']);
                                                    } else {
                                                        // Fallback image nếu không có ảnh
                                                        echo '<img src="' . get_template_directory_uri() . '/assets/img/placeholder.jpg" class="lozad" alt="' . get_the_title() . '">';
                                                    }
                                                    ?>
                                        </a>
                                    </div>

                                    <!-- Info -->
                                    <div class="solution-info">
                                        <h3 class="info-name">
                                            <a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
                                        </h3>
                                        <a class="btn-discover" href="<?= get_permalink() ?>">
                                            <i class="fa-regular fa-arrow-right icon"></i>
                                            <div class="content">Khám phá</div>
                                        </a>
                                    </div>

                                </div>
                            </li>
                            <?php endwhile; wp_reset_postdata(); // Quan trọng: Reset lại query về Page chính ?>
                        </ul>

                        <!-- Decoration / Navigation -->
                        <div class="pointer-animate">
                            <img class="lozad"
                                data-src="<?= get_template_directory_uri() ?>/assets/img/HandPointing.svg" alt="" />
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <?php else: ?>
                <p class="text-center">Chưa có giải pháp nào được cập nhật.</p>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php 
        endwhile; // Kết thúc vòng lặp Page
    endif; 
    ?>

</main>

<?= get_footer() ?>