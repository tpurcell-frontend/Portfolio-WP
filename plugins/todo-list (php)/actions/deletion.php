<?php 

    //Call Database
    require(__DIR__ . '/db.php');

    //Prepare and bind
    $table_name = 'wp_tasks';
    $stmt = $conn->prepare("TRUNCATE TABLE $table_name");

    //Execute
    $stmt->execute();

    //Close
    $stmt->close();
    $conn->close();
?>