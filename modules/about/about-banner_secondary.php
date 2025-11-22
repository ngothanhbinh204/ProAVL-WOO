<?php
$image = get_sub_field('image');
?>
<section class="section-banner-secondary"> 
    <div class="banner-secondary"> 
        <div class="banner-img img-ratio ratio:pt-[960_1920]">
            <?= get_image_attrachment($image) ?>
        </div>
    </div>
</section>
<div class="space-header pt-[var(--header-height)]"></div>
