<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$button = get_sub_field('button');
?>
<section class="section-shared-development section-py">
    <div class="container"> 
        <div class="shared-development text-center">
            <h2 class="shared-development-title heading-1 -lg:text-28"><?= $title ?></h2>
            <div class="shared-development-desc mt-6 text-body-1">
                <?= $description ?>
            </div>
            <?php if($button): ?>
                <a class="btn btn-primary mt-6" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>"><?= $button['title'] ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
