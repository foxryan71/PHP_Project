<?php
    /*
     * Created by Ryan Claude Fox
     * A login page for the user to login into the enrollment system
     * Page also has the option to go to a link to sign up and to
     * get a new password if they have forgotten one.
     */
    require 'check_login.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if (!empty($_POST['username']) && !empty($_POST['password']))
    {

        if (login_check($_POST['username'],$_POST['password']) === "SUCCESS") {
            header("Location:student_home.php");
        }
    }
}//end REQUSET METHOD
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Student Log in</title>

    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <style>

        body{
            background-color:#3B653D;
            font-family: SchoolBell;
        }
        div{

            background-color:white;
            height: 100%;
            width:50%;
            margin:auto;
            border-radius:10px;
            box-shadow: 10px 5px 10px white;



        }

        input[name = 'login_btn']{

            width:50%;
            height:100%;
            margin-left:25%;
            font-family:SchoolBell;
            font-size: 16px;
            font-weight:bold;
            color:white;
            background-color: #3B653D;
            border-radius:10px;
            box-shadow: 5px 5px 10px black;
            margin-top:10px;
            outline-color: #ffffff;

        }
        input[name = 'reset_btn']{

            width:50%;
            height:20%;
            margin-left:25%;
            font-family:SchoolBell;
            outline-color: #ffffff;
            font-size: 16px;
            border-radius: 10px;
            font-weight:bold;
            color:white;
            background-color: #3B653D;
            margin-top:10px;
            margin-bottom: 10px;
            box-shadow: 5px 5px 10px black;

        }
        input[name = 'username']{

            width:50%;
            height:20%;
            margin-left:25%;
            font-family:SchoolBell;
            font-size: 16px;
            margin-top:0px;
            border-radius:10px;
            outline-color: #3B653D;

            box-shadow: 5px 5px 10px black;


        }

        input[name = 'password']{

            width:50%;
            margin-left:25%;
            font-family:SchoolBell;
            box-shadow: 5px 5px 10px black;
            font-size: 16px;
            margin-top:10px;
            border-radius:10px;
            outline-color: #3B653D;




        }

        h1{

            text-align: center;

        }
        footer{

            font-size:36px;
            font-weight: bold;
            color:#ffffff;
            text-align: center;
            margin-top:50px;


        }
        form{
            width:100%;

        }
      a{
          margin-left:40%;
          text-decoration: none;
          color:#3B653D;



      }

       a:hover{

           text-decoration: underline;
       }
       .error
       {
            margin:auto;
           background-color:#ffffff;
           color:#3B653D;
           font-weight:bold;
           font-size:28px;
       }

    </style>
</head>
<body>
<h1 style = 'font-family: SchoolBell; font-size:32px; font-weight: bold;color: #ffffff;'>Student Enrollment Center!</h1>
<?php
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if(!empty($_POST['username']) && !empty($_POST['password']))
            {
                if (login_check($_POST['username'], $_POST['password']) === "FAILURE")
                {
                    echo"<div class = 'error'>";
                    echo "<span>* Either Username or Password is invalid!</span><br>";
                    echo"</div>";
                }
            }
            else
            {
                echo"<div class = 'error'>";
                echo "<span> *Please enter both Username and Password</span><br>";
                echo"</div>";
            }

        }
?>

        <div>

        <form method = 'post' action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>'>
            <h2 style = "text-align: center;width: 100%; text-decoration: none;font-weight: bold;font-size:28px;color:#3B653D">Log in</h2>
            <input type = 'text' name = 'username' placeholder="Username" /><br>
            <input type = 'password' name = 'password' placeholder= 'Password' /><br>
            <input type = 'submit' name = 'login_btn' value = 'Log In' /><br>
            <input type = 'reset' name  = 'reset_btn' value = 'Reset'/><br>

            <a href = 'new_student.php'>Register New Student</a><br>
            <a href = 'forgot_password.php'>Forgot Your Password?</a>
        </form>

    </div>
        <footer> &#169; Ryan Claude Fox</footer>

</body>
</html>
