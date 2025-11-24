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
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.5 6C15.3125 6 16 6.6875 16 7.5V14.5C16 15.3438 15.3125 16 14.5 16H5.5C5.09375 16 4.75 15.875 4.5 15.625C4.21875 15.875 3.875 16 3.5 16H1.5C0.65625 16 0 15.3438 0 14.5V5.5C0 4.6875 0.65625 4 1.5 4H3.5C3.65625 4 3.8125 4.0625 4 4.09375V2C4 0.90625 4.875 0 6 0H12.7812C13.0312 0 13.2812 0.125 13.5 0.3125L14.6875 1.5C14.875 1.6875 15 1.96875 15 2.21875V4.5C15 4.78125 14.75 5 14.5 5C14.2188 5 14 4.78125 14 4.5V2.21875L12.7812 1H6C5.4375 1 5 1.46875 5 2V6.09375C5.15625 6.0625 5.3125 6 5.5 6H14.5ZM4 14.5V5.5C4 5.25 3.75 5 3.5 5H1.5C1.21875 5 1 5.25 1 5.5V14.5C1 14.7812 1.21875 15 1.5 15H3.5C3.75 15 4 14.7812 4 14.5ZM15 14.5V7.5C15 7.25 14.75 7 14.5 7H5.5C5.21875 7 5 7.25 5 7.5V14.5C5 14.7812 5.21875 15 5.5 15H14.5C14.75 15 15 14.7812 15 14.5ZM8.5 8.75C8.90625 8.75 9.25 9.09375 9.25 9.5C9.25 9.9375 8.90625 10.25 8.5 10.25C8.0625 10.25 7.75 9.9375 7.75 9.5C7.75 9.09375 8.0625 8.75 8.5 8.75ZM8.5 11.75C8.90625 11.75 9.25 12.0938 9.25 12.5C9.25 12.9375 8.90625 13.25 8.5 13.25C8.0625 13.25 7.75 12.9375 7.75 12.5C7.75 12.0938 8.0625 11.75 8.5 11.75ZM11.5 8.75C11.9062 8.75 12.25 9.09375 12.25 9.5C12.25 9.9375 11.9062 10.25 11.5 10.25C11.0625 10.25 10.75 9.9375 10.75 9.5C10.75 9.09375 11.0625 8.75 11.5 8.75ZM11.5 11.75C11.9062 11.75 12.25 12.0938 12.25 12.5C12.25 12.9375 11.9062 13.25 11.5 13.25C11.0625 13.25 10.75 12.9375 10.75 12.5C10.75 12.0938 11.0625 11.75 11.5 11.75Z"
                                                    fill="black" />
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