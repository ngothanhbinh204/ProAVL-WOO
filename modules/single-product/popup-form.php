<?php
$title = get_field('popup_form_title');
$form_shortcode = get_field('popup_form_shortcode');
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
        <?php else: ?>
        <form class="popupForm-form" action="#!">
            <div class="main-inp">
                <div class="block-inp">
                    <input class="inp" type="text" placeholder="Họ tên" />
                </div>
                <div class="block-inp">
                    <input class="inp" type="text" placeholder="Số điện thoại" />
                </div>
                <div class="block-inp">
                    <input class="inp" type="text" placeholder="Email" />
                </div>
                <div class="block-inp">
                    <textarea class="textarea" type="text" placeholder="Lời nhắn"></textarea>
                </div>
            </div>
            <div class="flex-x-center mt-8"> <a class="btn btn-primary btn-submitForm" href="#!">Gửi</a>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>