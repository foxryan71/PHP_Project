<?php
/*
 * Created by Ryan Claude Fox
 * script will allow users to see their schedule and enter in a course crn they would like to drop.
 */

require 'student.php';
session_start();

if(!isset($_SESSION['student'])){
    header("Location:student_login.php");
}

$student = $_SESSION['student'];




?>

<html>

<head>
    <title>Drop a course!</title>
    <script src = 'jquery-3.2.0.js'> </script>
    <script src = 'menu.js'></script>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <link rel = 'stylesheet' type ='text/css' href = 'menu.css'/>
    <link rel = 'stylesheet' type = 'text/css' href = 'course.css'/>
</head>

<body>
<div id = 'menu'></div>
<h1 style="text-align: center;">Drop a Course!</h1>
<?php $student->show_drop_course_table()?>
</body>

</html>
