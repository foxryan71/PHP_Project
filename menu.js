/**
 * Created by RyanFox on 4/9/17.
 */
$("document").ready(function(){

    menu_setup();

});

function menu_setup(){

    var ul = $("<ul class = 'menu'>").appendTo("#menu");
    $("<li><a href = 'student_home.php'>Home</a> </li>").appendTo(ul);
    $("<li><a href = 'schedule.php'>Schedule</a></li>").appendTo(ul);
    $("<li> <a href ='sign_up_for_course.php'>Sign up for Course</a></li>").appendTo(ul);
    $("<li><a href = 'drop_course.php'>Drop a Course</a></li>").appendTo(ul);
    $("<li><a href ='logout.php'>Log Out</a></li>").appendTo(ul);
}

