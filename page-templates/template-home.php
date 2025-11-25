<?php /*
Template name: Page - Home
*/ ?>
<?= get_header() ?>
<h1 class="hidden">
    <?php echo get_bloginfo('name') ?>
</h1>

<?php
if (have_rows('home_sections')) :
	while (have_rows('home_sections')) : the_row();
		get_template_part('modules/home/home-' . get_row_layout());
	endwhile;
endif;
?>
<?= get_footer() ?>