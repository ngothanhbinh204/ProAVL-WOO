<?php
$values = get_field('values_single_product', 'option');
?>
<section class="section-core-values">
    <div class="container">
        <div class="core-values">
            <?php if ($values) : ?>
            <ul class="core-values-list grid -md:grid-rows-2 grid-cols-4 md:grid-cols-3 gap-base md:gap-24">
                <?php foreach ($values as $val) : ?>
                <li class="core-values-item">
                    <div class="icon w-30 h-30 mx-auto">
                        <img class="lozad max-w-full object-contain" data-src="<?= $val['icon']['url'] ?>"
                            alt="<?= $val['icon']['alt'] ?>" />
                    </div>
                    <div class="content text-body-1 text-center mt-8">
                        <p><?= $val['content'] ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</section>