<?php
$title = get_sub_field('title');
$values = get_sub_field('values');
?>
<section class="section-core-values section-py">
    <div class="container"> 
        <div class="core-values">
            <h2 class="core-values-title heading-1 text-center"><?= $title ?></h2>
            <ul class="core-values-list grid -md:grid-rows-2 grid-cols-4 md:grid-cols-3 gap-base md:gap-24 mt-base">
                <?php if($values): ?>
                    <?php foreach($values as $item): ?>
                        <?php 
                            $icon = $item['icon'];
                            $content = $item['content'];
                        ?>
                        <li class="core-values-item"> 
                            <div class="icon w-30 h-30 mx-auto">
                                <?= get_image_attrachment($icon) ?>
                            </div>
                            <div class="content text-body-1 text-center mt-8">
                                <?= $content ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</section>
