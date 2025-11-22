<?php
$title = get_field('specs_title');
$specs = get_field('specs_list'); // Repeater: title, items (repeater: text)
?>
<section class="section-tech-specs section-py !pb-0">
    <div class="container">
        <div class="tech-specs">
            <?php if ($title) : ?>
            <h2 class="tech-specs-title heading-1 text-center"><?= $title ?></h2>
            <?php endif; ?>
            <?php if ($specs) : ?>
            <ul class="tech-specs-list grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-5 mt-base">
                <?php foreach ($specs as $spec) : ?>
                <li class="tech-specs-item">
                    <div class="child pb-6">
                        <h3 class="title heading-5"><?= $spec['title'] ?></h3>
                        <?php if ($spec['items']) : ?>
                        <ul class="content-list flex flex-col gap-y-3 text-body-1 mt-5">
                            <?php foreach ($spec['items'] as $item) : ?>
                            <li class="content-item"><?= $item['text'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</section>