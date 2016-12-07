<?php
/**
 * @package Video link plugin
 * @version 1.0
 */
/*
Plugin Name: Video link plugin
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This is a plugin to allow users to link to videos from YouTube or Vimeo
Author: Dan Rollings
Version: 1.0
Author URI: http://weltoldfilm.com
*/
/**
 * Plugin setup
 * Register video post type
 */

function video_setup() {
	$labels = array(
		'name' => __( 'Video', 'video_url_plugin' ),
		'singular_name' => __( 'Video', 'video_url_plugin' ),
		'add_new_item' => __( 'Add New Video', 'video_url_plugin' ),
		'edit_item' => __( 'Edit Video', 'video_url_plugin' ),
		'new_item' => __( 'New Video', 'video_url_plugin' ),
		'not_found' => __( 'No Video found', 'video_url_plugin' ),
		'all_items' => __( 'All Videos', 'video_url_plugin' )
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'map_meta_cap' => true,
		'menu_icon' => 'dashicons-video-alt',		
		'supports' => array( 'title', 'editor', 'author', 'tags', '_video_url'),
		'taxonomies' => array( 'video' )
	);
	register_post_type( 'video', $args );
}
add_action( 'init', 'video_setup' );
/**
 * Register taxonomies
 */
function video_register_taxonomies(){
	$labels = array(
		'name' => __( 'Tags', 'video_example_plugin' ),
		'label' => __( 'Tags', 'video_example_plugin' ),
		'add_new_item' => __( 'Add New Video Family', 'video_example_plugin' ),
	);
	$args = array(
		'labels' => $labels,
		'label' => __( 'Family', 'video_example_plugin' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'video-family', array( 'video' ), $args );
}
add_action( 'init', 'video_register_taxonomies' );


/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */

function video_add_meta_boxes($post){
	add_meta_box('video_meta_box', __('Vimeo Video Number', 'video_link_plugin'), 'video_build_meta_box', 'video', 'side', 'low');

}

add_action('add_meta_boxes_video', 'video_add_meta_boxes');


/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function video_build_meta_box($post){
	wp_nonce_field( basename( __FILE__ ), 'video_meta_box_nonce' );

	// retrieve the _video_url current value
	$current_videourl = get_post_meta( $post->ID, '_video_url', true );
	?>
	<div class='video wrapper'>
		<h3><?php _e( 'Vimeo Video Number', 'video_link_plugin' ); ?></h3>
			<p>
				<input type="text" name="video" value="<?php echo $current_videourl; ?>" /> 
			</p>
		</div>
	
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function video_save_meta_boxes_data( $post_id ){
	
	// verify meta box nonce
	if ( !isset( $_POST['video_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['video_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// video string
	if ( isset( $_REQUEST['video'] ) ) {
		update_post_meta( $post_id, '_video_url', sanitize_text_field( $_POST['video'] ) );
	}



}
add_action( 'save_post_video', 'video_save_meta_boxes_data');