<?php
/*
 * Created by Ryan Claude Fox
 * Script will allow users to apply for a new password.
 */ 
 require 'verify_email.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      
	if(check_email() === "SUCCESS"){

            header("Location:change_password.php");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <link rel = 'stylesheet' type="text/css" href ="form_page_layout.css"/>
</head>
<body>
    <h1>Reset Your Password!</h1>
    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
           if(check_email() ==="FAILURE"){
               $error = $GLOBALS['error'];
               echo"<div class = 'error'>";
               echo "<span>$error</span>";
               echo"</div>";
           }
        }
    ?>
    <div>
    <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
        <input style = "color:black" name ='username' placeholder="Username" /><br />
        <input style = "color:black"type = 'email' name = 'email' placeholder="E-Mail Address" /><br>
        <input class = 'background_btn' type = 'submit' name = 'newpass_btn' value="Get New Password"/><br>
        <input class = 'background_btn' type = 'reset' name = 'reset_btn' value="Reset"/>


    </form>
    </div>
</body>
</html>
