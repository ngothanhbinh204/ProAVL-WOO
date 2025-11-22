<?php get_header() ?>
<?php if (is_account_page()) : ?>
	<?php the_content() ?>
<?php else : ?>
	<?php the_content() ?>
<?php endif; ?>
<?php get_footer() ?>