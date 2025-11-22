<?php
$title = get_field('training_title'); // Or post title
$description = get_field('training_desc');
$images = get_field('training_images');
$button_text = get_field('training_btn_text');
$button_link = get_field('training_btn_link');
?>
<section class="section-bg gradient-3">
    <?php get_template_part('modules/common/breadcrumb')?>
    <section class="section-training-course section-py !pb-0 ">
        <div class="container h-full">
            <div class="training-course h-full">
                <div class="block-content flex flex-col items-start gap-y-5">
                    <h2 class="training-course-title heading-1 text-white"><?= $title ?: get_the_title() ?></h2>
                    <div class="desc text-body-1 text-white">
                        <?= $description ?>
                    </div>
                    <?php if ($button_text && $button_link) : ?>
                    <a class="btn btn-white" href="<?= $button_link ?>"><?= $button_text ?></a>
                    <?php endif; ?>
                </div>
                <?php if ($images) : ?>
                <div class="block-slide grid grid-cols-2 gap-x-5 ">
                    <div class="embla-slide-1 w-full">
                        <div class="embla__viewport">
                            <div class="embla__container">
                                <?php foreach ($images as $img) : ?>
                                <div class="embla__slide">
                                    <div class="img img-ratio ratio:pt-[477_360]">
                                        <img class="lozad" data-src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" />
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="embla-slide-2 w-full">
                        <div class="embla__viewport">
                            <div class="embla__container">
                                <?php foreach ($images as $img) : ?>
                                <div class="embla__slide">
                                    <div class="img img-ratio ratio:pt-[477_360]">
                                        <img class="lozad" data-src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>" />
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</section>