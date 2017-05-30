<?php
   /*
    *Created by Ryan Claude Fox
    * script deletes the session and unsets it and redirects the user to the home log in page.
    */
    session_start();
    session_unset();
    session_destroy();
    header("Location:student_login.php");
    exit();

?>
