<?php
/*
 * Created by Ryan Claude Fox
 * Page is designed to show the students schedule nothing special but to view their schedule.
 */
require 'connection.php';
require  'student.php';
date_default_timezone_set("America/New_York");
session_start();

if(!isset($_SESSION['student'])){

    header("Location:student_login.php");

}

$student = $_SESSION['student'];



?>

<html>

<head>
    <title><?php echo $student->get_username() . "'s Schedule" ?></title>
    <script src = 'jquery-3.2.0.js'> </script>
    <script src = 'menu.js'></script>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <link rel = 'stylesheet' type ='text/css' href = 'menu.css'/>
    <link rel = 'stylesheet' type = 'text/css' href = 'course.css'/>

</head>
<body>
<div id = 'menu'></div>
<h1> <?php echo $student->get_username() . "'s Schedule" ?> </h1>
<h2 style = "color:#ffffff;text-align:center;font-size:28px; "><?php echo date("Y") ?> Schedule</h2>
<?php


$student->show_schedule()

?>

</body>

</html>
