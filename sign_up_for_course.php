<?php
/*
 * Created by Ryan Claude Fox
 * This page is designed to allow users to view all courses and sign up for them.
 * If a crn is incorrectly entered the user will get an error message.
 */

require 'student.php';
session_start();

if(!isset($_SESSION['student'])){
    header("Location:student_login.php");
}

$student = $_SESSION['student'];
$err_array = array();
if($_SERVER['REQUEST_METHOD'] == "POST"){

    if($student->enroll_to_course($_POST['crn'],$_POST['year'],$student->id) === "SUCCESS"){

        header("Location:schedule.php");
    }else{



        if (empty($_POST['crn'])) {

            array_push($err_array, "*You must enter in a crn!");

        } else {

            if (!preg_match("/^[0-9]{5}$/", $_POST['crn'])) {

                array_push($err_array, "*You've entered in an invalid CRN");
            }
        }//end of checking crn
    }


}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Sign up for courses!</title>
    <script src = 'jquery-3.2.0.js'> </script>
    <script src = 'menu.js'></script>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <link rel = 'stylesheet' type ='text/css' href = 'menu.css'/>
    <link rel = 'stylesheet' type = 'text/css' href = 'course.css'/>
    <style>
        input{

            width:25%;
            height:100%;

            font-family:SchoolBell;
            font-size: 16px;
            font-weight:bold;
            color:black;
            background-color: #ffffff;
            border-radius:10px;
            box-shadow: 5px 5px 10px black;
            margin-top:10px;
            outline-color: #ffffff;

        }
    </style>

    <script>
        function showCourse(course){

            if(course === ""){

                document.getElementById("displayCourse").innerHTML ="";
                return;
            }else {
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {

                        document.getElementById("displayCourse").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getCourse.php?c=" + course, true);
                xmlhttp.send();
            }
            }
    </script>
</head>
<body>
<div id = "menu"></div>
<form>
<select name = 'course' onchange ="showCourse(this.value)">
    <option value = "BCS">BCS Courses</option>
    <option value = "MTH">MTH Courses</option>
    <option value = "SPA">SPA Courses</option>
    <option value = "PHY">PHY Courses</option>
    <option value = "ENG">ENG Courses</option>
    <option value="BUS">BUS Courses</option>
    <option value = "ECO">ECO Courses</option>
    <option value = "HIS">HIS Courses</option>
    <option value = "SCI">SCI Courses</option>

</select>
</form>
<div id = "displayCourse"></div>
<?php

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        if(!empty($err_array)) {
            //prints out all errors if there are any!
            echo "<div style= 'margin:auto;width:50%; margin-top:20px;'>";
            foreach ($err_array as $error) {

                echo "<p style='color:#ffffff;font-size:22px; font-weight:bold;text-align: center;'> $error </p>";
            }
            echo "</div>";
        }//end of if err_arry is empty or not.

    }//end of if request method is post

?>

<form style = 'text-align: center' method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>'>
    <span style =  'color:#ffffff; font-size: 22px;'>Please enter in the CRN and Year(YYYY-MM-DD) of the course you would like to enroll in!</span><br/>
    <input  type = 'text' name = 'crn' placeholder="CRN" /><br/>
    <select style = 'width:25%;' name ='year'>
        <option value ='2017-08-21'>2017-08-21</option>
    </select><br>
    <input type = 'submit' name ='submit' value = 'Sign Up'/>
</form>
</body>
<script>


</script>
</html>
