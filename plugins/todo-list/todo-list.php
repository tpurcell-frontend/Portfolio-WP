<?php
/**
 * Plugin Name: ToDo List
 * Description: A React-based Gutenberg block that renders a dynamic To-Do list with stored values.
 * Version: 1.0
 * Author: Travis Purcell
 */

// Only allow php execution in WordPress.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register custom intro patterns.
 */
function to_do_register_patterns() {
    if ( function_exists( 'register_block_pattern' ) ) {

        // Register the category.
        register_block_pattern_category(
            'to-do',
            array(
                'label'       => _x( 'To-Do patterns', 'Block pattern category', 'to-do' ),
                'description' => __( 'Patterns for the To-Do components.', 'to-do' ),
            )
        );

        // Register intro section the pattern.
        register_block_pattern(
            'intro-section/intro-section', 
            array(
                'title'       => __( 'To-Do Intro Section', 'intro-section' ),
                'description' => __( 'An intro section for the To-Do block.', 'intro-section' ),
                'categories'  => array( 'to-do' ),
                'content'     => file_get_contents( plugin_dir_path(__FILE__) . '/patterns/intro-section.php' ) 
            ),
        );

        // Register the summary section pattern.
        register_block_pattern(
            'summary-section/summary-section', 
            array(
                'title'       => __( 'To-Do Summary Section', 'summary-section' ),
                'description' => __( 'A summary section for the To-Do block.', 'summary-section' ),
                'categories'  => array( 'to-do' ),
                'content'     => file_get_contents( plugin_dir_path(__FILE__) . '/patterns/summary-section.php' ) 
            ),
        );
    }
}
add_action( 'init', 'to_do_register_patterns' );

/**
 * Enqueue block assets for editor.
 */
function todo_list_register_block() {
    // Register the todo-block script.
    wp_register_script(
        'todo-list-block',
        plugin_dir_url(__FILE__) . 'blocks/todo-block/index.js',
        ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components'],
        filemtime(plugin_dir_path(__FILE__) . 'blocks/todo-block/index.js'),
        true
    );

    // Enqueue the Block Editor styles
    wp_register_style(
        'todo-list-editor',
        plugin_dir_url(__FILE__) . 'blocks/todo-block/editor.css',
        [],
        filemtime(plugin_dir_path(__FILE__) . 'blocks/todo-block/editor.css')
    );

    // Enqueue the Todo list styles.
    wp_register_style(
        'todo-list-style',
        plugin_dir_url(__FILE__) . 'css/todo.css',
        [],
        filemtime(plugin_dir_path(__FILE__) . 'css/todo.css')
    );

    // Register the Todo List block, return the React root id "todo-list-root".
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

/**
 * Hook into the wp_enqueue_scripts hook to render the React jsx output compiled in build/index.js.
 */
function todo_react_init_script() {
    wp_enqueue_script(
        'todo-list',
        plugins_url('build/index.js', __FILE__),
        ['wp-element','wp-components'],
        filemtime(plugin_dir_path(__FILE__) . 'build/index.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'todo_react_init_script');
