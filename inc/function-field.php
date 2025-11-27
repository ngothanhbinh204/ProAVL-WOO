<?php
// Custom field class for page
function add_field_custom_class_body()
{
	acf_add_local_field_group(array(
		'key' => 'class_body',
		'title' => 'Body: Add Class',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
	));
	acf_add_local_field(array(
		'key' => 'add_class_body',
		'label' => 'Add class body',
		'name' => 'Add class body',
		'type' => 'text',
		'parent' => 'class_body',
	));
}
add_action('acf/init', 'add_field_custom_class_body');
function add_field_select_banner()
{
	acf_add_local_field_group(array(
		'key' => 'select_banner',
		'title' => 'Banner: Select Page',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'case-study-category'
				)
			)
			// Thêm taxonomy ở dưới
			// array(
			// 	array(
			// 		'param' => 'taxonomy',
			// 		'operator' => '==',
			// 		'value' => 'danh-muc-san-pham'
			// 	)
			// )
		),
	));
	acf_add_local_field(array(
		'key' => 'banner_select_page',
		'label' => 'Chọn banner hiển thị',
		'name' => 'Chọn banner hiển thị',
		'type' => 'post_object',
		'post_type' => 'banner',
		'multiple' => 1,
		'parent' => 'select_banner',
	));
}
add_action('acf/init', 'add_field_select_banner');
function add_theme_config_options()
{
	// Add the field group
	acf_add_local_field_group(array(
		'key' => 'group_theme_config',
		'title' => 'Theme Configuration',
		'fields' => array(
			array(
				'key' => 'tab_config',
				'label' => 'Config',
				'name' => 'tab_config',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_config_head',
				'label' => 'Config Head',
				'name' => 'config_head',
				'type' => 'textarea',
				'instructions' => 'Add custom code for header (CSS, meta tags, etc)',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => '',
			),
			array(
				'key' => 'field_config_body',
				'label' => 'Config Body',
				'name' => 'config_body',
				'type' => 'textarea',
				'instructions' => 'Add custom code for body (JS, tracking code, etc)',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => '',
			),
			array(
				'key' => 'tab_footer',
				'label' => 'Footer',
				'name' => 'tab_footer',
				'type' => 'tab',
				'placement' => 'top',
			),
			array(
				'key' => 'field_footer_logo',
				'label' => 'Footer Logo',
				'name' => 'footer_logo',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array(
				'key' => 'field_footer_blocks',
				'label' => 'Footer Content Blocks',
				'name' => 'footer_blocks',
				'type' => 'repeater',
				'layout' => 'block',
				'button_label' => 'Add Block',
				'sub_fields' => array(
					array(
						'key' => 'field_block_type',
						'label' => 'Block Type',
						'name' => 'type',
						'type' => 'select',
						'choices' => array(
							'list' => 'Standard List',
							'actions' => 'Contact Actions (Phone/Email)',
						),
						'default_value' => 'list',
					),
					array(
						'key' => 'field_block_title',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_block_type',
									'operator' => '==',
									'value' => 'list',
								),
							),
						),
					),
					array(
						'key' => 'field_block_items',
						'label' => 'Items',
						'name' => 'items',
						'type' => 'repeater',
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_block_type',
									'operator' => '==',
									'value' => 'list',
								),
							),
						),
						'sub_fields' => array(
							array(
								'key' => 'field_item_content',
								'label' => 'Content',
								'name' => 'content',
								'type' => 'wysiwyg',
								'tabs' => 'all',
								'toolbar' => 'basic',
								'media_upload' => 0,
								'delay' => 1,
							),
						),
					),
					array(
						'key' => 'field_action_phone',
						'label' => 'Phone',
						'name' => 'phone',
						'type' => 'text',
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_block_type',
									'operator' => '==',
									'value' => 'actions',
								),
							),
						),
					),
					array(
						'key' => 'field_action_email',
						'label' => 'Email',
						'name' => 'email',
						'type' => 'text',
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_block_type',
									'operator' => '==',
									'value' => 'actions',
								),
							),
						),
					),
				),
			),
			array(
				'key' => 'field_footer_socials',
				'label' => 'Social Networks',
				'name' => 'footer_socials',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Social',
				'sub_fields' => array(
					array(
						'key' => 'field_social_icon',
						'label' => 'Icon Class (FontAwesome)',
						'name' => 'icon_class',
						'type' => 'text',
						'placeholder' => 'fa-brands fa-facebook-f',
					),
					array(
						'key' => 'field_social_link',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'url',
					),
				),
			),
			array(
				'key' => 'field_footer_copyright',
				'label' => 'Copyright Text',
				'name' => 'footer_copyright',
				'type' => 'text',
			),
			array(
				'key' => 'field_footer_bct',
				'label' => 'Bộ Công Thương Image',
				'name' => 'footer_bct',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-settings',
				),
			),
		),
		'menu_order' => 10,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));
}
add_action('acf/init', 'add_theme_config_options');