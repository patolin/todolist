<?php
/*
 * Plugin Name: NewCombin ToDo List plugin example
 * Plugin URI: http://patolin.com/
 * Description: Desafio wordpress de NewCombin.
 * Version: 1.0.0
 * Author: Patricio Reinoso 
 * Author URI: http://patolin.com/
 */

    include('plugin_config.php');
    include('plugin_shortcode.php');
    include('plugin_custom_post.php');
    include('plugin_rest_api.php');

    // plugin header hooks

    function add_css_to_head() {
        echo "<link href='".plugins_url('css/todoplugin.css', __FILE__)."' rel='stylesheet' type='text/css'>";
    }
    function todoPluginScripts() {
        wp_enqueue_script('todoplugin_activation', plugins_url('js/todoplugin.js', __FILE__), array('jquery'), 1.0, true);
        add_action( 'wp_head', 'add_css_to_head' );
        
    }
    add_action('wp_enqueue_scripts', 'todoPluginScripts', 99);

?>