<?php
function cubetech_icon_facts_create_post_type() {
	register_post_type('cubetech_icon_facts',
		array(
			'labels' => array(
				'name' => __('Icon Facts', 'cubetech-icon-facts'),
				'singular_name' => __('Icon Fact', 'cubetech-icon-facts'),
				'add_new' => __('Fact hinzufügen', 'cubetech-icon-facts'),
				'add_new_item' => __('Neuer Fact hinzufügen', 'cubetech-icon-facts'),
				'edit_item' => __('Fact bearbeiten', 'cubetech-icon-facts'),
				'new_item' => __('Neuer Fact', 'cubetech-icon-facts'),
				'view_item' => __('Fact betrachten', 'cubetech-icon-facts'),
				'search_items' => __('Facts durchsuchen', 'cubetech-icon-facts'),
				'not_found' => __('Keine Facts gefunden.', 'cubetech-icon-facts'),
				'not_found_in_trash' => __('Keine Facts gefunden.', 'cubetech-icon-facts')
			),
			'capability_type' => 'post',
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'icon-facts', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'cubetech_icon_facts_create_post_type');
?>
