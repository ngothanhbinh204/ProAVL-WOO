<?php
$banner = false;
$queried_object = get_queried_object();

if ( function_exists('is_shop') && is_shop() ) {
    $shop_page_id = wc_get_page_id( 'shop' );
    $banner = get_field('banner_select_page', $shop_page_id);
} 
elseif ( function_exists('is_product_category') && is_product_category() ) {
    // 1. Try to get banner from current category
    if ( $queried_object instanceof WP_Term ) {
        $term_id = $queried_object->taxonomy . '_' . $queried_object->term_id;
        $banner = get_field('banner_select_page', $term_id);
    }
    
    // 2. Fallback to Shop Page if category has no banner
    if ( ! $banner ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        $banner = get_field('banner_select_page', $shop_page_id);
    }
}
elseif ( is_home() ) {
    $page_for_posts = get_option( 'page_for_posts' );
    $banner = get_field('banner_select_page', $page_for_posts);
} 
elseif ( is_singular() ) {
    $banner = get_field('banner_select_page', get_the_ID());
}

// Handle array return from ACF relationship/post_object field
if ( $banner && is_array($banner) ) {
    $banner = $banner[0];
}
?>

<?php if ($banner) : ?>
<section class="section-banner-secondary">
    <div class="banner-secondary">
        <div class="banner-img img-ratio ratio:pt-[960_1920]">
            <?= get_image_post($banner->ID, 'image') ?>
        </div>
    </div>
</section>
<?php endif; ?>