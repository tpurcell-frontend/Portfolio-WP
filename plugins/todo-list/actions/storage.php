<?php 
    $task = $_POST['task'];
    $status = 0;

    //Call Database
    require(__DIR__ . '/db.php');
    
    //Prepare and bind
    $table_name = 'wp_tasks';
    $stmt = $conn->prepare("INSERT INTO $table_name (item, status) VALUES (?, ?)");
    if(!empty($task)) {
        $stmt->bind_param("si", $task, $status);
    }

    //Execute
    $stmt->execute();

    //Close
    $stmt->close();
    $conn->close();
?>
