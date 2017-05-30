<?php
/*
 * Create by Ryan Claude Fox
 * This page is designed to give feed back to the user that a new temporary password has been sent
 * to their email. Also when this page is loaded it does all the password work.
 * This page when loaded will send a the temporary password to the email session,
 * regarding the session username.
 */
require 'connection.php';

    session_start();

    if(!isset($_SESSION['email']) || !isset($_SESSION['username'])){

        header("Location:");
    }
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];

?>
<?php
send_tempPass($email);
//sends email to user giving them a temporary password.
function send_tempPass($email){


    $temp_pass = generate_temp_pass();
    $insert_to_db_pass = md5($temp_pass);
    $username = $_SESSION['username'];
    $email = htmlspecialchars($email);
    
    change_to_temp($insert_to_db_pass,$_SESSION['email'],$username);
    $to = $_SESSION['email'];

    $subject = "Temporary Password";

    //message to the user!
    $message = "
    <html>
    <body style='background: #3B653D;'>
        <div>
            <h1 style = 'color:#ffffff; font-size:32px; text-align: center;'> Here is your account temporary password info $email !<br></h1>
            
            <span style = 'color:#ffffff;' font-size:20px;'> Temporary Password: $temp_pass </span><br>
            <span><a style = 'color:#ffffff;' href =http://farvlu.farmingdale.edu/~foxrc/BCS350_Project/change_password_link.php> Click here to change password </a> </span>
        
        </div>
    </body>
    </html>";
    $headers = "MIME-Version: 1.0" . PHP_EOL;
    $headers .= "Content-type:text/html;charset=UTF-8" . PHP_EOL;
    $headers .= "From: foxryan71@yahoo.com". PHP_EOL;
    mail($to,$subject,$message,$headers);

}

//generates a temporary password for the user.
function generate_temp_pass(){

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function change_to_temp($temp_pass,$email,$username){

	$query = "Update student set password = '$temp_pass' where email = '$email'and username = '$username'";
    if(mysqli_query($GLOBALS['conn'],$query)){

        return;
    }else{
        echo mysqli_error();
    }


}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Temporary Password Was Sent!</title>
    <link rel = 'stylesheet' type="text/css" href = 'form_page_layout.css'/>
    <link rel = 'stylesheet' type ='text/css' href='//fonts.googleapis.com/css?family=Schoolbell'/>

</head>
<body>
    <h2 style = 'color:#ffffff; text-align: center;'>Student Enrollment Center!</h2>
    <p style = 'color:#ffffff; text-align: center;'>A temporary password has been sent to <?php echo "$email" ?></p>
    <p style ='color:#ffffff; text-align: center;'><a style ='color:#ffffff;' href ='http://farvlu.farmingdale.edu/~foxrc/BCS350_Project/student_login.php'>Retrun to login page </a></p>
</body>
</html>
<?php
session_unset();
session_destroy();
?>
