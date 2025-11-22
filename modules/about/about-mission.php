<?php
$background_image = get_sub_field('background_image');
$title = get_sub_field('title');
$description = get_sub_field('description');
$bg_url = '';
if ($background_image) {
    $bg_url = wp_get_attachment_image_url($background_image['ID'], 'full');
}
?>
<section class="section-mission" setBackground="<?= $bg_url ?>">
    <div class="container"> 
        <div class="mission flex flex-col justify-center">
            <h2 class="mission-title heading-1 text-white"><?= $title ?></h2>
            <div class="mission-desc heading-6 mt-5 -lg:text-32 text-white">
                <?= $description ?>
            </div>
        </div>
    </div>
</section>
