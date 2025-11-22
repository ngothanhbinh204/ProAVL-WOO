<?php get_header() ?>
<?php get_template_part('modules/common/banner') ?>
<?php get_template_part('modules/common/breadcrumb') ?>
<?php
$type_category = get_field('select_type_category', 'category_' . get_queried_object_id());
?>

<section class="section-home-7 section-py">
	<div class="container">
		<h1 class="title-48 mb-base text-center">
			<?= wp_get_nav_menu_name('menu-category') ?>
		</h1>
		<div class="wrap-tab-menu tabs-menu-primary mb-base">
			<?php wp_nav_menu([
				"theme_location" => "menu-category",
				"container" => "false",
				"menu_id" => "menu-category",
			]); ?>
		</div>
	</div>
	<?php if ($type_category == 'events') : ?>
		<?php get_template_part('modules/category/events') ?>
	<?php else: ?>
		<div class="grid md:grid-cols-2 grid-cols-1 lg:grid-cols-3 gap-5 lg:px-10 px-[15px] mb-base">
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'posts_per_page' => 9,
				'post_type'      => 'post',
				'paged' => $paged,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'id',
						'terms' => get_queried_object_id(),
						'include_children' => true,
						'operator' => 'IN'
					)
				)
			);
			$the_query = new WP_Query($args);
			?>
			<?php if ($the_query->have_posts()) : ?>
				<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<div class="item-category-primary relative">
						<div class="img zoom-img">
							<a class="img img-ratio ratio:pt-[400_600]" href="<?php the_permalink(); ?>">
								<?= get_image_post(get_the_ID()) ?>
							</a>
						</div>
						<div class="content w-full py-4 text-black">
							<h3 class="title-32 mb-3 hover-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="desc line-clamp-3">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<div class="flex-center">
			<?php echo wp_bootstrap_pagination(array('custom_query' => $the_query)) ?>
		</div>
	<?php endif ?>
</section>


<?php get_footer() ?>