<?php 
    //Connect to Database
    // $dbhost = 'localhost';
    // $dbuser = 'root';
    // $dbpass = 'root';
    // $dbname = 'local';

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'root';
    $dbname = 'local';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_errno ) {
        printf("Connect failed: %s<br />", $conn->connect_error);
        exit();
    }
    printf('Connected successfully.<br />');
?>