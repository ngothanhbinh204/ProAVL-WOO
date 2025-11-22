<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php get_header('shop'); ?>

<?php $cat = get_queried_object(); ?>

<?php 
if($cat->parent > 0): 
    $parent_cat = get_term($cat->parent, 'product_cat');
    $banner = get_field('banner', $parent_cat);
else:
    $banner = get_field('banner', $cat);
endif;
?>


<section class="page-banner-main banner-product rem:min-h-[400px] flex flex-col justify-between" setBackground="<?php echo $banner['url'] ? $banner['url'] : get_template_directory_uri().'/img/1.jpg'; ?>">
    <div class="content-breadcrumb container py-10 flex flex-col items-center text-center text-white z-5">
        <h1 class="banner-title">
            <?php 
            // If this is a child category, show parent name followed by child name
            if ($cat->parent > 0) {
                $parent_cat = get_term($cat->parent, 'product_cat');
                echo $parent_cat->name;
            } else {
                echo $cat->name;
            }
            ?>
        </h1>
        <div class="breadcrumb">
            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        </div>
    </div>
    <?php if(!is_shop()): ?>
        <div class="list-tab-category">
            <div class="wrap section-scrollTo-active">
                <ul> 
                    <?php 
                    // Check if we're on a child category page
                    if ($cat->parent > 0) {
                        // If we're on a child category, get sibling categories (same parent)
                        $child_categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'parent' => $cat->parent,
                            'orderby' => 'menu_order'
                        ]);
                    } else {
                        // If we're on a parent category, get its children
                        $child_categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'parent' => $cat->term_id,
                            'orderby' => 'menu_order'
                        ]);
                    }
                    
                    foreach($child_categories as $child_cat) : 
                        $thumbnail_id = get_woocommerce_term_meta($child_cat->term_id, 'thumbnail_id', true);
                        $image = wp_get_attachment_url($thumbnail_id);
                        $product_count = $child_cat->count;
                    ?>
                    <li>
                        <a href="<?php echo get_term_link($child_cat); ?>" class="item-category<?php echo ($cat->term_id == $child_cat->term_id) ? ' active' : ''; ?>"> 
                            <div class="icon"> 
                                <img class="lozad undefined" data-src="<?php echo $image ? $image : get_template_directory_uri().'/img/13.svg'; ?>" alt="<?php echo $child_cat->name; ?>"/>
                                <div class="num"><?php echo $product_count; ?></div>
                            </div>
                            <p><?php echo $child_cat->name; ?></p>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</section>


<?php
// Check if there are products in the current category
$args = array(
    'post_type' => 'product',
    'posts_per_page' => -1, // Get all products
    'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $cat->term_id,
            'include_children' => true
        )
    )
);

$products_query = new WP_Query($args);

if (!$products_query->have_posts()) {
    $check_product = false;
} else {
    $check_product = true;
}

wp_reset_postdata();

