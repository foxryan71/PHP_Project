<?php
    //Created by Ryan Claude Fox
    //connects to the database
    //require in all pages when needed
    $dbhost = '';
    $user = '';
    $pass = '';
    $dbname = '';

    $conn = mysqli_connect($dbhost,$user,$pass,$dbname);

    if(!$conn){
        die("Could not connect" . mysqli_connect_error());

    }

?>
