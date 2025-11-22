<?php
class CanhCam_Header_Walker extends Walker_Nav_Menu {
    // This walker is designed to handle the specific structure of the CanhCam theme header menu.
    // However, due to the complex "Tabs" structure (separating titles and content into sibling lists),
    // a standard Walker is difficult to use. 
    // We will use a custom function `canhcam_header_menu` to generate the HTML.
}

function canhcam_header_menu($theme_location) {
    $locations = get_nav_menu_locations();
    if (!isset($locations[$theme_location])) {
        return;
    }
    
    $menu_id = $locations[$theme_location];
    $menu_items = wp_get_nav_menu_items($menu_id);
    
    if (!$menu_items) {
        return;
    }
    
    // Build tree
    $menu_tree = array();
    $menu_items_by_id = array();
    
    foreach ($menu_items as $item) {
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
    
    echo '<ul>';
    foreach ($menu_tree as $item) {
        $has_children = !empty($item->children);
        $class_names = join(' ', $item->classes);
        if ($has_children) {
            $class_names .= ' menu-item-has-children';
        }
        
        echo '<li class="' . esc_attr($class_names) . '">';
        echo '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        
        if ($has_children) {
            echo '<div class="dropdown-product-list" data-toggle="tabslet-hover">';
            
            // Tabs List
            echo '<ul class="tabslet-tab">';
            foreach ($item->children as $index => $child) {
                $tab_id = 'tab-' . $child->ID;
                echo '<li><a href="#' . $tab_id . '">' . esc_html($child->title) . '</a></li>';
            }
            echo '</ul>';
            
            // Content List
            foreach ($item->children as $index => $child) {
                $tab_id = 'tab-' . $child->ID;
                echo '<ul class="tabslet-content" id="' . $tab_id . '">';
                if (!empty($child->children)) {
                    foreach ($child->children as $grandchild) {
                        echo '<li><a href="' . esc_url($grandchild->url) . '">' . esc_html($grandchild->title) . '</a></li>';
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
