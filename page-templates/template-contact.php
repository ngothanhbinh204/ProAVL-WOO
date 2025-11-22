<?php /*
Template name: Page - Contact
*/ ?>
<?= get_header() ?>
<?php get_template_part('modules/common/breadcrumb')?>
<?php
if (have_rows('contact_sections')) :
	while (have_rows('contact_sections')) : the_row();
		get_template_part('modules/contact/contact-' . get_row_layout());
	endwhile;
endif;
?>
<?= get_footer() ?>
