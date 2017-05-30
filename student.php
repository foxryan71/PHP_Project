<?php
/*
 * Created by Ryan Claude Fox
 * This is a student class that stores all student information besides their password.
 * This class has variables to store a students first and last name, username, id,
 * and email. Also in this class there are functions where you can use to enroll in a course,
 * view the schedule for that student, and just a function to display a drop course menu with
 * all the students classes.(Very similar to show schedule just with functionality to drop a course)
 *
 */
require 'connection.php';

 class student
{
    public $firstname = 'default first name';
    public $lastname = 'default last name';
    public $username = 'default username';
    public $id = 0;
    public $email = 'default email';


    function __construct($firstname, $lastname, $username, $id, $email)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->id = $id;
        $this->email = $email;

    }

    //get functions
    function get_firstname(){

        return $this->firstname;
    }
    function get_lastname(){

        return $this->lastname;
    }

    function get_username(){

        return $this->username;

    }
     function get_id(){

        return $this->id;
    }
    function get_email(){
        return $this->email;
    }

    //end of get functions

     //enroll for class
     function enroll_to_course($crn,$year,$id)
     {

         $query = "INSERT INTO enrollment (crn, year, student) VALUES ('$crn','$year' ,$id)";

         if(mysqli_query($GLOBALS['conn'],$query)){

             return "SUCCESS";
         }else{

             return "FAILURE";
         }

     }//end of enroll to course

     function show_schedule(){

        $id = $this->id;

        $query ="SELECT c.year, c.crn, c.dept, c.coursenumber, c.instructor from course c join enrollment e on c.crn = e.crn and c.year = e.year where student = $id";

        $result = mysqli_query($GLOBALS['conn'],$query);

        if(!$result){
            echo mysqli_error();
        }


        if(mysqli_num_rows($result) > 0 ){
            echo "<table>";
            echo "<tr>";
            echo "<th> YEAR </th>";
            echo "<th> CRN </th>";
            echo "<th> DEPT </th>";
            echo "<th> Course# </th>";
            echo "<th> Instructor </th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)){

               echo "<tr>";
               echo"<td>".$row['year'] . "</td>";
               echo "<td>" . $row['crn'] . "</td>";
               echo "<td>" .$row['dept'] . "</td>";
               echo "<td>" . $row['coursenumber'] . "</td>";
               echo "<td>" . $row['instructor'] ."</td>";
               echo"</tr>";


            }
            echo"</table>";
        }else{

            echo"<p style='text-align: center; color:#ffffff; font-size:22px; font-weight:bold;'>You are currently not enrolled in any classes!</p>";
        }



     }//end of show schedule

     function show_drop_course_table(){

         $id = $this->id;

         $query ="SELECT c.year, c.crn, c.dept, c.coursenumber, c.instructor from course c join enrollment e on c.crn = e.crn and c.year = e.year where student = $id";

         $result = mysqli_query($GLOBALS['conn'],$query);

         if(!$result){
             echo mysqli_error();
         }


         if(mysqli_num_rows($result) > 0 ){
             echo "<div>";
             echo "<table>";
             echo "<tr>";
             echo "<th> YEAR </th>";
             echo "<th> CRN </th>";
             echo "<th> DEPT </th>";
             echo "<th> Course# </th>";
             echo "<th> Instructor </th>";
             echo "</tr>";
             while ($row = mysqli_fetch_assoc($result)){
                echo"<form method='post' action='drop_course_offical.php'>";


                echo "<tr>";
                 echo"<td>" . $row['year'] . "</td>";
                 echo "<td>" . $row['crn'] . "</td>";
                 echo "<td>" .$row['dept'] . "</td>";
                 echo "<td>" . $row['coursenumber'] . "</td>";
                 echo "<td>" . $row['instructor'] ."</td></input>";
                 echo"</tr>";




             }//end of while loop

             echo"</table>";
             echo "<input style='margin-left:40%; font-size:18px;width:20%; margin-top:10px; font-family: SchoolBell; border-radius: 10px;;'type = 'text' name = 'crn' placeholder=\"CRN\" /><br/>";
             echo"<input style ='background-color: #3B653D; color:#ffffff; position:relative;float:right;margin-right: 25%; margin-top: 20px; height:40px; border-radius:10px; border:2px solid #ffffff;width:150px'type = 'submit' value = 'Drop Course'/>";
             echo"</form>";
             echo"</div>";


         }else{

             echo"<p style='text-align: center; color:#ffffff; font-size:22px; font-weight:bold;'>You are currently not enrolled in any classes!</p>";
         }

     }//end of drop course
} //end of student class

?>
