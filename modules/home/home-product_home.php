<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$bottom_title = get_sub_field('bottom_title');
$bottom_content = get_sub_field('bottom_content');
$bottom_button = get_sub_field('bottom_button');
$products = get_sub_field('products');
?>
    <section class="section-product-home section-py lg:pb-30">
        <div class="container"> 
            <div class="product-home flex flex-col gap-base items-center">
                <div class="product-home-header text-center">
                    <h2 class="product-home-title heading-1"><?= $title ?></h2>
                    <div class="subtitle text-body-1 mt-5">
                        <?= $subtitle ?>
                    </div>
                </div>
                <div class="swiper-column-auto block-product-home-slide auto-3-column w-full">
                    <div class="swiper"> 
                        <ul class="swiper-wrapper product-home-list">
                            <?php if($products): ?>
                                <?php foreach($products as $p): ?>
                                    <li class="swiper-slide product-home-item"> 
                                        <div class="product-home-item h-full">
                                            <div class="product-thumb"> <a href="<?= get_permalink($p->ID) ?>"> <img class="lozad" data-src="<?= get_the_post_thumbnail_url($p->ID, 'full') ?>" alt="<?= get_the_title($p->ID) ?>"/></a></div>
                                            <div class="product-info"> 
                                                <h3 class="info-name"><a href="<?= get_permalink($p->ID) ?>"><?= get_the_title($p->ID) ?></a></h3>
                                                <div class="info-desc"> 
                                                    <p><?= get_the_excerpt($p->ID) ?></p>
                                                </div><a class="btn btn-white product-seemore" href="<?= get_permalink($p->ID) ?>">Xem sản phẩm</a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="wrap-button-slide none-static">
                        <button class="btn btn-slide btn-prev"><i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <button class="btn btn-slide btn-next"><i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <div class="block-btn-bottom relative w-full"><a class="btn btn-seemore-default inline-block py-3 w-full rounded-full border border-black text-center transition-all-linear-500 -md:hidden" href="#!">Xem ngay siêu phẩm</a>
                    <div class="block-show md:absolute-y-center flex -md:flex-col items-stretch w-full overflow-hidden">
                        <div class="block-content flex-1 rounded-full -md:bg-white md:bg-black flex-center flex-wrap gap-x-5 md:-translate-x-full md:transition md:duration-[1.3s] md:ease-linear -md:py-3">
                            <div class="title heading-2  text-primary-1"><?= $bottom_title ?></div>
                            <div class="content text-body-1 text-utility-gray-950"><?= $bottom_content ?></div>
                        </div>
                        <?php if($bottom_button): ?>
                            <a class="btn btn-primary btn-seemore-show active md:translate-x-full md:!duration-[1.5s]" href="<?= $bottom_button['url'] ?>" target="<?= $bottom_button['target'] ?>"><?= $bottom_button['title'] ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
