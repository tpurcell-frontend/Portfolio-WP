<?php 
    /**
     * Inserts an item, with a default status of 0 into the database.
     *
     * @global wpdb $wpdb WordPress database abstraction object.
     * 
     */

    // Mysqli approach
    // $task = $_POST['task'];
    // $status = 0;

    // //Call Database
    // require(__DIR__ . '/db.php');
    
    // //Prepare and bind
    // $table_name = 'wp_tasks';
    // $stmt = $conn->prepare("INSERT INTO $table_name (item, status) VALUES (?, ?)");
    // if(!empty($task)) {
    //     $stmt->bind_param("si", $task, $status);
    // }

    // //Execute
    // $stmt->execute();

    // //Close
    // $stmt->close();
    // $conn->close();

    // WordPress approach
    add_action('wp_ajax_add_task', 'todo_list_add_task');
    add_action('wp_ajax_nopriv_add_task', 'todo_list_add_task'); 

    function todo_list_add_task() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'tasks';
        $task = isset($_POST['task']) ? sanitize_text_field($_POST['task']) : '';
        $status = 0;

        if (!empty($task)) {
            $inserted = $wpdb->insert(
                $table_name,
                array(
                    'item' => $task,
                    'status' => $status,
                ),
                array('%s', '%d')
            );

            if ($inserted === false) {
                wp_send_json_error(array('error' => $wpdb->last_error));
            } else {
                wp_send_json_success(array('id' => $wpdb->insert_id));
            }
        } else {
            wp_send_json_error(array('error' => 'Empty task.'));
        }

        wp_die(); 
    }

?>