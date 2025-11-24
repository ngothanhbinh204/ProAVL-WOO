<?php
$title = get_sub_field('title');
$tabs = get_sub_field('tabs');
$news = get_sub_field('news');
?>
<section class="section-news-events section-py">
    <div class="container">
        <div class="news-events">
            <div class="news-events-header flex-between-center flex-wrap gap-5">
                <h2 class="news-events-title heading-1"><?= $title ?></h2>
                <ul class="events-header-tab-list">
                    <?php if($tabs): ?>
                    <?php foreach($tabs as $index => $item): ?>
                    <li class="events-header-tab-item <?= $index == 0 ? 'active' : '' ?>">
                        <a href="<?= $item['link']['url'] ?>"
                            target="<?= $item['link']['target'] ?>"><?= $item['text'] ?></a>
                    </li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="news-list-grid mt-base">
                <?php if($news): 
                        $first_news = $news[0];
                        $side_news = array_slice($news, 1);
                    ?>
                <div class="block-news-first">
                    <div class="news-item-big zoom-img-parent">
                        <div class="block-thumb">
                            <div class="thumb img-zoom">
                                <?= get_image_post($first_news->ID, 'image') ?>
                            </div>
                        </div>
                        <div class="news-info">
                            <h3 class="info-name"><?= get_the_title($first_news->ID) ?></h3>
                            <div class="info-desc">
                                <p><?= get_the_excerpt($first_news->ID) ?></p>
                            </div><a class="btn btn-white btn-seemore" href="<?= get_permalink($first_news->ID) ?>">Xem
                                chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="side-news">
                    <?php foreach($side_news as $item): ?>
                    <div class="news-item zoom-img-parent h-full">
                        <div class="block-thumb">
                            <div class="thumb img-zoom">
                                <?= get_image_post($item->ID, 'image') ?>
                            </div>
                        </div>
                        <div class="news-info">
                            <h3 class="info-name"><?= get_the_title($item->ID) ?></h3><a
                                class="btn btn-white btn-seemore" href="<?= get_permalink($item->ID) ?>">Xem chi
                                tiết</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<div class="container absolute-center h-full pointer-events-none">
    <div class="border-x border-utility-gray-200 w-full h-full box-content -ml-0.25"></div>
</div>
</section>