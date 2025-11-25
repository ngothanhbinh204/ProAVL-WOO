<?php
class CanhCam_Header_Walker extends Walker_Nav_Menu {}

function canhcam_header_menu($theme_location) {
    $locations = get_nav_menu_locations();
    if (!isset($locations[$theme_location])) {
        return;
    }
    
    $menu_id = $locations[$theme_location];
    $menu_items = wp_get_nav_menu_items($menu_id);
    
    if (!is_array($menu_items) || empty($menu_items)) {
        return;
    }
    
    // Gán các class ngữ cảnh (như current-menu-item), kiểm tra kết quả trả về
    $processed_items = _wp_menu_item_classes_by_context($menu_items); 
    if (is_array($processed_items)) {
        $menu_items = $processed_items;
    }
    
    // Build tree
    $menu_tree = array();
    $menu_items_by_id = array();
    
    // Dòng 24: Luôn an toàn vì đã kiểm tra is_array() ở trên
    foreach ($menu_items as $item) {
        $item->classes = apply_filters('nav_menu_css_class', (array)$item->classes, $item, new stdClass(), 0);
        $item->children = array();
        $menu_items_by_id[$item->ID] = $item;
    }
    
    // Dòng 32: Luôn an toàn
    foreach ($menu_items as $item) {
        if ($item->menu_item_parent && isset($menu_items_by_id[$item->menu_item_parent])) {
            $menu_items_by_id[$item->menu_item_parent]->children[] = $item;
        } else {
            $menu_tree[] = $item;
        }
    }
    
    echo '<ul>';
    foreach ($menu_tree as $item) {
        $has_children = !empty($item->children);
        $class_names = join(' ', $item->classes);
        
        if ($has_children && !in_array('menu-item-has-children', $item->classes)) {
            $class_names .= ' menu-item-has-children';
        }
        
        echo '<li class="' . esc_attr($class_names) . '">';
        echo '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        
        if ($has_children) {
            echo '<div class="dropdown-product-list" data-toggle="tabslet-hover">';
            
            echo '<ul class="tabslet-tab">';
            foreach ($item->children as $index => $child) {
                $child_class_names = join(' ', $child->classes);
                $tab_id = 'tab-' . $child->ID;
                $active_class = (in_array('current-menu-item', $child->classes) || in_array('current-page-ancestor', $child->classes)) ? ' active' : '';
                
                echo '<li class="' . esc_attr($child_class_names . $active_class) . '"><a href="#' . $tab_id . '">' . esc_html($child->title) . '</a></li>';
            }
            echo '</ul>';
            
            foreach ($item->children as $index => $child) {
                $tab_id = 'tab-' . $child->ID;
                $active_style = (in_array('current-menu-item', $child->classes) || in_array('current-page-ancestor', $child->classes)) ? '' : ' style="display: none;"';
                
                echo '<ul class="tabslet-content" id="' . $tab_id . '"' . $active_style . '>';
                if (!empty($child->children)) {
                    foreach ($child->children as $grandchild) {
                        $grandchild_class_names = join(' ', $grandchild->classes);
                        echo '<li class="' . esc_attr($grandchild_class_names) . '"><a href="' . esc_url($grandchild->url) . '">' . esc_html($grandchild->title) . '</a></li>';
                    }
                }
                echo '</ul>';
            }
            
            echo '</div>';
        }
        
        echo '</li>';
    }
    echo '</ul>';
}

function canhcam_mobile_menu($theme_location) {
    $locations = get_nav_menu_locations();
    if (!isset($locations[$theme_location])) return;
    
    $menu_id = $locations[$theme_location];
    $menu_items = wp_get_nav_menu_items($menu_id);
    
    if (!$menu_items) return;
    
    // Gắn các class ngữ cảnh
    $menu_items = _wp_menu_item_classes_by_context($menu_items); 
    
    // Build tree
    $menu_tree = array();
    $menu_items_by_id = array();
    
    foreach ($menu_items as $item) {
        $item->classes = apply_filters('nav_menu_css_class', (array)$item->classes, $item, new stdClass(), 0);
        
        $item->children = array();
        $menu_items_by_id[$item->ID] = $item;
    }
    
    foreach ($menu_items as $item) {
        if ($item->menu_item_parent && isset($menu_items_by_id[$item->menu_item_parent])) {
            $menu_items_by_id[$item->menu_item_parent]->children[] = $item;
        } else {
            $menu_tree[] = $item;
        }
    }
    
    echo '<ul class="menu-list wrap-item-toggle">';
    foreach ($menu_tree as $item) {
        $has_children = !empty($item->children);
        
        $class_names = join(' ', $item->classes); 
        
        echo '<li class="item-toggle ' . esc_attr($class_names) . '">';
        echo '<div class="title"> <a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></div>';
        
        if ($has_children) {
            echo '<ul>';
            foreach ($item->children as $child) {
                $child_class_names = join(' ', $child->classes); 
                echo '<li class="' . esc_attr($child_class_names) . '"> <a href="' . esc_url($child->url) . '">' . esc_html($child->title) . '</a></li>';
            }
            echo '</ul>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
?>