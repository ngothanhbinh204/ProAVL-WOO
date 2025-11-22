<?php
$content = get_field('news_content_main') ?: get_the_content();
?>
<section class="section-news-detail-main-content">
    <div class="container">
        <div class="news-detail-main-content py-10 lg:py-15 px-8 lg:px-12 rounded-4 bg-white">
            <div class="format-content">
                <?= apply_filters('the_content', $content) ?>
            </div>
        </div>
    </div>
</section>