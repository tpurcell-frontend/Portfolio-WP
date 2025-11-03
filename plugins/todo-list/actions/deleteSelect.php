<?php 
    
    $deleteSelect = $_POST['deleteSelect'];

    foreach ($_POST['deleteSelect'] as $key => $value) { 

        //Call Database
        require(__DIR__ . '/db.php');

        //Prepare and bind
        $table_name = 'wp_tasks';
        $stmt = $conn->prepare("DELETE FROM $table_name WHERE ID = ?");
        $stmt->bind_param("s", $value);

        //Execute
        $stmt->execute();

        //Close
        $stmt->close();
        $conn->close();
    }
?>