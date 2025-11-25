<?php
function create_custom_post_types() {
    
    $service_labels = array(
        'name'          => 'Services',
        'singular_name' => 'Service',
        'menu_name'     => 'Dịch vụ',
        'add_new'       => 'Thêm Dịch vụ mới',
        'add_new_item'  => 'Thêm Dịch vụ mới',
        'edit_item'     => 'Chỉnh sửa Dịch vụ',
        'all_items'     => 'Tất cả Dịch vụ',
    );
    $service_args = array(
        'labels'        => $service_labels,
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => array('slug' => 'dich-vu'), // Thiết lập slug URL
        'menu_icon'     => 'dashicons-hammer',
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'), // Thêm excerpt
        'taxonomies'    => array('service_category'), // Liên kết với Taxonomy riêng
    );
    register_post_type('service', $service_args);


    // --- 2. Đăng ký Custom Post Type: SOLUTION ---

    $solution_labels = array(
        'name'          => 'Solutions',
        'singular_name' => 'Solution',
        'menu_name'     => 'Giải pháp', 
        'add_new'       => 'Thêm Giải pháp mới',
        'add_new_item'  => 'Thêm Giải pháp mới',
        'edit_item'     => 'Chỉnh sửa Giải pháp',
        'all_items'     => 'Tất cả Giải pháp',
    );
    $solution_args = array(
        'labels'        => $solution_labels,
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => array('slug' => 'giai-phap'),
        'menu_icon'     => 'dashicons-lightbulb',
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'), 
        'taxonomies'    => array('solution_category'), 
    );
    register_post_type('solution', $solution_args);


    // --- 3. Đăng ký Taxonomy: Service Category ---

    $service_cat_labels = array(
        'name'              => 'Danh mục Dịch vụ',
        'singular_name'     => 'Danh mục',
        'search_items'      => 'Tìm kiếm Danh mục',
        'all_items'         => 'Tất cả Danh mục',
        'parent_item'       => 'Danh mục cha',
        'parent_item_colon' => 'Danh mục cha:',
    );
    $service_cat_args = array(
        'hierarchical'      => true, // Giống như Category (có cấp cha/con)
        'labels'            => $service_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'danh-muc-dich-vu'),
    );
    register_taxonomy('service_category', array('service'), $service_cat_args);


    // --- 4. Đăng ký Taxonomy: Solution Category ---
    
    $solution_cat_labels = array(
        'name'              => 'Danh mục Giải pháp',
        'singular_name'     => 'Danh mục',
    );
    $solution_cat_args = array(
        'hierarchical'      => true, 
        'labels'            => $solution_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'danh-muc-giai-phap'),
    );
    register_taxonomy('solution_category', array('solution'), $solution_cat_args);

    // --- 5. Đăng ký Taxonomy: Product Brand ---
    
    $brand_labels = array(
        'name'              => 'Thương hiệu',
        'singular_name'     => 'Thương hiệu',
        'search_items'      => 'Tìm kiếm Thương hiệu',
        'all_items'         => 'Tất cả Thương hiệu',
        'parent_item'       => 'Thương hiệu cha',
        'parent_item_colon' => 'Thương hiệu cha:',
        'edit_item'         => 'Chỉnh sửa Thương hiệu',
        'update_item'       => 'Cập nhật Thương hiệu',
        'add_new_item'      => 'Thêm Thương hiệu mới',
        'new_item_name'     => 'Tên Thương hiệu mới',
        'menu_name'         => 'Thương hiệu',
    );
    $brand_args = array(
        'hierarchical'      => true, 
        'labels'            => $brand_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'brand'),
    );
    register_taxonomy('product_brand', array('product'), $brand_args);

}
add_action('init', 'create_custom_post_types');

function custom_rewrite_flush() {
    create_custom_post_types();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'custom_rewrite_flush' ); 
?>