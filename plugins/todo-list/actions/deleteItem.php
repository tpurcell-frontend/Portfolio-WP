<?php 
    /**
    * Delete an item from the database.
    *
    * @global wpdb $wpdb WordPress database abstraction object.
    * 
    */

    // Mysqli approach
    // $deleteItem = $_POST['deleteItem'];

    // foreach ($_POST['deleteItem'] as $key => $value) { 

    //     //Call Database
    //     require(__DIR__ . '/db.php');

    //     //Prepare and bind
    //     $table_name = 'wp_tasks';
    //     $stmt = $conn->prepare("DELETE FROM $table_name WHERE ID = ?");
    //     $stmt->bind_param("s", $value);

    //     //Execute
    //     $stmt->execute();

    //     //Close
    //     $stmt->close();
    //     $conn->close();
    // }

    // WordPress approach
    add_action('wp_ajax_delete_task', 'todo_list_delete_task');
    add_action('wp_ajax_nopriv_delete_task', 'todo_list_delete_task');

    function todo_list_delete_task() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'tasks';

        if (!empty($_POST['id'])) {
            $task_id = intval($_POST['id']);
            $deleted = $wpdb->delete(
                $table_name, 
                ['ID' => $task_id], 
                ['%d']
            );
            
            if ($deleted !== false) {
                wp_send_json_success('Task deleted successfully.');
            } else {
                wp_send_json_error('Could not delete task. Maybe it does not exist.');
            }
        } else {
            wp_send_json_error('No task ID provided.');
        }

        wp_die(); 
    }
?>