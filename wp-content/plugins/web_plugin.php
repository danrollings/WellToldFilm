<?php
/**
 * @package Web link plugin
 * @version 1.0
 */
/*
Plugin Name: Web link plugin
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This is a plugin to allow users to link to webs from YouTube or Vimeo
Author: Dan Rollings
Version: 1.0
Author URI: http://weltoldfilm.com
*/
/**
 * Plugin setup
 * Register web post type
 */

function web_setup() {
	$labels = array(
		'name' => __( 'Web', 'web_url_plugin' ),
		'singular_name' => __( 'Web', 'web_url_plugin' ),
		'add_new_item' => __( 'Add New Web', 'web_url_plugin' ),
		'edit_item' => __( 'Edit Web', 'web_url_plugin' ),
		'new_item' => __( 'New Web', 'web_url_plugin' ),
		'not_found' => __( 'No Web found', 'web_url_plugin' ),
		'all_items' => __( 'All Webs', 'web_url_plugin' )
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'map_meta_cap' => true,
		'menu_icon' => 'dashicons-laptop',		
		'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
		'taxonomies' => array( 'web' )
	);
	register_post_type( 'web', $args );
}
add_action( 'init', 'web_setup' );
/**
 * Register taxonomies
 */
function web_register_taxonomies(){
	$labels = array(
		'name' => __( 'Tags', 'web_example_plugin' ),
		'label' => __( 'Tags', 'web_example_plugin' ),
		'add_new_item' => __( 'Add New Web Family', 'web_example_plugin' ),
	);
	$args = array(
		'labels' => $labels,
		'label' => __( 'Family', 'web_example_plugin' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'web-family', array( 'web' ), $args );
}
add_action( 'init', 'web_register_taxonomies' );


/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */

function web_add_meta_boxes($post){
	add_meta_box('web_meta_box', __('Web URL', 'web_link_plugin'), 'web_build_meta_box', 'web', 'side', 'low');

}

add_action('add_meta_boxes_web', 'web_add_meta_boxes');


/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function web_build_meta_box($post){
	wp_nonce_field( basename( __FILE__ ), 'web_meta_box_nonce' );

	// retrieve the _web_url current value
	$current_weburl = get_post_meta( $post->ID, '_web_url', true );
	?>
	<div class='web wrapper'>
		<h3><?php _e( 'Web Url', 'web_link_plugin' ); ?></h3>
			<p>
				<input type="text" name="web" value="<?php echo $current_weburl; ?>" /> 
			</p>
		</div>
	
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function web_save_meta_boxes_data( $post_id ){
	
	// verify meta box nonce
	if ( !isset( $_POST['web_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['web_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}

	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	// store custom fields values
	// web string
	if ( isset( $_REQUEST['web'] ) ) {
		update_post_meta( $post_id, '_web_url', sanitize_text_field( $_POST['web'] ) );
	}



}
add_action( 'save_post_web', 'web_save_meta_boxes_data');
