<?php
function cubetech_icon_facts_create_taxonomy() {

	$labels = array(
		'name'                => __( 'Factsgruppen'),
		'singular_name'       => __( 'Factsgruppe' ),
		'search_items'        => __( 'Gruppen durchsuchen' ),
		'all_items'           => __( 'Alle Factsgruppen' ),
		'edit_item'           => __( 'Factsgruppe bearbeiten' ), 
		'update_item'         => __( 'Factsgruppe aktualisiseren' ),
		'add_new_item'        => __( 'Neue Factsgruppe hinzufügen' ),
		'new_item_name'       => __( 'Gruppenname' ),
		'menu_name'           => __( 'Factsgruppe' )
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