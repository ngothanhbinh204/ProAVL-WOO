<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
// Query services
$services = new WP_Query([
    'post_type' => 'service',
    'posts_per_page' => -1,
]);
?>
<section class="section-service section-py lg:pt-15">
    <div class="container"> 
        <div class="service flex flex-col gap-base items-center">
            <div class="service-header text-center">
                <?php if ($title) : ?>
                    <h2 class="service-title heading-1"><?= $title ?></h2>
                <?php endif; ?>
                <?php if ($description) : ?>
                    <div class="service-subtitle text-body-1 mt-5">
                        <?= $description ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($services->have_posts()) : ?>
                <ul class="service-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-base">
                    <?php while ($services->have_posts()) : $services->the_post(); 
                        $icon = get_field('icon'); 
                        $desc = get_the_excerpt();
                    ?>
                        <li class="service-item">
                            <?php if ($icon) : ?>
                                <div class="icon"><img class="lozad" data-src="<?= $icon['url'] ?>" alt="<?= $icon['alt'] ?>"/></div>
                            <?php else: ?>
                                <div class="block-thumb"> 
                                    <div class="thumb"> 
                                        <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'lozad']) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="service-info"> 
                                <h3 class="info-name"><?= get_the_title() ?></h3>
                                <div class="info-desc">
                                    <p><?= $desc ?></p>
                                </div>
                                <a class="btn btn-primary btn-detail" href="<?= get_permalink() ?>">Xem chi tiết</a>
                            </div>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            <?php endif; ?>
            <a class="btn btn-primary" href="#!">Xem tất cả dự án</a>
        </div>
    </div>
</section>