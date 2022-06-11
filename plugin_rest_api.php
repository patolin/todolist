<?php
	// wp-json

	function todolist_endpoint() {
	    register_rest_route( $GLOBALS["CUSTOM_POST_TYPE"], 'lista', array(
	        'methods'  => WP_REST_Server::READABLE,
	        'callback' => 'get_todolist',
	        'permission_callback' => '__return_true',
	    ) );
	    register_rest_route( $GLOBALS["CUSTOM_POST_TYPE"], 'cambia-estado', array(
	        'methods'  => WP_REST_Server::EDITABLE,
	        'callback' => 'post_todolist_toggle',
	        'permission_callback' => '__return_true',
	    ) );
	    register_rest_route( $GLOBALS["CUSTOM_POST_TYPE"], 'borra', array(
	        'methods'  => WP_REST_Server::EDITABLE,
	        'callback' => 'post_todolist_trash',
	        'permission_callback' => '__return_true',
	    ) );
	    register_rest_route( $GLOBALS["CUSTOM_POST_TYPE"], 'nuevo', array(
	        'methods'  => WP_REST_Server::EDITABLE,
	        'callback' => 'post_todolist_new',
	        'permission_callback' => '__return_true',
	    ) );

	}


	function get_todolist( $request ) {
	    $args  = array(
	        'post_type'  => $GLOBALS["CUSTOM_POST_TYPE"],
	        'meta_key' => 'completado',
	        'meta_query' => array(
	                        'key' => 'completado',
	                        'compare'=> '!=',
	                        'value' => '',
	                   
	                ),
	    );

	    $query = new WP_Query( $args );
	    
	    $arrOut=[];
	    foreach ($query->posts as $post) {
	        $post=(array)$post;
	        $post["completado"]=get_post_meta($post["ID"], 'completado', True);
	        $arrOut[]=$post;
	    }
	    return $arrOut;
	}

	function post_todolist_toggle($request) {

	    $id=$request["post_id"];
	    $estado=get_post_meta($id, "completado", True);
	    $nuevoEstado = $estado=="si" ? "no" : "si";
	    update_post_meta($id, "completado", $nuevoEstado);
	    $response['post_id'] = $id;
	    $response['estado']=$nuevoEstado;
	    return $response;
	}

	function post_todolist_trash($request) {

	    $id=$request["post_id"];

	    $args  = array(
	        'post_type'  => $GLOBALS["CUSTOM_POST_TYPE"],
	        'p' => $id,
	    );
	    $response['post_id'] = $id;
	    $query = new WP_Query( $args );
	    if (count($query->posts)==1) {
	        wp_trash_post($id);
	        $response['estado']="borrado";
	    } else {
	        $response['estado']="error";
	    }
	    $response["data"]=$query->posts;
	    return $response;
	}

	function post_todolist_new($request) {
	    global $wpdb;
	    global $table_prefix;
	    $response=[];
	    $tarea=$request["txtNewTask"];

	    $postName=sanitize_title($tarea);
	    $fechaActual=date('Y-m-d H:i:s');
	    $arrPost=array(
	        'post_date'=>$fechaActual,
	        'post_date_gmt'=>$fechaActual,
	        'post_content'=>'',
	        'post_date'=>$fechaActual,
	        'post_title'=>$tarea,
	        'post_excerpt'=>'',
	        'post_status'=>'publish',
	        'comment_status'=>'closed',
	        'ping_status'=>'closed',
	        'post_password'=>'',
	        'post_name'=>$postName,
	        'post_modified'=>$fechaActual,
	        'post_modified_gmt'=>$fechaActual,
	        'post_parent'=>0,
	        'menu_order'=>0,
	        'post_type'=>$GLOBALS["CUSTOM_POST_TYPE"],
	        'comment_count'=>0


	    );
	    $wpdb->insert( $table_prefix.'posts', $arrPost);
	    $postId=$wpdb->insert_id;

	    if ($postId>0) {
	        add_post_meta($postId, 'completado', 'no');
	        $response['estado']="creado";
	        $response['post_id']=$postId;
	    } else {
	        $response['estado']="error";
	    }
	    return $response;
	}

	add_action( 'rest_api_init', 'todolist_endpoint' );
?>