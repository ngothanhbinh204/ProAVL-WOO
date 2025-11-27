<?php 
/* Template name: Page - Contact */ 
get_header(); 

$contact_heading = get_field('contact_heading'); 
$business_info   = get_field('contact_business_info'); 
$form_title      = get_field('contact_form_title');
$form_subtitle   = get_field('contact_form_subtitle');
$form_shortcode  = get_field('contact_form_shortcode');
$social_heading  = get_field('contact_social_heading'); 
$social_items    = get_field('contact_social_items'); 
?>

<?php get_template_part('modules/common/breadcrumb') ?>

<section class="section-contact section-py">
    <div class="container">
        <div class="contact">
            <h1 class="contact heading-1"><?= $contact_heading ? $contact_heading : get_the_title() ?></h1>
            <div class="contact-main mt-3">
                <div class="contact-business-info">
                    <div class="contact-business-info-child flex flex-col h-full p-8 pr-3.5 bg-utility-gray-50">
                        <ul
                            class="business-info-list lg:flex-[1_1_0] lg:overflow-y-auto lg:overflow-scroll-1 lg:pr-3.5">

                            <?php if($business_info): ?>
                            <?php foreach($business_info as $item): 
                                    $item_title = $item['title'];
                                    $address    = $item['address'];
                                    $phone_1    = $item['phone_1'];
                                    $phone_2    = $item['phone_2'];
                                    $map_link   = $item['map_link'];
                                ?>
                            <li class="business-info-item mb-6 last:mb-0">
                                <div class="title heading-4 text-primary-3"><?= $item_title ?></div>
                                <ul class="content-list flex flex-col mt-3 gap-y-1">
                                    <!-- Địa chỉ -->
                                    <?php if($address): ?>
                                    <li class="content-item flex items-baseline gap-x-2.5">
                                        <div class="icon text-base text-primary-3">
                                            <i class="fa-light fa-location-dot"></i>
                                        </div>
                                        <div class="content"><?= $address ?></div>
                                    </li>
                                    <?php endif; ?>

                                    <!-- Số điện thoại 1 -->
                                    <?php if($phone_1): ?>
                                    <li class="content-item flex items-center gap-x-2.5">
                                        <div class="icon text-base text-primary-3">
                                            <i class="fa-light fa-phone"></i>
                                        </div>
                                        <a class="content hover:text-primary-1 transition-colors"
                                            href="tel:<?= $phone_1 ?>"><?= $phone_1 ?></a>
                                    </li>
                                    <?php endif; ?>

                                    <!-- Số điện thoại 2 -->
                                    <?php if($phone_2): ?>
                                    <li class="content-item flex items-center gap-x-2.5">
                                        <div class="icon text-base text-primary-3">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16"
                                                height="16" viewBox="0 0 256 256" xml:space="preserve">
                                                <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                                    transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                                    <path
                                                        d="M 75.546 78.738 H 14.455 C 6.484 78.738 0 72.254 0 64.283 V 25.716 c 0 -7.97 6.485 -14.455 14.455 -14.455 h 61.091 c 7.97 0 14.454 6.485 14.454 14.455 v 38.567 C 90 72.254 83.516 78.738 75.546 78.738 z M 14.455 15.488 c -5.64 0 -10.228 4.588 -10.228 10.228 v 38.567 c 0 5.64 4.588 10.229 10.228 10.229 h 61.091 c 5.64 0 10.228 -4.589 10.228 -10.229 V 25.716 c 0 -5.64 -4.588 -10.228 -10.228 -10.228 H 14.455 z"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;"
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path
                                                        d="M 11.044 25.917 C 21.848 36.445 32.652 46.972 43.456 57.5 c 2.014 1.962 5.105 -1.122 3.088 -3.088 C 35.74 43.885 24.936 33.357 14.132 22.83 C 12.118 20.867 9.027 23.952 11.044 25.917 L 11.044 25.917 z"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;"
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path
                                                        d="M 46.544 57.5 c 10.804 -10.527 21.608 -21.055 32.412 -31.582 c 2.016 -1.965 -1.073 -5.051 -3.088 -3.088 C 65.064 33.357 54.26 43.885 43.456 54.412 C 41.44 56.377 44.529 59.463 46.544 57.5 L 46.544 57.5 z"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;"
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path
                                                        d="M 78.837 64.952 c -7.189 -6.818 -14.379 -13.635 -21.568 -20.453 c -2.039 -1.933 -5.132 1.149 -3.088 3.088 c 7.189 6.818 14.379 13.635 21.568 20.453 C 77.788 69.973 80.881 66.89 78.837 64.952 L 78.837 64.952 z"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;"
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                    <path
                                                        d="M 14.446 68.039 c 7.189 -6.818 14.379 -13.635 21.568 -20.453 c 2.043 -1.938 -1.048 -5.022 -3.088 -3.088 c -7.189 6.818 -14.379 13.635 -21.568 20.453 C 9.315 66.889 12.406 69.974 14.446 68.039 L 14.446 68.039 z"
                                                        style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(29,29,27); fill-rule: nonzero; opacity: 1;"
                                                        transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                                </g>
                                            </svg>

                                        </div>
                                        <a class="content hover:text-primary-1 transition-colors"
                                            href="tel:<?= $phone_2 ?>"><?= $phone_2 ?></a>
                                    </li>
                                    <?php endif; ?>
                                </ul>

                                <!-- Link bản đồ -->
                                <?php if($map_link): 
                                        $link_url = is_array($map_link) ? $map_link['url'] : $map_link;
                                        $link_target = is_array($map_link) && isset($map_link['target']) ? $map_link['target'] : '_self';
                                    ?>
                                <div
                                    class="block-map inline-flex items-center gap-x-2 text-primary-1 mt-3 hover:text-primary-3 transition-colors">
                                    <a href="<?= $link_url ?>" target="<?= $link_target ?>"
                                        class="map-content text-body-5 uppercase font-bold">XEM BẢN ĐỒ</a>
                                    <div class="icon text-base"><i class="fa-light fa-map"></i></div>
                                </div>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>

                <!-- Cột phải: Form liên hệ -->
                <div class="block-contact-form">
                    <div class="block-form">
                        <?php if($form_title): ?>
                        <h3 class="form-title heading-2-regular uppercase text-primary-1"><?= $form_title ?></h3>
                        <?php endif; ?>

                        <?php if($form_subtitle): ?>
                        <div class="subtitle mt-3 text-body-1 text-[rgba(39,37,31,1)]"><?= $form_subtitle ?></div>
                        <?php endif; ?>

                        <?php if($form_shortcode): ?>
                        <div class="mt-5 contact-form-wrapper">
                            <?= do_shortcode($form_shortcode) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php if($social_items): ?>
