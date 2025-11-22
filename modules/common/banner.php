<?php
$queried_object = get_queried_object();
$id = false;
$taxonomy_banner_id = false;
if ( $queried_object instanceof WP_Term ) {
    $taxonomy_banner_id = $queried_object->taxonomy . '_' . $queried_object->term_id; 
    $banner = get_field('banner_select_page', $taxonomy_banner_id); 

    if ( empty($banner) ) {
        $id = wc_get_page_id( 'shop' ); 
    } else {
        $id = $taxonomy_banner_id; 
    }
} 
elseif ( is_shop() ) {
    $id = wc_get_page_id( 'shop' );
} 
else {
    $id = get_the_ID();
}

if ( $id ) {
    if ( !isset($banner) || empty($banner) ) {
        $banner = get_field('banner_select_page', $id);
    }
}
?>
<?php if ($banner) : 
    if (is_array($banner)) {
        $banner = $banner[0];
    }
?>
<section class="section-banner-secondary">
    <div class="banner-secondary">
        <div class="banner-img img-ratio ratio:pt-[960_1920]">
            <?= get_image_post($banner->ID, 'image') ?>
        </div>
    </div>
</section>
<?php endif; ?>