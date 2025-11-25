<?php /* Template name: Page - Service */ ?>
<?= get_header() ?>
<div class="section-bg gradient-1">
    <?php get_template_part('modules/common/banner') ?>
    <?php get_template_part('modules/common/breadcrumb'); ?>
    <?php
$title = get_field('title_service');
$description = get_field('description_service');
$service_items = get_field('items'); 
if (get_field('button_view_all')) {
    $button_view_all = get_field('button_view_all');
} else {
    $button_view_all = [
        'title' => 'Xem tất cả dịch vụ',
        'url'   => '#'
    ];
}?>
    <section class="section-service section-py lg:pt-15">
        <div class="container">
            <div class="service flex flex-col gap-base items-center">
                <div class="service-header text-center">
                    <?php if ($title) : ?>
                    <h1 class="service-title heading-1"><?= $title ?></h1>
                    <?php endif; ?>
                    <?php if ($description) : ?>
                    <div class="service-subtitle text-body-1 mt-5">
                        <?= $description ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (have_rows('items')) : ?>
                <ul class="service-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-base">
                    <?php while (have_rows('items')) : the_row(); 
                    // Lấy các trường con trong Repeater
                    $name = get_sub_field('name'); 
                    $type = get_sub_field('type');
                    $desc = get_sub_field('description');
                    $link = get_sub_field('link');
                    $icon_img = get_sub_field('icon'); // Icon là hình ảnh
                    $image_img = get_sub_field('image'); // Image là hình ảnh chính
                    
                ?>
                    <?php if($type === 'icon'): ?>
                    <li class="service-item">
                        <div class="icon">
                            <?= get_image_attrachment($icon_img, 'image') ?>
                        </div>
                        <div class="service-info">
                            <h3 class="info-name"><?= $name ?></h3>
                            <div class="info-desc">
                                <p><?= $desc ?></p>
                            </div><a class="btn btn-primary btn-detail"
                                href="<?php echo esc_url($link['url']) ?>"><?php echo esc_html($link['title']) ?></a>
                        </div>
                    </li>
                    <?php else: ?>
                    <li class="service-item">
                        <div class="block-thumb">
                            <div class="thumb">
                                <?= get_image_attrachment($image_img, 'image') ?>
                            </div>
                        </div>
                        <div class="service-info">
                            <h3 class="info-name"><?= $name ?></h3>
                            <div class="info-desc">
                                <p><?= $desc ?></p>
                            </div><a class="btn btn-white btn-detail"
                                href="<?php echo esc_url($link['url']) ?>"><?php echo esc_html($link['title']) ?></a>
                        </div>
                    </li>
                    <?php endif; ?>


                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>

                <a class="btn btn-primary"
                    href="<?= esc_url($button_view_all['url']) ?>"><?= esc_html($button_view_all['title']) ?></a>

            </div>
        </div>
    </section>
</div>
<?= get_footer() ?>