<?php
    /*
     * Created by Ryan Claude Fox
     * Script is designed to check both username and emails and sees if they exist.
     */
    
    require "connection.php";
    $error = "";
    session_start();
    function check_email()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            if (empty($_POST['email']) || empty($_POST['username'])) {
                $GLOBALS['error'] = "*Please enter in both email and username";
                return "FAILURE";
            } else {
                $email = $_POST['email'];
                $username = $_POST['username'];
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;
                $query = "SELECT * from student where email = '$email' and username = '$username'";

                $result = mysqli_query($GLOBALS['conn'], $query);

                if (mysqli_num_rows($result) > 0) {
                    return "SUCCESS";
                } else {
                    $GLOBALS['error'] = "*E-mail Address does not exist!";
                    return "FAILURE";
                }
            }



        }//end of server request method.
    }
?>
