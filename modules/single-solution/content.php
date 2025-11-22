<?php
$title = get_field('solution_custom_title'); // Or post title
$description = get_field('solution_description');
$content_blocks = get_field('solution_content_blocks'); // Repeater: image, title, content
?>
<section class="section-solution-detail section-py lg:pt-15 lg:pb-30">
    <div class="solution-detail">
        <div class="solution-detail-header text-center">
            <h2 class="header-title heading-1"><?= $title ?: get_the_title() ?></h2>
            <?php if ($description) : ?>
                <div class="header-subtitle text-body-1 mt-5">
                    <?= $description ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($content_blocks) : ?>
            <ul class="solution-detail-content-list mt-base">
                <?php foreach ($content_blocks as $block) : ?>
                    <li class="solution-detail-content-item grid grid-cols-1 -xl:gap-y-4 xl:grid-cols-2 items-center">
                        <div class="block-media"> 
                            <div class="media-img zoom-img img-ratio ratio:pt-[640_960]">
                                <img class="lozad" data-src="<?= $block['image']['url'] ?>" alt="<?= $block['image']['alt'] ?>"/>
                            </div>
                        </div>
                        <div class="block-content">
                            <h3 class="title heading-2-regular uppercase"><?= $block['title'] ?></h3>
                            <div class="main-content text-body-1 flex flex-col gap-y-6 mt-5">
                                <?= $block['content'] ?>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>