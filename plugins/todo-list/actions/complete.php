<?php 

    $complete = $_POST['complete'];
    $id = $_POST['completeID'];
    $count = count($id);

    for ($x = 0; $x < $count; $x++){
  
        //Call Database
        require(__DIR__ . '/db.php');

        //Prepare and bind
        $table_name = 'wp_tasks';
        $stmt = $conn->prepare("UPDATE $table_name SET status = ? WHERE ID = ?");
        $stmt->bind_param("si", $complete[$x], $id[$x]);

        //Execute
        $stmt->execute();

        //Close
        $stmt->close();
        $conn->close();
    }
?>