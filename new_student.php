<?php
/*
 * Created by Ryan Claude Fox
 * Page is designed for allowing users to sign up for student enrollment center
 * If information is inputted incorrectly they will be displayed the erros
 */
if($_SERVER['REQUEST_METHOD'] == "POST")
{

    require'connection.php';
    session_start();
    $status = "";
    $error_array = array();
    $succ_count = 0;

    if(empty($_POST['firstname']))
    {

        array_push($error_array,"*Please enter in a firstname");
    }
    else
    {
        if(!preg_match("/^[a-zA-Z ]*$/",fix_input($_POST['firstname'])))
        {
            array_push($error_array,"*Not a valid firstname");
        }
        else
        {
            $firstname = $_POST['firstname'];
            $succ_count++;

        }
    }//end of checking firstname
    if(empty($_POST['lastname']))
    {

        array_push($error_array,"*Please enter in a lastname");
    }
    else
    {
        if(!preg_match("/^[a-zA-Z ]*$/",fix_input($_POST['lastname'])))
        {
            array_push($error_array,"*Not a valid lastname");
        }
        else
        {
            $lastname = $_POST['lastname'];

            $succ_count++;

        }
    }//end of checking lastname

    if(empty($_POST['email']))
    {
        array_push($error_array,"* Please enter in a Email Address");

    }
    else
    {
        if (!filter_var(fix_input($_POST['email']), FILTER_VALIDATE_EMAIL))
        {
            array_push($error_array, "*Please enter in a valid Email address");
        }
        else
        {
            $email = $_POST['email'];
            $succ_count++;

        }

    }//end of checking email

    if(empty($_POST['username']))
    {

        array_push($error_array,"* Please choose a enter in a Username");
    }
    else
    {
        if(!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/',fix_input($_POST['username'])))
        {
            array_push($error_array, "*Please enter in a valid username");
        }
        else
        {
            $username = $_POST['username'];
            $succ_count++;


        }
    }//end of checking username
    if(empty($_POST['password']))
    {

        array_push($error_array,"*Please enter in a password");
    }
    elseif(empty($_POST['repassword']))
    {
        array_push($error_array,"*Please re-enter password");
    }
    else
    {
        if($_POST['password'] !== $_POST['repassword'])
        {
            array_push($error_array,"*Password's do not match!");
        }
        else
        {
            
            $succ_count++;
	    $password = md5($_POST['password']);
	$repassword = $_POST['repassword'];	

        }

    }//checking if passwords match.

    if(insert_student($firstname,$lastname,$email,$username,$password) === "SUCCESS"){
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
	$_SESSION['password'] = $repassword;
        $_SESSION['username'] = $username;
        header("Location: register_success.php");

    }else{
		$status = "FAILURE";
	}


}//end of server request method.

//function that fixes input trims,slipslashes and htmlspecialchars
function fix_input($data)
{
    htmlspecialchars($data);
    trim($data);
    stripslashes($data);
    return $data;
}

//function that inserts into student table
function insert_student($firstname,$lastname,$email,$username,$password)
{
  
 		
    $query = "INSERT INTO student(firstname,lastname,email,username,password) ";
    $query .= "VALUES ('$firstname','$lastname','$email','$username','$password')";
       
        if($GLOBALS['succ_count'] !== 5){
            return;
        }

        if (mysqli_query($GLOBALS['conn'], $query)) {
            return "SUCCESS";

        }

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Register New Student</title>
    <link href='//fonts.googleapis.com/css?family=Schoolbell' rel='stylesheet' />
    <link rel = 'stylesheet' type="text/css" href="form_page_layout.css" />
</head>

<body>
    <h1>Register New Student</h1>

    <?php

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($GLOBALS['status'] === "FAILURE") {
            echo "<div class = 'error'>";
            foreach ($error_array as $error) {
                echo "<span>$error</span> <br>";
            }
            echo "</div>";

        }
    }

    ?>
    <div>
    <form method="post" action = '<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>' >

        <input style ="color:black;" type = 'text' name ='firstname' placeholder="First Name" /><br/>
        <input style ="color:black;" type = 'text' name="lastname" placeholder = 'Last Name'><br/>
        <input style ="color:black;" type = 'email' name="email" placeholder="E-Mail Address" /> <br />
        <input style ="color:black;" type = 'text' name="username" placeholder="Username"/> <br/>
        <input style ="color:black;" type = 'password' name="password"placeholder="password"/> <br />
        <input style ="color:black;" type = 'password' name ='repassword' placeholder="Re-enter Password"/> <br />
        <input class = 'background_btn'type ='submit' name="reg_btn" value ='Register Student'/> <br />
        <input class = 'background_btn' type = 'reset' name ='reset_btn' value ="Reset"/>

    </form>
    </div>
    <footer> &#169; Ryan Claude Fox</footer>
</body>
</html>
