<?php
/*
 * Created by Ryan Claude Fox
 * Script makes user enter in their new password they would like to set for
 * he/she account.
 */
    require 'connection.php';
  
    session_start();
    $temp_pass = $_SESSION['temp_pass'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    if($_SERVER['REQUEST_METHOD']== "POST")
    {

        if (!empty($_POST['password']) && !empty($_POST['repassword']))
        {
            if ($_POST['password'] === $_POST['repassword'])
            {

                $status = update_password($email, $_POST['password'],$username);
            }
        }
    }

    function update_password($email,$password,$username){
	$password = md5($password);
        $query = "UPDATE student set password = '$password' where email = '$email' and username = '$username'";
        if(mysqli_query($GLOBALS['conn'],$query)){

            return "SUCCESS";
        }else{
            echo mysqli_error();
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change <?php echo"$email"?>'s password</title>
    <link rel = 'stylesheet' type="text/css" href = 'form_page_layout.css'/>
    <link rel = 'stylesheet' type ='text/css' href='//fonts.googleapis.com/css?family=Schoolbell'/>
    <script src="jquery-3.2.0.js"> </script>
    <script src = "change_password.js"></script>
</head>
<body>
    <h1 style = "color:white; font-weight: bold;">Change <?php echo"$email"?>'s password</h1>
    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($status === "SUCCESS") {

            echo "<p style = 'text-align: center; font-size: 28px; font-weight: bold;color:#ffffff;'> You're password has been updated! Click the link below to return to student login.</p><br>";
            echo "<p style = 'text-align: center; font-size:28px; font-weight:bold;color:#ffffff;'> <a style='color:#ffffff;' href='logout.php'>Return to Login.</a>";
                
            
    }
}
    ?>
        <div id = 'mydiv'>
            <?php
            if($_SERVER['REQUEST_METHOD']== "POST")
            {
                if(!empty($_POST['password']) && !empty($_POST['repassword']))
                {

                       if ($_POST['password'] !== $_POST['repassword'])
                       {

                            echo "<p style = 'text-align: center; font-size: 28px; font-weight: bold;'>*Passwords do not match!</p>";

                        }
                }
       
            }

		if($status === "SUCCESS"){
		
		 echo "<script> $('#mydiv').hide(); </script>";	
}	
            ?>
            <p style="text-align: center;font-weight: bold;text-decoration: underline;font-size: 28px;">Enter in new pass word!</p>
        <form method ='post' action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>'>
            <input id = '1' style="color:black;" type = 'password' name ='password' placeholder="Password"/><br>
            <input id = 2 style = "color:black" type="password" name = 'repassword' placeholder="Re-enter Password"/><br>
            <input id = 3 class = 'background_btn' type = 'submit' name = 'sumbit' value="Change Password"/><br>
            <input id = 4 class = 'background_btn' type="reset" name ='reset_btn' value="Reset"/>
        </form>

    </div>

</body>
</html>

