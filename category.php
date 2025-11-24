<?php
/**
 * The template for displaying Category pages
 */
get_header();

$type_category = get_field('select_type_category', get_queried_object());

get_template_part('template-parts/layout-archive');

get_footer();
?>