<?php /*
Template name: Page - About
*/ ?>
<?= get_header() ?>
<?php get_template_part('modules/common/banner') ?>
<?php get_template_part('modules/common/breadcrumb')?>
<?php
if (have_rows('about_sections')) :
	while (have_rows('about_sections')) : the_row();
		get_template_part('modules/about/about-' . get_row_layout());
	endwhile;
endif;
?>
<?= get_footer() ?>