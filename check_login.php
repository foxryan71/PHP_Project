<?php
/*
 * Created by Ryan Claude Fox
 * This page is designed to check if a usersname and password are valid.
 * Takes user input and changes it to the hashed password to check.
 * If correct all important session variables are set.
 */
session_start();
require 'connection.php';
    
    function login_check($username, $password)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
           	//gets users password with that username. 
		$hashed_pass = get_user_password($username);
		
		//checks if password is correct if so lets log in!
		if($hashed_pass === md5($password)){	

                $query = "SELECT * from student where username = '$username' and password = '$hashed_pass'";

                $result = mysqli_query($GLOBALS['conn'], $query);

                if (!$result) {
                    die("Could not run query" . mysqli_error());
                }

                if (mysqli_num_rows($result) > 0) {

                    if ($row = mysqli_fetch_assoc($result)) {


                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['lastname'] = $row['lastname'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['id'] = (int)$row['ramid'];
                        $_SESSION['email'] = $row['email'];
                        return "SUCCESS";
                    }


                }//end of checking if query generate a result.
	}	
            else
            {
                return "FAILURE";
            }

        }//END OF $_SERVER['REQUEST_METHOD']
    }

    function get_user_password($username){

        $query = "SELECT password from student where username = '$username'";
        $result = mysqli_query($GLOBALS['conn'],$query);

        if(!$result){
            die("Could not run query" . mysqli_error());
        }

        if(mysqli_num_rows($result) > 0){

            if($row = mysqli_fetch_assoc($result)){
		
               return $row['password'];
            }
        }
    }
?>
