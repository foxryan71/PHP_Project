<?php
/*
 * Created by Ryan Claude Fox
 * Php page used with sign_up_for_course page.
 * Page just returns all courses for each department.
 * using AJAX
 */

require 'connection.php';

$c = $_GET['c'];
$query = "Select * from course where dept = '$c'";
$result = mysqli_query($GLOBALS['conn'],$query);

echo "<table id = 'course_table'>";
echo "<tr>";
echo "<th> Year</th>";
echo "<th>CRN</th>";
echo "<th>Dept</th>";
echo "<th>Course#</th>";
echo "<th>Instructor</th>";
echo"</tr>";
while ($row = mysqli_fetch_assoc($result)){

    echo"<tr>";
echo"<td>" . $row['year']  ."</td>";
echo"<td>" . $row['crn'] . "</td>";
echo "<td>" . $row['dept'] . "</td>";
echo"<td>" . $row['coursenumber'] . "</td>";
echo "<td>" .$row['instructor'] . "</td>";
echo "</tr>";
}

echo"</table>";


?>


