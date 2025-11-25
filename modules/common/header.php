<header class="header">
    <div class="container">
        <div class="header-child flex-between-center relative">
            <?php 
            $home_url = esc_url( home_url( '/' ) );
            $logo_html = get_lazy_loaded_custom_logo(); 

            if ( $logo_html ) :
            ?>
            <div class="header-logo">
                <a href="<?= $home_url ?>">
                    <?= $logo_html ?>
                </a>
            </div>
            <?php else : ?>
            <div class="header-logo">
                <a href="<?= $home_url ?>">
                    <img class="lozad max-h-10" data-src="<?php echo get_template_directory_uri(); ?>/img/logo.svg"
                        alt="<?php bloginfo( 'name' ); ?>" />
                </a>
            </div>
            <?php endif; ?>
            <div class="header-main flex items-center gap-x-9">
                <nav class="header-menu">
                    <?php 
                    if (function_exists('canhcam_header_menu')) {
                        canhcam_header_menu('header-menu');
                    } else {
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container' => false,
                            'menu_class' => '',
                        ));
                    }
                    ?>
                </nav>
                <div class="header-action flex items-center gap-x-6 lg:gap-x-9">
                    <div class="header-language">
                        <!-- <?= do_shortcode('[language]') ?> -->
                        <?php echo do_shortcode('[custom_wpml_switcher]'); ?>

                    </div>
                    <div class="header-search text-2xl text-primary-2 cursor-pointer"><i
                            class="fa-light fa-magnifying-glass"></i></div>
                    <div class="header-hamburger"><span></span><span></span><span></span>
                        <div id="pulseMe">
                            <div class="bar left"></div>
                            <div class="bar top"></div>
                            <div class="bar right"></div>
                            <div class="bar bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>