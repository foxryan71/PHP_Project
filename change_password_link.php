<?php

/*
 * Page created by Ryan Claude Fox
 * This page is designed to allow users to enter in their temporary password, username, and email
 * if all done correctly they will be sent to change their passwords. If not they will be displayed errors of what went wrong.
 *
 */
require 'connection.php';
$error_array = array();
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $password  = md5($_POST['temp_pass']);
	$email = $_POST['email'];
	$username = $_POST['username'];
		
    if (verify_pass($password, $email,$username) === "SUCCESS") {
	session_start();     
       $_SESSION['temp_pass'] = $_POST['temp_pass'];
       $_SESSION['username'] = $username;
	$_SESSION['email'] = $email; 
	header("Location:change_password_step2.php");

  }else{

        //checking temp_pass
        if(empty($_POST['temp_pass'])){
            array_push($error_array,"*You must enter in a your temporary password!");
        }else{

            array_push($error_array,"*Incorrect password!");
        }//end of checking post temp pass

        //checking email
        if(empty($_POST['email'])){

            array_push($error_array,"*You must enter in an email address");
        }else{

            array_push($error_array,"*You've entered in an a wrong email");
        }//end of checking email

        //checking username
        if(empty($_POST['username'])){

            array_push($error_array,"*You must enter in a username!");
        }else{

            array_push($error_array,"*You've entered in a invalid username!");
        }

    }//end of else
}

?>


<?php


function verify_pass($password,$email,$username){

   $query = "SELECT * from student where password = '$password' and email = '$email' and username = '$username'";

    if($result = mysqli_query($GLOBALS['conn'],$query)){

        if(mysqli_num_rows($result) > 0){
            return "SUCCESS";
        }

    }else{
	    return "FAILURE";
}

}//end of verify_pass


?>


<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel = 'stylesheet' type="text/css" href = 'form_page_layout.css'/>
    <link rel = 'stylesheet' type ='text/css' href='//fonts.googleapis.com/css?family=Schoolbell'/>

</head>
<body>
<h2 style = 'color:#ffffff; text-align: center;'>Student Enrollment Center!</h2>
<p style = 'color:#ffffff; text-align: center;'>Please enter in your temporary password!</p>
<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        //checkings if errory is empty if is not then it prints the errors
        if(!empty($error_array)){

            echo "<div style= 'margin:auto;width:50%; margin-top:20px;'>";
            foreach ($error_array as $error){

                echo"<p style='color:black;font-size:22px; font-weight:bold;text-align: center;'> $error</p>";
            }
            echo"</div>";
        }

    }

?>

<div>
    <form method = "POST" action = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>'>
        <input style = 'color:black;' type='text' name = 'temp_pass' placeholder="Temporary Password" /> <br>
      <input  style = 'color:black;' type='text' name = 'username' placeholder="username" /> <br>
	<input style = 'color:black;' type='text' name = 'email' placeholder="email" /> <br>


	<input class = 'background_btn' type="submit" name="submit" value = 'Submit'/>

    </form>
</div>

</body>
</html>

