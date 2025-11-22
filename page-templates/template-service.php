<?php /* Template name: Page - Service */ ?>
<?= get_header() ?>
<?php
if (have_rows('service_sections')) :
	while (have_rows('service_sections')) : the_row();
		get_template_part('modules/service/service-' . get_row_layout());
	endwhile;
endif;
?>
<?= get_footer() ?>