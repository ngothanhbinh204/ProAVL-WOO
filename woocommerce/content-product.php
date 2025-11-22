<?php
defined('ABSPATH') || exit;

global $product;
if (!$product->is_visible()) {
	return;
}
?>
<div <?php wc_product_class('item-product-primary h-full flex flex-col relative', $product); ?>>
	<a class="img rounded-t-2xl overflow-hidden img-ratio ratio:pt-[213_335] zoom-img" href="<?php echo get_permalink($product->get_id()); ?>">
		<img data-src="<?= get_image_post($product->get_id(), 'url') ?>" alt="<?= $product->get_name() ?>" class="lozad">
	</a>
	<div class="content flex flex-col p-4 border border-Neutral-100 rounded-b-2xl gap-1.5 bg-white border-t-0 flex-1">
		<h3 class="font-semibold text-base">
			<a class="hover:text-Primary-Red" href="<?php echo get_permalink($product->get_id()); ?>">
				<?php echo $product->get_name(); ?>
			</a>
		</h3>
		<?php if ($product->get_sku() || $product->is_type('variable')) : ?>
			<div class="sku text-xs text-Neutral-300 tracking-[0.48px]">
				<?php
				$sku = '';
				if ($product->is_type('variable')) {
					$default_attributes = $product->get_default_attributes();
					if (!empty($default_attributes)) {
						$variation_id = $product->get_visible_children()[0]; // Default to first variation
						foreach ($product->get_available_variations() as $variation_array) {
							$match = true;
							foreach ($default_attributes as $attribute_name => $attribute_value) {
								$variation_attribute = 'attribute_' . $attribute_name;
								if (isset($variation_array['attributes'][$variation_attribute]) && $variation_array['attributes'][$variation_attribute] !== $attribute_value) {
									$match = false;
									break;
								}
							}
							if ($match) {
								$variation_id = $variation_array['variation_id'];
								break;
							}
						}
						$variation = wc_get_product($variation_id);
						if ($variation && $variation->get_sku()) {
							$sku = $variation->get_sku();
						}
					}
				}

				if (empty($sku)) {
					$sku = $product->get_sku();
				}

				if (!empty($sku)) {
					echo _e('SKU', 'canhcamtheme') . ' ' . $sku;
				}
				?>
			</div>
		<?php endif; ?>
		<div class="product-price mb-1">
			<?php if ($product->get_price() != 0) : ?>
				<span class="price">
					<?php echo $product->get_price_html(); ?>
				</span>
			<?php endif; ?>
		</div>
		<div class="product-action mt-auto">
			<?php do_action('woocommerce_template_loop_add_to_cart'); ?>
		</div>
	</div>
</div>