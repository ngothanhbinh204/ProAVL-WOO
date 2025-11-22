<?php get_header() ?>
<?php get_template_part('modules/common/breadcrumb') ?>
<section class="new-detail py-20 font-font-title max-lg:py-10">
	<div class="container">
		<div class="grid xl:grid-cols-12 gap-10">
			<div class="xl:col-span-9 relative">
				<div class="tool-share xl:absolute xl:right-full top-0 pb-2 xl:pt-5 xl:mr-5 xl:h-full">
					<div class="sticky top-[calc(var(--header-scroll)+15px)]">
						<div class="tool-share-item">
							<a class="tool-share-link flex-center rounded-full w-12 h-12 border border-Neutral-100 text-Primary-Red hover:bg-Primary-Red hover:text-white transition-all duration-300" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook"> <i class="fa-brands fa-facebook-f"></i></a>
						</div>
						<div class="tool-share-item mt-2">
							<a class="tool-share-link flex-center rounded-full w-12 h-12 border border-Neutral-100 text-Primary-Red hover:bg-Primary-Red hover:text-white transition-all duration-300" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"> <i class="fa-brands fa-twitter"></i></a>
						</div>
						<div class="tool-share-item mt-2">
							<a class="tool-share-link flex-center rounded-full w-12 h-12 border border-Neutral-100 text-Primary-Red hover:bg-Primary-Red hover:text-white transition-all duration-300" href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="Google"> <i class="fa-brands fa-google"></i></a>
						</div>
						<div class="tool-share-item mt-2">
							<a class="tool-share-link flex-center rounded-full w-12 h-12 border border-Neutral-100 text-Primary-Red hover:bg-Primary-Red hover:text-white transition-all duration-300" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"> <i class="fa-brands fa-linkedin-in"></i></a>
						</div>
					</div>
				</div>
				<h1 class="text-5xl font-bold text-[#090909] mb-5 max-md:text-2xl max-lg:text-3xl leading-tight"><?php the_title() ?></h1>
				<div class="new-detail-heading flex items-center gap-5 justify-between mb-5 max-md:gap-5">
					<span class="text-Primary-Red-2 rem:text-[14px]"><?php echo get_the_category()[0]->name ?></span>
					<span class="text-[#818285] rem:text-[14px]"><?php echo get_the_date('d - m - Y') ?></span>
					<div class="flex-1 h-[1px] bg-[#2D54C5]"></div>
				</div>
				<div class="new-detail-content format-content">
					<?php
					if (canhcam_embed()):
					?>
						<?php the_content() ?>
					<?php else: ?>
						<?php
						get_content_3ds(get_the_ID());
						?>
					<?php endif; ?>
				</div>
				<div class="news-share flex items-center justify-end gap-3">
					<p>
						<strong><?= _e('Bình chọn:', 'canhcamtheme') ?> </strong>
					</p>
					<?php echo kk_star_ratings(); ?>
				</div>
				<div class="custom-about-us py-5">
					<?= get_field('post_about_us', 'options') ?>
				</div>
				<div class="flex items-center justify-between">
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();
					?>
					<?php if ($prev_post): ?>
						<a href="<?php echo get_permalink($prev_post->ID); ?>" class="flex items-end gap-2 text-Primary-Red-2 hover:text-Primary-Red-2/80 transition-300">
							<div class="flex">
								<i class="fa-light fa-arrow-left"></i>
							</div>
							<span class="font-medium"><?= _e('Bài trước', 'canhcamtheme') ?></span>
						</a>
					<?php endif; ?>
					<?php if ($next_post): ?>
						<a href="<?php echo get_permalink($next_post->ID); ?>" class="flex items-end gap-2 text-Primary-Red-2 hover:text-Primary-Red-2/80 transition-300">
							<span class="font-medium"><?= _e('Bài sau', 'canhcamtheme') ?></span>
							<div class="flex">
								<i class="fa-light fa-arrow-right"></i>
							</div>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="xl:col-span-3">
				<div class="title mb-5 rem:text-[24px] text-Primary-Red-2 font-bold"><?= _e('Tin tức khác', 'canhcamtheme') ?></div>
				<div class="new-detail-list flex flex-col gap-3">
					<?php
					$args = array(
						'posts_per_page' => 5,
						'post_type'      => 'post',
						'order' => 'DESC',
						'orderby' => 'date',
						'post__not_in' => array(get_the_ID())
					);
					$the_query = new WP_Query($args);
					?>
					<?php if ($the_query->have_posts()) : ?>
						<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
							<div class="new-detail-item flex xl:items-center gap-5">
								<div class="new-detail-images w-[40%]">
									<div class="new-detail-image">
										<a class="img-ratio ratio:pt-[68_100]" href="<?php the_permalink() ?>">
											<?= get_image_post(get_the_ID()) ?>
										</a>
									</div>
								</div>
								<div class="new-detail-content w-[60%] py-1 border-t border-t-Primary-100">
									<span class="text-sm text-Neutral-600 font-medium mb-1"><?php echo get_the_date('d-m-Y') ?></span>
									<h3 class="text-lg text-Neutral-600 font-bold line-clamp-2 hover:text-Primary-Red-2">
										<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
									</h3>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer() ?>
<style>
	@media (min-width: 1200px) {
		.ftwp-fixed-to-post #ftwp-contents {
			left: 20px !important;
		}
	}

	.format-content table td {
		padding: 10px;
	}
</style>