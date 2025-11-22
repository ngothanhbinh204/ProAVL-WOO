<?php /* Template name: Page - Solution */ ?>
<?= get_header() ?>
<?php
if (have_rows('solution_sections')) :
	while (have_rows('solution_sections')) : the_row();
		get_template_part('modules/solution/solution-' . get_row_layout());
	endwhile;
endif;
?>
<?= get_footer() ?>