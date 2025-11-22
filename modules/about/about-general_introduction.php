<?php
$title = get_sub_field('title');
$content = get_sub_field('content');
$gallery = get_sub_field('gallery');
?>
<section class="section-general-introduction section-py lg:pt-15"> 
    <div class="container"> 
        <div class="general-introduction">
            <div class="general-introduction-header">
                <h2 class="header-introduction-title heading-1 text-center"><?= $title ?></h2>
                <div class="header-introduction-content mt-5 text-body-1 text-center flex flex-col gap-y-6">
                    <?= $content ?>
                </div>
            </div>
            <?php if($gallery): ?>
                <div class="general-introduction-gallery grid grid-cols-2 md:grid-cols-12 gap-base mt-base">
                    <?php foreach($gallery as $index => $item): ?>
                        <?php 
                            $image = $item['image'];
                            // Determine class based on index to match HTML structure
                            // 1st: col-span-3, 2nd: col-span-6, 3rd: col-span-3
                            $class = 'col-span-3';
                            $ratio = 'ratio:pt-[400_320]';
                            if ($index == 1) {
                                $class = 'col-span-6';
                                $ratio = 'ratio:pt-[400_680]';
                            }
                        ?>
                        <div class="gallery-img img-ratio <?= $ratio ?> overflow-hidden rounded-4 <?= $class ?>">
                            <?= get_image_attrachment($image) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
