<?php
$title = get_field('popup_form_title', 'option');
$form_shortcode = get_field('popup_form_shortcode', 'option');
?>
<div id="popupForm">
    <div class="wrap-popupForm">
        <button class="btn-close">
            <i class="fa-solid fa-xmark"></i></button>
        <?php if ($title) : ?>
        <h2 class="popupForm-title heading-1 text-center"><?= $title ?></h2>
        <?php endif; ?>
        <?php if ($form_shortcode) : ?>
        <div class="popupForm-form">
            <?= do_shortcode($form_shortcode) ?>
        </div>

        <?php endif; ?>
    </div>
</div>