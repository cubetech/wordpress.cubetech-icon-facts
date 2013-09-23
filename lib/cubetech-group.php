<?php
function cubetech_icon_facts_create_taxonomy() {

	$labels = array(
		'name'                => __( 'Factsgruppen', 'cubetech-icon-facts'),
		'singular_name'       => __( 'Factsgruppe', 'cubetech-icon-facts' ),
		'search_items'        => __( 'Gruppen durchsuchen', 'cubetech-icon-facts' ),
		'all_items'           => __( 'Alle Factsgruppen', 'cubetech-icon-facts' ),
		'edit_item'           => __( 'Factsgruppe bearbeiten', 'cubetech-icon-facts' ), 
		'update_item'         => __( 'Factsgruppe aktualisiseren', 'cubetech-icon-facts' ),
		'add_new_item'        => __( 'Neue Factsgruppe hinzufügen', 'cubetech-icon-facts' ),
		'new_item_name'       => __( 'Gruppenname', 'cubetech-icon-facts' ),
		'menu_name'           => __( 'Factsgruppe', 'cubetech-icon-facts' )
	);

	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'cubetech_icon_facts' ),
		'sortable'			  => true,
		'sort'				  => true,
	);

	register_taxonomy( 'cubetech_icon_facts_group', array( 'cubetech_icon_facts' ), $args );
	flush_rewrite_rules();
}

add_action('init', 'cubetech_icon_facts_create_taxonomy');

?>