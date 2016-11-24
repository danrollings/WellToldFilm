<?php
/**
 * @package Food_example_plugin
 * @version 1.0
 */
/*
Plugin Name: Food example plugin
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This is an example plugin for WPMU DEV readers
Author: Carlo Daniele
Version: 1.0
Author URI: http://carlodaniele.it/en/
*/

/**
 * Plugin setup
 * Register food post type
 */
function food_setup() {
	$labels = array(
		'name' => __( 'Food', 'food_example_plugin' ),
		'singular_name' => __( 'Food', 'food_example_plugin' ),
		'add_new_item' => __( 'Add New Food', 'food_example_plugin' ),
		'edit_item' => __( 'Edit Food', 'food_example_plugin' ),
		'new_item' => __( 'New Food', 'food_example_plugin' ),
		'not_found' => __( 'No Food found', 'food_example_plugin' ),
		'all_items' => __( 'All Food', 'food_example_plugin' )
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'map_meta_cap' => true,
		'menu_icon' => 'dashicons-carrot',		
		'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
		'taxonomies' => array( 'food-family' )
	);
	register_post_type( 'food', $args );
}
add_action( 'init', 'food_setup' );

/**
 * Register taxonomies
 */
function food_register_taxonomies(){

	$labels = array(
		'name' => __( 'Family', 'food_example_plugin' ),
		'label' => __( 'Family', 'food_example_plugin' ),
		'add_new_item' => __( 'Add New Food Family', 'food_example_plugin' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Family', 'food_example_plugin' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'food-family', array( 'food' ), $args );
}
add_action( 'init', 'food_register_taxonomies' );

/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function food_add_meta_boxes( $post ){
	add_meta_box( 'food_meta_box', __( 'Nutrition facts', 'food_example_plugin' ), 'food_build_meta_box', 'food', 'side', 'low' );
}
add_action( 'add_meta_boxes_food', 'food_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function food_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'food_meta_box_nonce' );

	// retrieve the _food_cholesterol current value
	$current_cholesterol = get_post_meta( $post->ID, '_food_cholesterol', true );

	// retrieve the _food_carbohydrates current value
	$current_carbohydrates = get_post_meta( $post->ID, '_food_carbohydrates', true );

	$vitamins = array( 'Vitamin A', 'Thiamin (B1)', 'Riboflavin (B2)', 'Niacin (B3)', 'Pantothenic Acid (B5)', 'Vitamin B6', 'Vitamin B12', 'Vitamin C', 'Vitamin D', 'Vitamin E', 'Vitamin K' );
	
	// stores _food_vitamins array 
	$current_vitamins = ( get_post_meta( $post->ID, '_food_vitamins', true ) ) ? get_post_meta( $post->ID, '_food_vitamins', true ) : array();

	?>
	<div class='inside'>

		<h3><?php _e( 'Cholesterol', 'food_example_plugin' ); ?></h3>
		<p>
			<input type="radio" name="cholesterol" value="0" <?php checked( $current_cholesterol, '0' ); ?> /> Yes<br />
			<input type="radio" name="cholesterol" value="1" <?php checked( $current_cholesterol, '1' ); ?> /> No
		</p>

		<h3><?php _e( 'Carbohydrates', 'food_example_plugin' ); ?></h3>
		<p>
			<input type="text" name="carbohydrates" value="<?php echo $current_carbohydrates; ?>" /> 
		</p>

		<h3><?php _e( 'Vitamins', 'food_example_plugin' ); ?></h3>
		<p>
		<?php
		foreach ( $vitamins as $vitamin ) {
			?>
			<input type="checkbox" name="vitamins[]" value="<?php echo $vitamin; ?>" <?php checked( ( in_array( $vitamin, $current_vitamins ) ) ? $vitamin : '', $vitamin ); ?> /><?php echo $vitamin; ?> <br />
			<?php
		}
		?>
		</p>
	</div>
	<?php
}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function food_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['food_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['food_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// cholesterol string
	if ( isset( $_REQUEST['cholesterol'] ) ) {
		update_post_meta( $post_id, '_food_cholesterol', sanitize_text_field( $_POST['cholesterol'] ) );
	}

	// store custom fields values
	// carbohydrates string
	if ( isset( $_REQUEST['carbohydrates'] ) ) {
		update_post_meta( $post_id, '_food_carbohydrates', sanitize_text_field( $_POST['carbohydrates'] ) );
	}

	// store custom fields values
	// vitamins array
	if( isset( $_POST['vitamins'] ) ){
		$vitamins = (array) $_POST['vitamins'];

		// sinitize array
		$vitamins = array_map( 'sanitize_text_field', $vitamins );

		// save data
		update_post_meta( $post_id, '_food_vitamins', $vitamins );
	}else{
		// delete data
		delete_post_meta( $post_id, '_food_vitamins' );
	}
}
add_action( 'save_post_food', 'food_save_meta_box_data' );