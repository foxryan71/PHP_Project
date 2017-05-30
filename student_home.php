<?php
	    /*
     * Created by Ryan Claude Fox
     * Student home page that show information about the student enrollment center and has a menu where the user can
     * navigate to multiple pages.
     */
    require 'student.php';
     session_start();
    if(!isset($_SESSION['id'])){

        header("Location:student_login.php");
    }
    $student = new student($_SESSION['firstname'],$_SESSION['lastname'],$_SESSION['username'],$_SESSION['id'],$_SESSION['email']);

    $_SESSION['student'] = $student;

     date_default_timezone_set("America/New_York");
 
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo$student->get_username();?>'s Home Page</title>
    <script src = 'jquery-3.2.0.js'> </script>
    <script src = 'menu.js'></script>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <link rel = 'stylesheet' type ='text/css' href = 'menu.css'/>
</head>
<body>
<div id = "menu"></div>
<h1>Welcome <?php echo $student->get_username();?>! <span style = "font-size:32px;float:right; margin-right:100px;"><?php echo date("M/d/Y")?> </span></h1>

<div class = 'info_div'>
    <h2> Information!</h2>
    <p> Welcome to Student Enrollment center! This web application is design for you to be able to view you're current schedule, sign up for courses,
        and drop courses. Courses that are displayed are the course that are being offered for the upcoming fall session of 2017! To get started please click on the
        "Sign up for Course" tab to get started. When signing up for a course please enter in the crn and date correctly. If you fail to do so you will not
        successfully enroll in the course.
    </p>

</div>

</body>

</html>
