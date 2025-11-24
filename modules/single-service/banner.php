<?php
$image = get_field('service_banner_image');
?>
<section class="section-banner-secondary">
    <div class="banner-secondary">
        <div class="banner-img img-ratio ratio:pt-[960_1920]">
            <?php if ($image) : ?>
            <?= get_image_attrachment($image, 'image') ?>
            <?php endif; ?>
        </div>
    </div>
</section>