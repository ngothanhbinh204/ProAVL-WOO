<?php
$title = get_field('related_solutions_title');
$related_solutions = get_field('related_solutions_list');
if (!$related_solutions) {
    $related_solutions = get_posts([
        'post_type' => 'solution',
        'posts_per_page' => 6,
        'post__not_in' => [get_the_ID()],
    ]);
}
?>
<section class="section-typical-projects section-py lg:py-30 bg-utility-gray-50">
    <div class="container"> 
        <?php if ($title) : ?>
            <h2 class="typical-projects-title heading-1 text-center"><?= $title ?></h2>
        <?php endif; ?>
        <div class="swiper-column-auto auto-4-column block-typical-projects-slide relative mt-base"> 
            <div class="swiper"> 
                <ul class="swiper-wrapper typical-projects-list">
                    <?php if ($related_solutions) : foreach ($related_solutions as $p) : 
                        $p_id = is_object($p) ? $p->ID : $p;
                        ?>
                        <li class="swiper-slide typical-projects-item">
                            <div class="solution-item h-full">
                                <div class="solution-thumb"> 
                                    <a href="<?= get_permalink($p_id) ?>">
                                        <?= get_the_post_thumbnail($p_id, 'full', ['class' => 'lozad']) ?>
                                    </a>
                                </div>
                                <div class="solution-info"> 
                                    <h3 class="info-name"> <a href="<?= get_permalink($p_id) ?>"><?= get_the_title($p_id) ?></a></h3>
                                    <a class="btn-discover" href="<?= get_permalink($p_id) ?>">
                                            <i class="fa-regular fa-arrow-right icon"></i>
                                        <div class="content">Khám phá</div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; endif; ?>
                </ul>
            </div>
            <div class="wrap-button-slide static-mobile">
                <button class="btn btn-slide btn-prev"><i class="fa-solid fa-arrow-left"></i>
                </button>
                <button class="btn btn-slide btn-next"><i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>