<section class="section-social section-py">
    <div class="container">
        <div class="social">
            <!-- Heading Social -->
            <h2 class="social-title heading-1"><?= $social_heading ?></h2>

            <div class="swiper-social swiper mt-8">
                <ul class="swiper-wrapper social-list">
                    <?php foreach($social_items as $item): 
                        $icon    = $item['icon']; // Image ID hoặc URL
                        $name    = $item['name'];
                        $link    = $item['link']; // Link Object
                        $qr_code = $item['qr_code']; // Image ID
                    ?>
                    <li class="swiper-slide social-item">
                        <div class="flex-between-center gap-2 p-5 lg:p-8 rounded-2 shadow-shadow-4 bg-white h-full">
                            <div class="meta-data flex flex-col gap-y-3">
                                <div class="icon-brand w-10 h-10">
                                    <!-- Hàm hiển thị ảnh custom của bạn -->
                                    <?= function_exists('get_image_attrachment') ? get_image_attrachment($icon) : wp_get_attachment_image($icon, 'thumbnail') ?>
                                </div>
                                <h4 class="name-brand text-body-1 break-all font-bold">
                                    <?php if($link): ?>
                                    <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"
                                        class="hover:text-primary-1 transition-colors">
                                        <?= $name ?>
                                    </a>
                                    <?php else: ?>
                                    <?= $name ?>
                                    <?php endif; ?>
                                </h4>
                            </div>

                            <?php if($qr_code): ?>
                            <div class="qa-code shrink-0 w-17 xl:w-20 h-17 xl:h-20">
                                <?= function_exists('get_image_attrachment') ? get_image_attrachment($qr_code) : wp_get_attachment_image($qr_code, 'thumbnail') ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?= get_footer() ?>