if(get_field('top_up',$cat)){ ?>
    <section class="section-product-detail section-py section-product-toptup">
        <div class="container"> 
            <div class="row"> 
                <div class="col-lg-8">
                    <div class="product-box box-white flex flex-col gap-base mb-base">
                        <div class="wrap-form-style flex flex-col gap-base">
                            <div class="form-select flex items-center gap-3 text-white">
                                <?php
                                // Get child categories of current category
                                $child_categories = get_terms([
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => false,
                                    'parent' => $cat->term_id,
                                    'orderby' => 'menu_order'
                                ]);
                                
                                if (!empty($child_categories)) { 
                                    foreach($child_categories as $child_cat) { ?>
                                        <label for="game">SELECT <?php echo $child_cat->name; ?></label>
                                        <select name="game" id="game" class="game-category-select">
                                            <option value=""><?php echo $child_cat->name; ?></option>
                                            <?php
                                                $grandchild_categories = get_terms([
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => false,
                                                    'parent' => $child_cat->term_id,
                                                    'orderby' => 'menu_order'
                                                ]);
                                            foreach ($grandchild_categories as $item) {
                                                echo '<option value="' . esc_attr($item->term_id) . '">' . esc_html($item->name) . '</option>';
                                            } ?>
                                        </select>
                                    <?php }
                                } ?>
                                                                
                            </div>
                            <div class="title-24 font-bold"><?php _e('1. Choosing your packages', 'canhcamtheme'); ?></div>
                            <div class="wrap-list-packages">
                                <?php
                                // Get packages from the current category
                                $category_id = isset($_GET['category']) ? intval($_GET['category']) : $cat->term_id;
                                
                                $args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'term_id',
                                            'terms' => $category_id,
                                            'include_children' => true
                                        )
                                    )
                                );
                                
                                $products = new WP_Query($args);
                                
                                if($products->have_posts()) {
                                    while($products->have_posts()) : $products->the_post();
                                        global $product;
                                        $product_id = $product->get_id();
                                        $product_image = get_the_post_thumbnail_url($product_id) ? get_the_post_thumbnail_url($product_id) : wc_placeholder_img_src();
                                        ?>
                                        <div class="item-package" data-currency-symbol="<?php echo get_woocommerce_currency_symbol(); ?>" data-img="<?php echo esc_url($product_image); ?>" data-product-id="<?php echo esc_attr($product_id); ?>" data-price="<?php echo esc_attr($product->get_price()); ?>" data-title="<?php echo esc_attr(get_the_title()); ?>">
                                            <div class="content"> 
                                                <div class="icon"><img class="lozad undefined" data-src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
                                                </div>
                                                <div class="desc"><?php echo esc_html(get_the_title()); ?></div>
                                            </div>
                                            <div class="quantity"> 
                                                <button class="minus">-</button>
                                                <input type="text" value="0" class="package-quantity" data-product-id="<?php echo esc_attr($product_id); ?>">
                                                <button class="plus">+</button>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                } else {
                                    echo '<p>No packages available</p>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="product-content box-white mb-base">
                        <div class="format-content prose space-y-4">
                            <h3 class="title-24">Description</h3>
                            <?php echo wpautop(get_field('description', $cat)); ?>
                        </div>
                    </div>
                    <div class="product-content box-white">
                        <div class="format-content prose space-y-4">
                            <h3 class="title-24">Guides</h3>
                            <?php echo wpautop(get_field('guide', $cat)); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-box-delivery bg-white/60 rounded-4 lg:p-6 p-base mb-base">
                        <div class="title-24 border-b border-b-white mb-[15px] pb-[15px] lg:pb-6 lg:mb-6 font-bold">2. User Information</div>
                        <div class="list-input-info">
                            <div class="item-input-info"> 
                                <label>User ID: <span class="required" style="color: red;">*</span></label>
                                <div>
                                    <input type="text" id="topup_user_id" placeholder="Please enter your User ID">
                                    <span class="error-message" style="color: #e74c3c; font-size: 12px; display: none;"></span>
                                </div>
                            </div>
                            <div class="item-input-info"> 
                                <label>Note: <span class="required" style="color: red;">*</span></label>
                                <div>
                                    <textarea id="topup_note" placeholder="Additional information"></textarea>
                                    <span class="error-message" style="color: #e74c3c; font-size: 12px; display: none;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-box-delivery bg-white/60 rounded-4 lg:p-6 p-base">
                        <div class="title-24 mb-[15px] lg:mb-6 font-bold">3. Checkout</div>
                        <div class="wrap-list-cart-item flex flex-col gap-6" id="topup-cart-items">
                            <!-- Cart items will be populated dynamically via JavaScript -->
                        </div>
                        <div class="wrap-sum lg:py-6 lg:my-6 py-[15px] my-[15px] border-b border-t border-white flex items-center justify-between">
                            <p>Total:</p>
                            <p class="title-24 font-bold" id="topup-total-price">0$</p>
                        </div>
                        <div class="wrap-button flex flex-col gap-6">
                            <div class="btn btn-primary" id="topup-add-to-cart"> <span>ADD TO CART</span><i class="fa-light fa-cart-shopping-fast text-xl"></i></div>
                            <div class="btn btn-primary style-black" id="topup-buy-now"><span id="topup-buy-now-price">0$</span><span>|</span><span>BUY NOW</span></div>
                        </div>
                        <div class="accepttable"> 
                            <label for="accept"> 
                                <input type="checkbox" id="accept">
                                <p>By ticking, you have read and agree to our <a href="<?php echo get_permalink(get_page_by_path('terms-of-service')); ?>">Terms of Service,</a><a href="<?php echo get_permalink(get_page_by_path('refund-policy')); ?>">Refund and Exchange Policy </a>and <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>">Privacy Policy.</a></p>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-product-detail section-py section-product-toptup related lg:!pt-10"> 
        <div class="container"> 
            <div class="text-center"> 
                <h4 class="heading-1 text-white mb-base">More from this seller</h4>
            </div>
            <div class="swiper-column-auto auto-3-column relative">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php
                        // Get related products from same parent category
                        $parent_id = $cat->parent;
                        if($parent_id) {
                            $related_args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 10,
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'term_id',
                                        'terms' => $parent_id,
                                        'include_children' => true
                                    )
                                ),
                                'orderby' => 'rand'
                            );
                            
                            $related_products = new WP_Query($related_args);
                            
                            if($related_products->have_posts()) {
                                while($related_products->have_posts()) : $related_products->the_post();
                                    global $product;
                                    $product_id = $product->get_id();
                                    $product_image = get_the_post_thumbnail_url($product_id) ? get_the_post_thumbnail_url($product_id) : wc_placeholder_img_src();
                                    $product_cats = get_the_terms($product_id, 'product_cat');
                                    $cat_image = '';
                                    if($product_cats && !is_wp_error($product_cats)) {
                                        $cat_id = $product_cats[0]->term_id;
                                        $thumbnail_id = get_woocommerce_term_meta($cat_id, 'thumbnail_id', true);
                                        $cat_image = wp_get_attachment_url($thumbnail_id);
                                    }
                                    ?>
                                    <div class="swiper-slide">
                                        <div class="item-product-featured bg-white/60 flex flex-col p-5 rounded-4 backdrop-blur-md gap-5">
                                            <a href="<?php the_permalink(); ?>" class="img img-ratio ratio:pt-[440_820] rounded-4 zoom-img">
                                                <img class="lozad undefined" data-src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
                                            </a>
                                            <div class="wrap-content flex justify-between items-end gap-5 flex-wrap">
                                                <div class="flex flex-col">
                                                    <h3 class="title-24 font-bold hover:text-primary-2 transition-all"> 
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="desc body-16"><?php echo wp_trim_words(get_the_excerpt(), 10); ?></div>
                                                    <?php if($cat_image): ?>
                                                    <div class="logo mt-1">
                                                        <img class="lozad undefined" data-src="<?php echo esc_url($cat_image); ?>" alt="<?php echo esc_attr($product_cats[0]->name); ?>"/>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="wrap-button-slide"> 
                    <div class="btn btn-prev btn-sw-1"></div>
                    <div class="btn btn-next btn-sw-1"></div>
                </div>
            </div>
        </div>
    </section>
<?php } elseif(get_field('sell_to_us',$cat)) { ?>
    <section class="section-product-list-sell section-py">
        <div class="container">
            <?php if(get_field('sell_to_us_content',$cat)): ?>
                <?php $sell_to_us_content = get_field('sell_to_us_content',$cat); ?>
                <?php $title = $sell_to_us_content['title']; ?>
                <?php $subtitle = $sell_to_us_content['subtitle']; ?>
                <?php $discord = $sell_to_us_content['discord']; ?>
                <div class="flex flex-col lg:gap-5 gap-[15px] text-white mb-base">
                    <h1 class="title-40"><?php echo $title; ?></h1>
                    <h2 class="title-48"><?php echo $subtitle; ?></h2>
                    <p class="box-wrap border border-primary-1 bg-white/20 text-white p-4 py-2 rounded-4 rem:min-h-[80px] title-40 [&amp;_a]:underline break-words">
                        <?php _e('CHANNEL DISCORD:', 'canhcamtheme'); ?>  <a><?php echo $discord; ?></a>
                    </p>
                </div>
            <?php endif; ?>

            <?php
                if(get_field('discord',$cat)){
                    $discord = get_field('discord',$cat);
                    $title = $discord['title'];
                    $discord_box = $discord['discord_box'];
                    $content = $discord['content'];
                    ?>
                    <div class="box-content bg-[#EF212D]/20 border border-primary-1 p-base lg:p-8 rounded-4 mb-base">
                        <div class="title-40 font-bold text-white lg:mb-8 mb-[15px]"><?php echo $title; ?></div>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 text-white gap-base lg:gap-8">
                            <?php foreach($discord_box as $box) : ?>
                                <div class="item-box flex flex-col border border-primary-1 rounded-4 lg:p-8 p-[15px] gap-5">
                                    <div class="title-24 font-bold"><?php echo $box['title']; ?></div>
                                    <ul class="list-social flex flex-col gap-5">
                                        <?php foreach($box['discord_items'] as $item) : ?>
                                            <li class="font-bold flex flex-col gap-2">
                                                <div class="title-24 flex items-center gap-4">
                                                    <?php if($item['icon']): ?>
                                                        <img class="lozad undefined" data-src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>"/>
                                                    <?php else: ?>
                                                        <img class="lozad undefined" data-src="<?php echo get_stylesheet_directory_uri(); ?>/img/16.svg" alt=""/>
                                                    <?php endif; ?>
                                                    <p><?php echo $item['link']; ?></p>
                                                </div>
                                                <div class="body-18"><?php echo $item['id']; ?></div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if($content) : ?>
                        <div class="format-content text-white"><?php echo $content; ?></div>
                    <?php endif; ?>
                    <?php
                }
            ?>

        </div>
    </section>
<?php } else{
    if($check_product) { ?>
        <section class="page-product-list section-py xl:rem:py-[40px]">
            <div class="container"> 
                <div class="wrap-form-filter wrap-form-style lg:mb-8 mb-[15px]">
                    <div class="form-input"> 
                        <form method="GET" action="" class="search-form">
                            <input type="text" id="product-search" name="s" placeholder="Search your product">
                            <input type="hidden" name="post_type" value="product">
                            <?php 
                            // Preserve existing query parameters
                            if (isset($_GET['product_tag'])) {
                                echo '<input type="hidden" name="product_tag" value="' . esc_attr($_GET['product_tag']) . '">';
                            }
                            if (isset($_GET['orderby'])) {
                                echo '<input type="hidden" name="orderby" value="' . esc_attr($_GET['orderby']) . '">';
                            }
                            // Preserve filter-category parameters
                            foreach($_GET as $key => $value) {
                                if (strpos($key, 'filter-category-') === 0) {
                                    echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                                }
                            }
                            ?>
                        </form>
                    </div>
                    
                    <?php
                    // Only show category filters if the current category has a parent
                    if (isset($cat->parent) && $cat->parent > 0) {
                        // Get child categories of current category
                        $child_categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'parent' => $cat->term_id,
                            'orderby' => 'menu_order'
                        ]);
                        
                        // Create placeholder text from child category names
                        if (!empty($child_categories)) {
                            foreach($child_categories as $index => $child_cat) {
                                // Get current selected category if any
                                $selected_category = isset($_GET['filter-category-' . ($index+1)]) ? $_GET['filter-category-' . ($index+1)] : '';
                                ?>
                                <div class="form-select"> 
                                    <form method="GET" action="">
                                        <select name="filter-category-<?php echo $index+1; ?>" id="filter-category-<?php echo $index+1; ?>" placeholder="<?php echo $child_cat->name; ?>" onchange="this.form.submit()">
                                            <option value=""><?php echo $child_cat->name; ?></option>
                                            <?php
                                                // Get grandchild categories (children of child)
                                                $grandchild_categories = get_terms([
                                                    'taxonomy' => 'product_cat',
                                                    'hide_empty' => false,
                                                    'parent' => $child_cat->term_id,
                                                    'orderby' => 'menu_order'
                                                ]);
                                                
                                                if(!empty($grandchild_categories)) {
                                                    foreach($grandchild_categories as $grandchild) {
                                                        echo '<option value="' . esc_attr($grandchild->term_id) . '"' . 
                                                            selected($selected_category, $grandchild->term_id, false) . '>' . 
                                                            esc_html($grandchild->name) . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <?php 
                                        // Preserve existing query parameters
                                        if (isset($_GET['s'])) {
                                            echo '<input type="hidden" name="s" value="' . esc_attr($_GET['s']) . '">';
                                        }
                                        if (isset($_GET['post_type'])) {
                                            echo '<input type="hidden" name="post_type" value="' . esc_attr($_GET['post_type']) . '">';
                                        }
                                        if (isset($_GET['product_tag'])) {
                                            echo '<input type="hidden" name="product_tag" value="' . esc_attr($_GET['product_tag']) . '">';
                                        }
                                        if (isset($_GET['orderby'])) {
                                            echo '<input type="hidden" name="orderby" value="' . esc_attr($_GET['orderby']) . '">';
                                        }
                                        // Preserve other filter-category parameters
                                        foreach($_GET as $key => $value) {
                                            if (strpos($key, 'filter-category-') === 0 && $key !== 'filter-category-' . ($index+1)) {
                                                echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                                            }
                                        }
                                        ?>
                                    </form>
                                </div>
                                <?php
                            }
                        }
                    } ?>
                    
                </div>
                <div class="wrap-form-select-tab wrap-form-style flex items-center justify-between flex-wrap gap-y-5">
                    <div class="tabslet-primary">
                        <ul> 
                            <?php
                            // Get all product tags used in the current category
                            $product_tags = array();
                            
                            // Query products in current category
                            $products_query = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'term_id',
                                        'terms' => $cat->term_id,
                                        'include_children' => true,
                                    ),
                                ),
                            ));
                            
                            // Collect all tags from these products
                            if ($products_query->have_posts()) {
                                while ($products_query->have_posts()) {
                                    $products_query->the_post();
                                    $tags = get_the_terms(get_the_ID(), 'product_tag');
                                    if ($tags && !is_wp_error($tags)) {
                                        foreach ($tags as $tag) {
                                            $product_tags[$tag->slug] = $tag;
                                        }
                                    }
                                }
                                wp_reset_postdata();
                            }
                            
                            // Display all tags
                            $current_tag = isset($_GET['product_tag']) ? intval($_GET['product_tag']) : 0;
                            
                            // Add "All" option
                            $current_url = remove_query_arg('product_tag', $_SERVER['REQUEST_URI']);
                            echo '<li><a href="' . esc_url($current_url) . '" class="item-category' . ($current_tag == 0 ? ' active' : '') . '">All</a></li>';
                            
                            // Display each tag
                            foreach ($product_tags as $tag) {
                                // Preserve other query parameters while changing product_tag
                                $current_url = $_SERVER['REQUEST_URI'];
                                $current_url = remove_query_arg('product_tag', $current_url);
                                $tag_link = add_query_arg('product_tag', $tag->slug, $current_url);
                                
                                echo '<li><a href="' . esc_url($tag_link) . '" class="item-category' . ($current_tag == $tag->slug ? ' active' : '') . '">' . esc_html($tag->name) . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="form-select flex items-center gap-3 text-white -md:ml-auto">
                        <label><?php _e('ORDER BY:', 'canhcamtheme'); ?></label>
                        <form method="GET" action="">
                            <select name="orderby" onchange="this.form.submit()">
                                <option value="menu_order" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'menu_order'); ?>><?php _e('Recommend', 'canhcamtheme'); ?></option>
                                <option value="popularity" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'popularity'); ?>><?php _e('Sort by popularity', 'canhcamtheme'); ?></option>
                                <option value="rating" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'rating'); ?>><?php _e('Sort by average rating', 'canhcamtheme'); ?></option>
                                <option value="date" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'date'); ?>><?php _e('Sort by latest', 'canhcamtheme'); ?></option>
                                <option value="price" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price'); ?>><?php _e('Sort by price: low to high', 'canhcamtheme'); ?></option>
                                <option value="price-desc" <?php selected(isset($_GET['orderby']) ? $_GET['orderby'] : '', 'price-desc'); ?>><?php _e('Sort by price: high to low', 'canhcamtheme'); ?></option>
                            </select>
                            <?php 
                            // Preserve existing query parameters
                            if (isset($_GET['s'])) {
                                echo '<input type="hidden" name="s" value="' . esc_attr($_GET['s']) . '">';
                            }
                            if (isset($_GET['post_type'])) {
                                echo '<input type="hidden" name="post_type" value="' . esc_attr($_GET['post_type']) . '">';
                            }
                            if (isset($_GET['product_tag'])) {
                                echo '<input type="hidden" name="product_tag" value="' . esc_attr($_GET['product_tag']) . '">';
                            }
                            // Preserve filter-category parameters
                            foreach($_GET as $key => $value) {
                                if (strpos($key, 'filter-category-') === 0) {
                                    echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="wrap-product-list lg:pt-10 pt-5">
                    <div class="row" id="product-container"> 
    
                        <?php
                        // Apply filters directly to the main query
                        if (is_product_taxonomy() || is_shop()) {
                            // Get the main query object
                            global $wp_query;
                            
                            // Initialize tax_query array
                            $tax_query = array();
                            
                            // Get existing tax query if it exists
                            $existing_tax_query = $wp_query->get('tax_query');
                            if (is_array($existing_tax_query)) {
                                $tax_query = $existing_tax_query;
                            }
                            
                            // Set relation to AND for multiple tax queries
                            if (!empty($tax_query)) {
                                $tax_query['relation'] = 'AND';
                            }
                            
                            // Apply product tag filter                    
                            if (isset($_GET['product_tag']) && !empty($_GET['product_tag'])) {
                                
                                $product_tag = $_GET['product_tag'];
    
                                $wp_query->set('tax_query', array_merge($tax_query, array(
                                    array(
                                        'taxonomy' => 'product_tag',
                                        'field'    => 'slug',
                                        'terms'    => array($product_tag)
                                    )
                                )));
                            }
    
                            // echo '<pre>';
                            // print_r($wp_query);
                            // echo '</pre>';
                            
                            // Apply category filters
                            $category_filters = array();
                            
                            // Check for all category filters
                            foreach($_GET as $key => $value) {
                                if (strpos($key, 'filter-category-') === 0 && !empty($value)) {
                                    $category_filters[] = intval($value);
                                }
                            }
                            
                            if (!empty($category_filters)) {
                                $wp_query->set('tax_query', array_merge($tax_query, array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'term_id',
                                        'terms'    => $category_filters,
                                        'operator' => 'AND'
                                    )
                                )));
                            }
                            
                            // Apply orderby filter
                            $orderby_value = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : '';
                            if (!empty($orderby_value)) {
                                switch ($orderby_value) {
                                    case 'popularity':
                                        $wp_query->set('meta_key', 'total_sales');
                                        $wp_query->set('orderby', 'meta_value_num');
                                        break;
                                    case 'rating':
                                        $wp_query->set('meta_key', '_wc_average_rating');
                                        $wp_query->set('orderby', 'meta_value_num');
                                        break;
                                    case 'date':
                                        $wp_query->set('orderby', 'date');
                                        break;
                                    case 'price':
                                        $wp_query->set('meta_key', '_price');
                                        $wp_query->set('orderby', 'meta_value_num');
                                        $wp_query->set('order', 'ASC');
                                        break;
                                    case 'price-desc':
                                        $wp_query->set('meta_key', '_price');
                                        $wp_query->set('orderby', 'meta_value_num');
                                        $wp_query->set('order', 'DESC');
                                        break;
                                    default:
                                        $wp_query->set('orderby', 'menu_order title');
                                        break;
                                }
                            }
                            
                            // Force query to run again with our parameters
                            $wp_query->query($wp_query->query_vars);
                        }
                        
                        // Use WooCommerce's default query
                        if (woocommerce_product_loop()) {
                            // Loop through products
                            while (have_posts()) : the_post();
                                global $product;
                                ?>
                                <div class="col-md-6 col-lg-3">
                                    <div class="item-product">
                                        <div class="product-stock-quantity mb-3">
                                            <div class="stock"><?php echo $product->is_in_stock() ? 'In stock' : 'Out of stock'; ?></div>
                                            <div class="wrap-quantity">
                                                <button class="minus">-</button>
                                                <input type="text" value="1" class="product-quantity" data-product-id="<?php echo $product->get_id(); ?>"/>
                                                <button class="plus">+</button>
                                            </div>
                                        </div>
                                        <div class="product-img mb-5">
                                            <div class="img-ratio ratio:pt-[158_280] ratio-contain rounded-3">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <img class="lozad undefined" data-src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"/>
                                                <?php else : ?>
                                                    <img class="lozad undefined" data-src="<?php echo wc_placeholder_img_src(); ?>" alt="<?php the_title(); ?>"/>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="product-wrap-title mb-5">
                                            <h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <div class="product-desc"><?php echo wp_trim_words($product->get_short_description(), 10); ?></div>
                                        </div>
                                        <div class="product-price flex flex-col gap-1 mb-5">
                                            <p class="unit"><?php _e('Unit Price:', 'canhcamtheme'); ?> <strong><?php echo $product->get_price_html(); ?></strong></p>
                                            <p class="total"><?php _e('Total:', 'canhcamtheme'); ?> <strong class="product-total-price"><?php echo $product->get_price_html(); ?></strong></p>
                                        </div>
                                        <div class="product-buttons flex lg:gap-6 gap-base">
                                            <a class="btn btn-primary style-black flex-1" href="<?php the_permalink(); ?>"> 
                                                <span><?php _e('DETAIL', 'canhcamtheme'); ?></span>
                                                <div class="icon"></div>
                                            </a>
                                            <a class="btn btn-primary flex-1 add-to-cart-btn" href="<?php echo esc_url($product->add_to_cart_url()); ?>" data-product-id="<?php echo $product->get_id(); ?>"> 
                                                <span><?php _e('ADD', 'canhcamtheme'); ?></span>
                                                <i class="fa-light fa-cart-shopping-fast text-xl"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                        } else {
                            echo '<div class=""><p class="no-found text-center text-white">No products found</p></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="navigation"> 
                <?php
                // Custom pagination that preserves all query parameters
                global $wp_query;
                
                $big = 999999999; // need an unlikely integer
                
                $pages = paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'type' => 'array',
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ));
                
                if (is_array($pages)) {
                    echo '<ul>';
                    foreach ($pages as $page) {
                        echo '<li>' . $page . '</li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
            
            <!-- Add to Cart Popup Modal -->
            <div id="add-to-cart-modal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3><?php _e('Add to Cart', 'canhcamtheme'); ?></h3>
                        <button type="button" class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="popup-cart-form">
                            <div class="form-group">
                                <label for="popup_user_id"><?php _e('User ID', 'canhcamtheme'); ?> <span class="required" style="color: red;">*</span></label>
                                <input type="text" id="popup_user_id" name="user_id" required 
                                    placeholder="Enter your User ID">
                                <span class="error-message" style="color: #e74c3c; font-size: 12px; display: none;"></span>
                            </div>
                            <div class="form-group">
                                <label for="popup_ingame_name"><?php _e('Ingame Name / Notes', 'canhcamtheme'); ?> <span class="required" style="color: red;">*</span></label>
                                <textarea id="popup_ingame_name" name="ingame_name" required 
                                        placeholder="Enter your Ingame Name or Notes" rows="3"></textarea>
                                <span class="error-message" style="color: #e74c3c; font-size: 12px; display: none;"></span>
                            </div>
                            <div class="form-group">
                                <label for="popup_quantity"><?php _e('Quantity', 'canhcamtheme'); ?></label>
                                <div class="quantity-controls">
                                    <button type="button" class="qty-minus">-</button>
                                    <input type="number" id="popup_quantity" name="quantity" value="1" min="1">
                                    <button type="button" class="qty-plus">+</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary modal-cancel"><?php _e('Cancel', 'canhcamtheme'); ?></button>
                        <button type="button" class="btn btn-primary modal-add-to-cart"><?php _e('Add to Cart', 'canhcamtheme'); ?></button>
                    </div>
                </div>
            </div>
    
        </section>
    
        <?php if(get_field('faqs','option')): ?>
            <section class="page-product-list faqs section-py">
                <div class="container"> 
                    <div class="text-center">
                        <h4 class="heading-1 mb-base"><?php _e('FAQ', 'canhcamtheme'); ?></h4>
                    </div>
                    <div class="wrap-list-faqs wrap-item-toggle">
                        
                        <?php foreach(get_field('faqs','option') as $faq): ?>
                            <div class="item-toggle"> 
                                <div class="title"><?php echo $faq['question']; ?></div>
                                <div class="content format-content" style="display: none;">
                                    <?php echo $faq['answer']; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php } ?>
    
    <section class="page-product-list section-content section-py relative">
        <div class="container text-white">
            <?php if(is_shop()): ?>
                <div class="list-tab-category">
                    <div class="wrap section-scrollTo-active">
                        <ul> 
                            <?php 
                            // Check if we're on a child category page
                            if ($cat->parent > 0) {
                                // If we're on a child category, get sibling categories (same parent)
                                $child_categories = get_terms([
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => false,
                                    'parent' => $cat->parent,
                                    'orderby' => 'menu_order'
                                ]);
                            } else {
                                // If we're on a parent category, get its children
                                $child_categories = get_terms([
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => false,
                                    'parent' => $cat->term_id,
                                    'orderby' => 'menu_order'
                                ]);
                            }
                            
                            foreach($child_categories as $child_cat) : 
                                $thumbnail_id = get_woocommerce_term_meta($child_cat->term_id, 'thumbnail_id', true);
                                $image = wp_get_attachment_url($thumbnail_id);
                                $product_count = $child_cat->count;
                            ?>
                            <li>
                                <a href="<?php echo get_term_link($child_cat); ?>" class="item-category<?php echo ($cat->term_id == $child_cat->term_id) ? ' active' : ''; ?>"> 
                                    <div class="icon"> 
                                        <img class="lozad undefined" data-src="<?php echo $image ? $image : get_template_directory_uri().'/img/13.svg'; ?>" alt="<?php echo $child_cat->name; ?>"/>
                                        <div class="num"><?php echo $product_count; ?></div>
                                    </div>
                                    <p><?php echo $child_cat->name; ?></p>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php
            // Get the current product category
            $queried_object = get_queried_object();
            if ($queried_object instanceof WP_Term && $queried_object->taxonomy === 'product_cat') {
                // Get category description (built-in WordPress functionality)
                $category_description = term_description($queried_object->term_id, 'product_cat');
                if (!empty($category_description)) {
                    echo $category_description;
                }
            }
            ?>

            <?php if(get_field('category_content',$cat)) : ?>
                <?php $category_content = get_field('category_content',$cat); ?>
                <?php $first_content = $category_content['first_content']; ?>
                <?php $repeat_content = $category_content['repeat_content']; ?>
                <?php if($first_content) : ?>
                    <div class="flex flex-col text-white mb-base gap-3">
                        <h2 class="title-40"><?php echo $first_content['title']; ?></h2>
                        <div class="format-content"><?php echo $first_content['content']; ?></div>
                    </div>
                <?php endif; ?>
                <?php if($repeat_content) : ?>
                    <div class="flex flex-col gap-base"> 
                        <?php foreach($repeat_content as $content) : ?>
                            <div class="item-row-content grid md:grid-cols-2 gap-base">
                                <div class="col-img"><a class="img img-ratio ratio:pt-[382_680] rounded-4"><img class="lozad undefined" data-src="<?php echo $content['image']['url']; ?>" alt="<?php echo $content['image']['alt']; ?>"/></a></div>
                                <div class="col-content text-white flex flex-col justify-center">
                                    <div>
                                        <h2 class="title-32 mb-6"><?php echo $content['title']; ?></h2>
                                        <div class="format-content">
                                            <?php echo $content['content']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </section>
<?php } ?>

<?php get_footer(); ?>