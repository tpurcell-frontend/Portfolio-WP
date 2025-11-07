<?php
/**
 * Plugin Name: ToDo List
 * Description: A Gutenberg-ready front-end React To-Do list.
 * Version: 1.0
 * Author: Travis Purcell
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Enqueue block assets for editor
function todo_list_register_block() {
    // Register block script
    wp_register_script(
        'todo-list-block',
        plugin_dir_url(__FILE__) . 'blocks/todo-block/index.js',
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components'],
        filemtime(plugin_dir_path(__FILE__) . 'blocks/todo-block/index.js'),
        true
    );

    // Optional editor styles
    wp_register_style(
        'todo-list-editor',
        plugin_dir_url(__FILE__) . 'blocks/todo-block/editor.css',
        [],
        filemtime(plugin_dir_path(__FILE__) . 'blocks/todo-block/editor.css')
    );

    // Front-end styles
    wp_register_style(
        'todo-list-style',
        plugin_dir_url(__FILE__) . 'css/todo.css',
        [],
        filemtime(plugin_dir_path(__FILE__) . 'css/todo.css')
    );

    register_block_type('todo-list/todo', [
        'editor_script' => 'todo-list-block',
        'editor_style'  => 'todo-list-editor',
        'style'         => 'todo-list-style',
        'render_callback' => function() {
            return '<div id="todo-list-root"></div>';
        }
    ]);
}
add_action('init', 'todo_list_register_block');

function todo_list_frontend_script() {
    wp_enqueue_script(
        'todo-list-frontend',
        plugin_dir_url(__FILE__) . 'js/index.js',
        ['wp-element','wp-components'],
        filemtime(plugin_dir_path(__FILE__) . 'js/index.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'todo_list_frontend_script');