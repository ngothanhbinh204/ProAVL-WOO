<footer class="footer bg-primary-3">
    <div class="footer-top pt-15">
        <div class="container">
            <div class="footer-child flex-between -xl:flex-col">
                <?php 
                $footer_logo = get_field('footer_logo', 'option');
                $home_url = esc_url( home_url( '/' ) );
                
                if ( $footer_logo ) :
                ?>
                <div class="footer-logo">
                    <a href="<?= $home_url ?>">
                        <img class="lozad" data-src="<?= $footer_logo['url'] ?>" alt="<?= $footer_logo['alt'] ?>" />
                    </a>
                </div>
                <?php else : ?>
                <div class="footer-logo">
                    <a href="<?= home_url() ?>">
                        <img class="lozad" data-src="<?= get_template_directory_uri() ?>/img/logo-footer.svg" alt="" />
                    </a>
                </div>
                <?php endif; ?>

                <div class="footer-block-content">
                    <ul class="content-list grid grid-cols-1 lg:grid-cols-3 gap-base lg:gap-x-4 lg:gap-y-10">
                        <?php 
                        if ( have_rows('footer_blocks', 'option') ) :
                            while ( have_rows('footer_blocks', 'option') ) : the_row();
                                $type = get_sub_field('type');
                                
                                if ( $type == 'list' ) :
                                    $title = get_sub_field('title');
                        ?>
                        <li class="content-item">
                            <h3 class="title heading-2 text-white uppercase"><?= $title ?></h3>
                            <?php if ( have_rows('items') ) : ?>
                            <ul class="mega-content-list mt-4 text-body-1 text-utility-gray-300">
                                <?php while ( have_rows('items') ) : the_row(); ?>
                                <li class="mega-content-item"><?= get_sub_field('content') ?></li>
                                <?php endwhile; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php 
                                elseif ( $type == 'actions' ) : 
                                    $phone = get_sub_field('phone');
                                    $email = get_sub_field('email');
                        ?>
                        <li class="content-item col-action flex flex-col items-start gap-y-3">
                            <?php if ($phone) : ?>
                            <a class="btn btn-primary items-center !text-body-1 !py-2.5 !px-5 bg-primary-2 bg-opacity-10 !text-white"
                                href="tel:<?= preg_replace('/[^0-9]/', '', $phone) ?>">
                                <i class="fa-regular fa-phone text-lg"></i> : <?= $phone ?>
                            </a>
                            <?php endif; ?>
                            <?php if ($email) : ?>
                            <a class="btn btn-primary items-center !text-body-1 !py-2.5 !px-5 bg-primary-2 bg-opacity-10 !text-white"
                                href="mailto:<?= $email ?>">
                                <i class="fa-regular fa-envelope text-lg"></i> : <?= $email ?>
                            </a>
                            <?php endif; ?>
                        </li>
                        <?php 
                                endif;
                            endwhile;
                        endif; 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom mt-7 border-t border-white border-opacity-30">
        <div class="container">
            <div class="footer-child -md:grid -md:grid-cols-2 -md:gap-base md:flex-y-center py-6.5 -lg:justify-between">
                <?php 
                $bct_image = get_field('footer_bct', 'option');
                if ($bct_image) :
                ?>
                <div class="dadangky-img">
                    <img class="lozad" data-src="<?= $bct_image['url'] ?>" alt="<?= $bct_image['alt'] ?>" />
                </div>
                <?php else: ?>
                <div class="dadangky-img">
                    <img class="lozad" data-src="<?= get_template_directory_uri() ?>/img/dadangky.svg" alt="" />
                </div>
                <?php endif; ?>

                <?php if ( have_rows('footer_socials', 'option') ) : ?>
                <ul class="social-list">
                    <?php while ( have_rows('footer_socials', 'option') ) : the_row(); ?>
                    <li class="social-item">
                        <a href="<?= get_sub_field('link') ?>" target="_blank">
                            <i class="<?= get_sub_field('icon_class') ?>"></i>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>

                <div class="copyright text-white text-body-4 lg:ml-auto -md:col-span-full -md:text-center">
                    <?= get_field('footer_copyright', 'option') ?: '© 2025 ProAVL. All Rights Reserved. Thiết kế web bởi Cánh Cam.' ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<ul class="tool-list">
    <li class="tool-item">
        <button class="button-to-top"><i class="fa-regular fa-arrow-up"></i> </button>
    </li>
</ul>
<div class="menu-mobile">
    <?php 
    $footer_logo = get_field('footer_logo', 'option');
    if ( $footer_logo ) :
    ?>
    <div class="block-logo">
        <a href="<?= home_url() ?>">
            <img class="lozad" data-src="<?= $footer_logo['url'] ?>" alt="<?= $footer_logo['alt'] ?>" />
        </a>
    </div>
    <?php else : ?>
    <div class="block-logo">
        <a href="<?= home_url() ?>">
            <img class="lozad" data-src="<?= get_template_directory_uri() ?>/img/logo.svg" alt="" />
        </a>
    </div>
    <?php endif; ?>

    <?php 
    if ( function_exists('canhcam_mobile_menu') ) {
        canhcam_mobile_menu('header-menu');
    }
    ?>
</div>
<div class="header-search-form">
    <div
        class="close flex items-center justify-center absolute top-0 right-0 bg-white text-3xl cursor-pointer w-12.5 h-12.5">
        <i class="fa-light fa-xmark"></i>
    </div>
    <div class="container">
        <div class="wrap-form-search-product">
            <div class="productsearchbox">
                <form class="form-search search-custom" role="search" method="get"
                    action="<?php echo home_url('/'); ?>">
                    <input type="search" name="s" class="searchinput"
                        placeholder="<?php esc_attr_e('Tìm kiếm...', 'canhcamtheme') ?>" autocomplete="off" />

                    <button type="submit" class="searchbutton">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal"></div>