<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
// Query solutions
$solutions = new WP_Query([
    'post_type' => 'solution',
    'posts_per_page' => -1,
]);
?>
<section class="section-solution section-py lg:pt-15">
    <div class="container"> 
        <div class="solution flex flex-col gap-base items-center">
            <div class="solution-header text-center">
                <?php if ($title) : ?>
                    <h2 class="solution-title heading-1"><?= $title ?></h2>
                <?php endif; ?>
                <?php if ($description) : ?>
                    <div class="subtitle text-body-1 mt-5">
                        <?= $description ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($solutions->have_posts()) : ?>
                <div class="swiper-column-auto block-solution-list auto-4-column w-full">
                    <div class="swiper"> 
                        <ul class="swiper-wrapper solution-list"> 
                            <?php while ($solutions->have_posts()) : $solutions->the_post(); ?>
                                <li class="swiper-slide"> 
                                    <div class="solution-item">
                                        <div class="solution-thumb"> 
                                            <a href="<?= get_permalink() ?>">
                                                <?= get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'lozad']) ?>
                                            </a>
                                        </div>
                                        <div class="solution-info"> 
                                            <h3 class="info-name"> <a href="<?= get_permalink() ?>"><?= get_the_title() ?></a></h3>
                                            <a class="btn-discover" href="<?= get_permalink() ?>">
                                                    <i class="fa-regular fa-arrow-right icon"></i>
                                                <div class="content">Khám phá</div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                        <div class="pointer-animate"> <img class="lozad" data-src="<?= get_template_directory_uri() ?>/assets/img/HandPointing.svg" alt=""/>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>