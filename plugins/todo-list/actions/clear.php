<?php 

    //Call Database
    require(__DIR__ . '/db.php');

    //Prepare and bind
    $table_name = 'wp_tasks';
    $stmt = $conn->prepare("UPDATE $table_name SET status = ?");
    $value = 0;
    $stmt->bind_param("s", $value);

    //Execute
    $stmt->execute();

    //Close
    $stmt->close();
    $conn->close();
?>