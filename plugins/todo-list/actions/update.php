<?php 

    $update = $_POST['update'];
    $id = $_POST['updateID'];
    $count = count($update);

    if(isset($_POST['update'])) {

        for ($x = 0; $x < $count; $x++){

            //Call Database
            require(__DIR__ . '/db.php');

            //Prepare and bind
            $table_name = 'wp_tasks';
            $stmt = $conn->prepare("UPDATE $table_name SET item = ? WHERE ID = ?");
            $stmt->bind_param("si", $update[$x], $id[$x]);

            //Execute
            $stmt->execute();

            //Close
            $stmt->close();
            $conn->close();
        }
    }

?>