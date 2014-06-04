<?php
/**
 * Plugin Name: cubetech Icon Facts
 * Plugin URI: http://www.cubetech.ch
 * Description: cubetech Icon Facts - create some icon facts, reusable within groups and shorttags
 * Version: 1.1
 * Author: cubetech GmbH
 * Author URI: http://www.cubetech.ch
 * Text Domain: cubetech-icon-facts
 * Domain Path: /lang
 */

include_once('lib/cubetech-group.php');
include_once('lib/cubetech-metabox.php');
include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-shortcode.php');

add_image_size( 'cubetech-icon-facts-thumb', 145, 145 );

wp_enqueue_script('jquery');
wp_register_script('cubetech_icon_facts_js', plugins_url('assets/js/cubetech-icon-facts.js', __FILE__), array('jquery','wpdialogs'));
wp_enqueue_script('cubetech_icon_facts_js');

add_action('wp_enqueue_scripts', 'cubetech_icon_facts_add_styles');

function cubetech_icon_facts_add_styles() {
	wp_register_style('cubetech-icon-facts-css', plugins_url('assets/css/cubetech-icon-facts.css', __FILE__) );
	wp_register_style('cubetech-icon-facts-font-awesome', plugins_url('assets/fonts/font-awesome/css/font-awesome.min.css', __FILE__) );
	wp_enqueue_style('cubetech-icon-facts-css');
	wp_enqueue_style('cubetech-icon-facts-font-awesome');
}

/* Add button to TinyMCE */
function cubetech_icon_facts_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_icon_facts_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_icon_facts_button');
		add_action( 'admin_footer', 'cubetech_icon_facts_dialog' );
	}
}
if(!function_exists('enqueue_css'))
{
	function enqueue_css()
	{
		wp_register_style('custom_jquery-ui-dialog', plugins_url('assets/css/jquery-ui-dialog.min.css', __FILE__) );
		wp_enqueue_style('custom_jquery-ui-dialog');
	}
	add_action( 'admin_enqueue_scripts', 'enqueue_css' );
} 


function register_cubetech_icon_facts_button($buttons) {
   array_push($buttons, "|", "cubetech_icon_facts_button");
   return $buttons;
}
 
function add_cubetech_icon_facts_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_icon_facts'] = plugins_url('assets/js/cubetech-icon-facts-tinymce.js', __FILE__);
	return $plugin_array;
}

add_action('init', 'cubetech_icon_facts_addbuttons');

function cubetech_icon_facts_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_icon_facts_group', $args);

	?>
	<style type="text/css">
		#cubetech_icon_facts_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_icon_facts_dialog">
		<div>
			<p>Wählen Sie bitte die einzufügende Facts-Gruppe:</p>
			<p><select name="taxonomy" id="taxonomy">
				<option value="">Bitte Gruppe auswählen</option>
				<?php
				foreach($taxonomies as $tax) :
					echo '<option value="' . $tax->term_id . '">' . $tax->name . '</option>';
				endforeach;
				?>
			</select></p>
		</div>
		<div>
			<p><input type="submit" class="button-primary" value="Facts einfügen" onClick="if ( taxonomy.value > 0 ) { tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-icon-facts group=' + taxonomy.value + ']'); tinyMCEPopup.close(); }" /></p>
		</div>
	</div>
	<?php
}

function cubetech_icon_facts_language_init() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'cubetech-icon-facts', false, $plugin_dir . '/lang/' );
}
add_action('plugins_loaded', 'cubetech_icon_facts_language_init');

?>
