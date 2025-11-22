<?php
class Product_Category_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));

		$output .= '<li class="' . esc_attr($class_names) . ' group first:ml-auto last:mr-auto">';

		$attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target) . '"'     : '';
		$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"'         : '';
		$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"'         : '';

		$item_output = $args->before;
		$item_output .= '<a class="item-product-category flex flex-col items-center gap-2 relative" ' . $attributes . '>';
		$item_output .= '<div class="img rem:w-[120px] border border-Neutral-100 rounded-lg overflow-hidden">';
		$item_output .= '<div class="img-ratio zoom-img">';

		// Get taxonomy thumbnail
		$term_id = $item->object_id;
		$image_url = wp_get_attachment_image_url(
			get_term_meta($term_id, 'thumbnail_id', true),
			'medium'
		);
		$label_category = get_field('label_category', 'product_cat_' . $term_id);

		$item_output .= '<img class="lozad" data-src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '">';

		$item_output .= '</div></div>';
		$item_output .= '<h2 class="title group-hover:text-Primary-500 transition-colors text-center text-base group-[.active]:text-Primary-Red">' . apply_filters('the_title', $item->title, $item->ID) . '</h2>';

		if (!empty($label_category)) {
			$item_output .= '<div class="tag absolute top-0 right-0 translate-x-[20%] lg:translate-x-1/2 -translate-y-1/2 bg-Primary-Red text-white text-xs lg:text-sm font-black flex-center rem:rounded-[4px] rem:h-[24px] px-1">' . esc_html($label_category) . '</div>';
		}

		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}
