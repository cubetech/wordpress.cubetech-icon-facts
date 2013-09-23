<?php
function cubetech_icon_facts_create_post_type() {
	register_post_type('cubetech_icon_facts',
		array(
			'labels' => array(
				'name' => __('Icon Facts'),
				'singular_name' => __('Icon Fact'),
				'add_new' => __('Fact hinzufügen'),
				'add_new_item' => __('Neuer Fact hinzufügen'),
				'edit_item' => __('Fact bearbeiten'),
				'new_item' => __('Neuer Fact'),
				'view_item' => __('Fact betrachten'),
				'search_items' => __('Facts durchsuchen'),
				'not_found' => __('Keine Facts gefunden.'),
				'not_found_in_trash' => __('Keine Facts gefunden.')
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
