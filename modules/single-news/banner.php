<?php
$image = get_field('news_banner_image');
?>
<section class="section-banner-secondary">
    <div class="banner-secondary">
        <div class="banner-img img-ratio ratio:pt-[960_1920]">
            <?php if ($image) : ?>
                <img class="lozad" data-src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>"/>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="section-bg bg-utility-gray-50">
    <div class="space-header pt-[var(--header-height)]"></div>
    <section class="global-breadcrumb">
        <div class="container">
            <?php if(function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </section>