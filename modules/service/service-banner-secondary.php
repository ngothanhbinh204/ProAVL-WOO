<?php
$image = get_sub_field('image');
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
<?php if(function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>