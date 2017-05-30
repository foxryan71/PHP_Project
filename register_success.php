<?php
 /*
 * Created  by Ryan Claude Fox
  * Page is designed to show that they successfully registered for student enrollment center
  * Also this page sends an html mailing letter to the student enrolled about their username
  * and password.
 */
        session_start();
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $firstname = $_SESSION['firstname'];
        $to = $_SESSION['email'];
        $subject = "Welcome to Student Enrollment!";

        //message to the user!
        $message = "
    <html>
    <body style='background: #3B653D;'>
        <div>
            <h1 style = 'color:#ffffff; font-size:32px; text-align: center;'> Here is your account log in info $firstname!</h1>
            <span style = 'color:#ffffff; font-size:20px;'> Username: $username </span><br>
            <span style = 'color:#ffffff; font-size:20px;'> Password: $password </span><br>
            
        
        </div>
    </body>
    </html>";


        echo "Thank you for signing up for Student Enrollment!  You can
    now get started on enrolling in classes!";

        $headers = "MIME-Version: 1.0" . PHP_EOL;
        $headers .= "Content-type:text/html;charset=UTF-8" . PHP_EOL;
        $headers .= "From: foxryan71@yahoo.com" . PHP_EOL;

        mail($to, $subject, $message, $headers);
    
?>


<html>
<head>
    <title>Welcome <?php echo $_SESSION['firstname'] ?></title>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />


    <style>

        body{
            font-family: SchoolBell;
            background:#3B653D;

        }

        h1{
            color:#ffffff;
            font-weight: bold;
            text-align: center;
        }
         p{
            color:#ffffff;
            font-size:18px;
            text-align: center;
            font-weight: bold;
        }
        a{
            color:#ffffff;

            text-decoration: underline;
        }
        a:hover{
            text-decoration: underline;
            font-weight: bold;
            font-size:22px;
        }

    </style>
</head>
<body>

    <h1>Success!</h1>
    <p>Welcome <?php echo $_SESSION['firstname'] ?> to Student Enrollment Center! </p>
    <p>An email has been sent to <?php echo$_SESSION['email'] ?> with all Account information <br>
        <br>
        <a href = 'logout.php'>Return to Student Log In</a>

    </p>






</body>

</html>
