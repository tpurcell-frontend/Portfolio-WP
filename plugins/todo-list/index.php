<?php
    /**
     * @package Todo
     * @version 1
     */
    /*
    Plugin Name: ToDo List
    Plugin URI: 
    Description: This is a To-Do list. It connects to your SQL database and saves your data.
    Author: Travis Purcell
    Version: 1
    Author URI: ''
    */

    // Write the "Task" table in the database when first activating the plugin
    register_activation_hook(__FILE__, 'todo_list_create_table');

    function todo_list_create_table() {
        global $wpdb;

        // Define table name (with WordPress prefix for safety)
        $table_name = $wpdb->prefix . 'tasks';

        // Character set / collation (matches WP settings)
        $charset_collate = $wpdb->get_charset_collate();

        // SQL to create the table if it doesn’t exist
        $sql = "CREATE TABLE $table_name (
            ID mediumint(9) NOT NULL AUTO_INCREMENT,
            item varchar(255) NOT NULL,
            status tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY  (ID)
        ) $charset_collate;";

        // Include the upgrade library for dbDelta()
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Run the SQL safely (creates or updates structure)
        dbDelta($sql);
    }

    // Database Call
    function todo_list_display() {
        ob_start(); // Capture output so it doesn’t echo immediately
    
        //Generate full URL
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else $link = "http";

        // Here append the common URL characters.
        $link .= "://";

        // Append the host(domain name, ip) to the URL.
        $link .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        $link .= $_SERVER['REQUEST_URI'];
        $link;

        // Call Database
        require plugin_dir_path(__FILE__) . 'actions/db.php';

        // SQL query
        // $query  = "SELECT * FROM Tasks";
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
        $query = "SELECT * FROM $table_name";


        // Fetching data from the database
        $result = mysqli_query($conn, $query);

        // Throw an error if query fails
        if (!$result) {
            die("Database query failed: " . mysqli_error($conn));
        }
    ?>

    <!-- Markup -->
    <section class="outer__wrapper">
        <div class="container-lg"><!--Class Placeholder for Bootstrap installation. Bootstrap not used for demo -->
            <div class="row"><!--Class Placeholder for Bootstrap installation. Bootstrap not used for demo -->
                <div class="col-12"><!--Class Placeholder for Bootstrap installation. Bootstrap not used for demo -->
                    <div class="form__wrapper">
                        <form id="form">
                            
                            <!--Check for submission error -->
                            <?php if (isset($_GET['error'])) : ?> <p class="error"><?php echo $_GET['error']; ?></p> <?php endif; ?>
                            
                            <input class="addEnter" type="text" placeholder="Add new task*" id="task" name="task">
                            <label class="sr" for="task">Add a new task</label>
                            <p class="warning">*Task will not be added if field is left empty.</p>
                            <div class="controls top">
                                <div class="btn__wrapper">
                                    <a tabindex="0" id="add" type="submit" value="Add task" class="add btn slideFromLeft" aria-label="Add task">Add task</a>
                                </div>
                            </div>
                            <h2>Things to Do</h2>

                            <?php //Get Submission time
                                date_default_timezone_set("America/New_York");
                                $submissionTime = new DateTime();
                            ?>

                            <?php //Prepare new CSV file
                                //Get CSV directoy
                                $path = get_template_directory() . '/tasks.csv';

                                //Delete old CSV file
                                if( file_exists( $path ) ){ 
                                    unlink($path);
                                }

                                //Check if file exists
                                if( !file_exists( $path ) ){ 
                                    $fp = fopen($path, 'a');

                                    //Create Header data
                                    $dataHeader = array('Task', 'Created On', 'Status');
                                    fputcsv($fp, $dataHeader);	
                                }
                            ?>
                            
                            <?php //Fetch SQL Data
                                $tasksTotal = 0;

                                if ($result && mysqli_num_rows($result) > 0) {
                                    $tasksTotal = mysqli_num_rows($result);
                                    $uniqueValue = 0;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $uniqueValue++; //Increment ID for each task checkbox 

                                        //Store database data into variable
                                        $id = $row['ID'];
                                        $item = $row['item']; 
                                        $status = $row['status']; ?>
                
                                        <div class="checkbox__wrapper">
                                            <div Class="task__checkbox">
                                                <?php if($status == '1') { ?>
                                                    <input id="complete" class="checked tick" name="complete[]" type="checkbox" value="1" checked>												
                                                <?php } else { ?>
                                                    <input id="complete" class="unchecked tick" name="complete[]" type="checkbox" value="0" checked>												
                                                <?php } ?>
                                                <input type="hidden" name="completeID[]" value="<?php echo $id ?>">
                                                <label class="sr" for="complete"><?php echo $item ?></label>
                                            </div>
                                            <div class="task__name">
                                            <?php if($status == '1') { ?>
                                                <input class="update crossed" name="update[]" placeholder="<?php echo $item ?>" value="<?php echo $item ?>" type="text">
                                            <?php } else { ?>
                                                <input class="update" name="update[]" placeholder="<?php echo $item ?>" value="<?php echo $item ?>" type="text">
                                            <?php } ?>
                                                <input type="hidden" name="updateID[]" value="<?php echo $id ?>">
                                                <label class="sr" for="update"><?php echo $item ?></label>
                                            </div>
                                            <div class="option__wrapper">
                                                <div>
                                                    <input value="<?php echo $id ?>" class="deleteSelect" name="deleteSelect[]" type="radio" tabindex="0">
                                                    <label class="sr" for="deleteSelect">Delete task number <?php echo $id ?></label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php //Create & Write tasks to CSV
                                    
                                    //Open file
                                        $fp = fopen($path, 'a');
                                        if($status == 1) {
                                            $data = array($item, $submissionTime->format('m/d/y'), 'Completed');
                                        } else {
                                            $data = array($item, $submissionTime->format('m/d/y'), 'In Progress');
                                        }

                                        //Write to file
                                        fputcsv($fp, $data);

                                        fclose($fp);
                                    } 
                                } // End SQL Data fetch 
                            ?>
                        
                            <?php //Show Task update & select & first wrapper if tasks are more than 0
                                if ($tasksTotal !== 0) { ?>

                                <div class="controls">
                            <?php } ?> 

                            <?php //Show only Add tasks button if there are no tasks
                                if ($tasksTotal == 0) { ?>
                                    <div class="flex__wrapper controls">
                                    
                                        <div class="btn__wrapper">
                                            <a style="margin-bottom: 0;" tabindex="0" id="add" type="submit" value="Add task" class="btn slideFromLeft" aria-label="Add task">Add task</a>
                                        </div>
                                        <div class="marker">
                                            <p id="tasksRemaining2"></p>
                                        </div>
                                    </div>
                                <?php // Show all buttons if there is at least one task
                                } else { ?>
                                    <div class="btn__wrapper">
                                        <a tabindex="0" id="update" href="#" class="completeUpdate btn slideFromLeft" aria-label="Update tasks">Update tasks</a>
                                        <a tabindex="0" id="clear" href="#" class="btn slideFromLeft" aria-label="Uncheck all">Uncheck all</a>
                                        <a tabindex="0" id="delete" href="#" class="btn slideFromLeft" aria-label="Delete all">Delete all</a>
                                    </div>
                                    <div class="marker">
                                        <p id="tasksRemaining"></p>
                                    </div>
                                </div>
                                <div class="bottom flex__wrapper">
                                    <div class="download__wrapper">
                                        <a download="Current Tasks.csv" id="download" href="<?php echo $link . 'wp-content/themes/todo/tasks.csv' ?>" aria-label="Download tasks">Download CSV</a>
                                    </div>
                                    <div tabindex="0"  id="switch" class="toggle__wrapper tooltip">
                                        <input type="checkbox" class="checkbox">
                                        <span class="tooltiptext">Click to toggle theme color</span>
                                        <label for="switch" class="toggle"></label>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    return ob_get_clean(); // Return the captured markup
}

add_shortcode('todo_list', 'todo_list_display');
