<?php
function cubetech_icon_facts_shortcode($atts)
{
	extract(shortcode_atts(array(
		'group'			=> false,
		'orderby' 		=> 'menu_order',
		'order'			=> 'asc',
		'numberposts'	=> 999,
		'offset'		=> 0,
		'poststatus'	=> 'publish',
	), $atts));
	
	if ( $group == false )
		return "Keine Gruppe angegeben";

	$return .= '<div class="cubetech-icon-facts-container">';

	$args = array(
		'posts_per_page'  	=> 999,
		'numberposts'     	=> $numberposts,
		'offset'          	=> $offset,
		'orderby'         	=> $orderby,
		'order'           	=> $order,
		'post_type'       	=> 'cubetech_icon_facts',
		'post_status'     	=> $poststatus,
		'suppress_filters' 	=> false,
		'tax_query' => array(
		    array(
		        'taxonomy' => 'cubetech_icon_facts_group',
		        'terms' => $group,
		        'field' => 'id',
		    )
		),
	);
		
	$posts = get_posts($args);
	
	$return .= cubetech_icon_facts_content($posts);
		
	return $return;

}

add_shortcode('cubetech-icon-facts', 'cubetech_icon_facts_shortcode');

function cubetech_icon_facts_content($posts) {

	$contentreturn = '';
	
	$i = 0;
	
	foreach ($posts as $post) {

		$post_meta_data = get_post_custom($post->ID);
		$terms = wp_get_post_terms($post->ID, 'cubetech_icon_facts_group');
		$url = $post_meta_data['cubetech_icon_facts_url'][0];
		
		$icon = '';
		if(isset($post_meta_data["cubetech_icon_facts_icon"][0]))
			$icon = '<i class="icon-' . $post_meta_data["cubetech_icon_facts_icon"][0] . '"></i>';
			
		$titleclass = '';
		if($post_meta_data['cubetech_icon_facts_titleclass'][0] != '')
			$titleclass = ' class="' . $post_meta_data['cubetech_icon_facts_titleclass'][0] . '"';
		
		$title = '';
		if($post_meta_data['cubetech_icon_facts_title'][0] != 'checked')
			$title = '<h3' . $titleclass . '>' . __($post->post_title) . '</h3>';
		
		$noslideout = '';
		if($post_meta_data['cubetech_icon_facts_noslideout'][0] == 'checked')
			$noslideout = ' cubetech-icon-facts-noslideout';
		
		$image = get_the_post_thumbnail( $post->ID, 'cubetech-icon-facts-thumb', array('class' => 'cubetech-icon-facts-thumb') );
		
		$imgcontainer = '';
		if($post_meta_data['cubetech_icon_facts_hideicon'][0] != 'checked')
			$imgcontainer = '
			<div class="cubetech-icon-facts-image">
				' . $icon . '
				' . $image . '
			</div>
';

		if(isset($post_meta_data['cubetech_icon_facts_externallink'][0]) && $post_meta_data['cubetech_icon_facts_externallink'][0] != '')
			$link = '<a class="cubetech-icon-facts-button" href="' . $post_meta_data['cubetech_icon_facts_externallink'][0] . '" target="_blank">' . __('Mehr', 'cubetech-icon-facts') . '</a>';
		elseif ( $post_meta_data['cubetech_icon_facts_links'][0] != '' && $post_meta_data['cubetech_icon_facts_links'][0] != 'nope' && $post_meta_data['cubetech_icon_facts_links'][0] > 0 )
			$link = '<a class="cubetech-icon-facts-button" href="' . get_permalink( $post_meta_data['cubetech_icon_facts_links'][0] ) . '">' . __('Mehr', 'cubetech-icon-facts') . '</a>';
		else
			$link = '<a class="cubetech-icon-facts-button cubetech-icon-facts-button-slide" href="#"><span class="more">' . __('Mehr', 'cubetech-icon-facts') . '</span><span class="less">' . __('Weniger', 'cubetech-icon-facts') . '</span></a>';
		
		$contentreturn .= '
		<div class="cubetech-icon-facts">
			' . $imgcontainer . '
			<div class="cubetech-icon-facts-title">
				' . $title . '
			</div>
			<div class="cubetech-icon-facts-content' . $noslideout . '">' . __(nl2br($post->post_content)) . '</div>
			<div class="cubetech-icon-facts-link' . $noslideout . '">
				' . $link . '
			</div>
		</div>';
		
		$i++;

	}
	
	return $contentreturn . '</div>';
	
}
?>
