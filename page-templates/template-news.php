<?php /* Template name: Page - News */ ?>
<?= get_header() ?>
<?php
if (have_rows('news_sections')) :
	while (have_rows('news_sections')) : the_row();
		get_template_part('modules/news/news-' . get_row_layout());
	endwhile;
endif;
?>
<?= get_footer() ?>