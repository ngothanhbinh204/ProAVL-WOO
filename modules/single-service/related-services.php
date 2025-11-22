<?php
$title = get_field('related_services_title');
$related_services = get_field('related_services_list');
if (!$related_services) {
    $related_services = get_posts([
        'post_type' => 'service',
        'posts_per_page' => 5,
        'post__not_in' => [get_the_ID()],
    ]);
}
?>
<section class="section-other-services section-py bg-utility-gray-50">
    <div class="container"> 
        <div class="other-services">
            <?php if ($title) : ?>
                <h2 class="other-services-title heading-1 text-center"><?= $title ?></h2>
            <?php endif; ?>
            <div class="swiper-column-auto block-other-services-slide auto-3-column mt-base">
                <div class="swiper"> 
                    <ul class="swiper-wrapper other-services-list">
                        <?php if ($related_services) : foreach ($related_services as $p) : 
                            $p_id = is_object($p) ? $p->ID : $p;
                            ?>
                            <li class="swiper-slide other-services-item">
                                <div class="other-services-item h-full zoom-img-parent">
                                    <div class="block-thumb"> 
                                        <a class="img-ratio ratio:pt-[248_440] rounded-t-4 img-zoom" href="<?= get_permalink($p_id) ?>">
                                            <?= get_the_post_thumbnail($p_id, 'full', ['class' => 'lozad']) ?>
                                        </a>
                                    </div>
                                    <div class="block-info"> 
                                        <h3 class="info-name"><a href="<?= get_permalink($p_id) ?>"><?= get_the_title($p_id) ?></a></h3>
                                        <div class="type-service">Ánh sáng</div>
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
    </div>
</section>