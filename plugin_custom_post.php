<?php
// custom post type & custom fields
function create_todo_custom_post_type() {
    // creamos nuevo post type
    register_post_type( $GLOBALS["CUSTOM_POST_TYPE"],
        array(
          'labels' => array(
            'name' => __( $GLOBALS["CUSTOM_POST_TYPE_NAME"] ),
            'singular_name' => __( $GLOBALS["CUSTOM_POST_TYPE_NAME_SINGLE"] )
          ),
          'public' => true,
          'hierarchical' => false,
          'query_var' => true,
          'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
        )
    );

}

function todo_metaboxes( ) {
   global $wp_meta_boxes;
   add_meta_box('postfunctiondiv', __($GLOBALS["METABOXES_COMPLETADO"]), 'todo_metaboxes_html', $GLOBALS["CUSTOM_POST_TYPE"], 'normal', 'high');
}

function todo_metaboxes_html() {
    global $post;
    $custom = get_post_custom($post->ID);
    $function = isset($custom["completado"][0])?$custom["completado"][0]:'';
    ?>
        <label>Completado (si/no):</label><input name="completado" value="<?php echo $function; ?>">
    <?php
}

function todo_save_post() {
    if(empty($_POST)) return; 
    global $post;
    if (isset($post)) {
        update_post_meta($post->ID, "completado", $_POST["completado"]);
    }
    
} 

// custom post type hook
add_action( 'init', 'create_todo_custom_post_type' );

// metabox hook
add_action( 'add_meta_boxes_todo', 'todo_metaboxes' );
add_action( 'save_post_todo', 'todo_save_post' );

?>