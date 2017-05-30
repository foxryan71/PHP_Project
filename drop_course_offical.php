<?php
/*
 * Created by Ryan Claude Fox
 * drop_course_offical sends output to user if a course was successfully dropped or not.
 * Output to user will depend on whether or not a course was successfully dropped or not.
 */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    require 'student.php';
    include_once 'connection.php';


    if (!isset($_SESSION['student'])) {
        header("Location:student_login.php");
    }

    $_SESSION['crn'] = $_POST['crn'];
    $student = $_SESSION['student'];
    $id = $_SESSION['id'];
    $crn = $_SESSION['value'];




}

function drop_course($id,$crn){

    if(check_crn($crn) === "SUCCESS") {

        $query = "DELETE FROM enrollment where crn = '$crn' and student = $id ";

        if (mysqli_query($GLOBALS['conn'], $query)) {

            return "SUCCESS";
        }
    }else{
        return "FAILURE";
    }
}//end of drop course
function check_crn($crn){

    $query = "SELECT crn from enrollment where crn = '$crn'";

    $result = mysqli_query($GLOBALS['conn'],$query);

    if(!result)
    {
        echo msqli_error();
    }
    if(mysqli_num_rows($result) > 0){

        return "SUCCESS";
    }else{
        return "FAILURE";
    }
}



?>

<html>
<head>
    <title>Drop Course Success</title>
    <script src = 'jquery-3.2.0.js'> </script>
    <script src = 'menu.js'></script>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <link rel = 'stylesheet' type ='text/css' href = 'menu.css'/>

</head>
<div id ='menu'></div>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(drop_course($id,$_SESSION['crn']) === "SUCCESS"){

            echo"<h1> Successfully dropped " . $_SESSION['crn'] ."</h1>";
            echo"<p> <a href = http://farvlu.farmingdale.edu/~foxrc/BCS350_Project/schedule.php>Click here to go back to your schedule page.</a> </p>";
        }else{
            echo"<h1> The CRN doesn't exist! " . $_SESSION['crn'] ."</h1>";
            echo"<p> <a href = http://farvlu.farmingdale.edu/~foxrc/BCS350_Project/drop_course.php>Click here to go back to drop a course  page.</a> </p>";
        }

    }

?>

</html>
