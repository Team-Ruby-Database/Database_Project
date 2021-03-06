<!--Team Ruby
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--This page shows an overview of student progress and buttons for each student that lead to individual views of the student's progress.
--It also has a "manage skills" button that leads to the skillEditor.php. A back button leads back to professorClasses.php 
--!>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<style>
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    float: left;
    border: 1px solid white;
    background-color: white;
    width: 30%;
}

/* Style the buttons inside the tab */
div.tab button {
    display: block;
    background-color: black;
    color: yellow;
    padding: 9px 23px;
    width: 70%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 19px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: white;
    color: yellow;
}

/* Create an active/current "tab button" class */
div.tab button.active {
    background-color: white;
     color: black;
}

/* Style the tab content */
.tabcontent {
    float: left;
    width: 70%;
    border-left: none;
}
</style>
</head>
<body>

<?php 
	
	//get class_id and $course_id from professorClasses.php
	$Course_ID= $_GET['Course_ID'];
	$Class_ID=$_GET['Class_ID'];
	
	//start connection to the database
	include 'db_connection.php';
	$con=OpenCon();
	
	//use functions in grade.php
	include 'grade.php'; 
	
	//start session
	session_start();
	$Professor_ID = $_SESSION['Professor_ID'];
	$_SESSION['Course_ID']=$Course_ID;
	
	//query and print class info at the header
	$sql = "SELECT Courses.Course_Name,Courses.Course_Code,Classes.Section FROM Courses,Classes WHERE Classes.Class_ID=$Class_ID AND Courses.Course_ID=$Course_ID";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $Course_Name=$row["Course_Name"];
        $Section=$row["Section"];
        $code=$row["Course_Code"];
        }
    }
    echo "<h1><div align='center' >Student Progress</div></h1>";
    echo "<b><div align='center' >".$Course_Name.": ".$code.'-'.$Section."</div></b><br><br>";

	//A button that links to skill_editor.php
	//pass Course_ID by session
	echo "<div align='center' class='w3-container'>";
	echo "<a href='skill_editor.php' class='w3-btn w3-black'><font size='4' color='yellow'>Manage Skills</font></a></div><br>";
	echo "<div align='center'> <button class='w3-button w3-black' onclick='goBack()'><font  color='yellow'>Back</font></button></div><hr>";

	//Create buttons of each student
	//when click a student, the page displays the student's progress
	//default displaying all students' progress in general
	echo '<div class="tab">';
	echo '<button class="tablinks" onclick="checkStudent(event,'. "'all'".')"'. 'id="defaultOpen">All Progress</button><br>';
	$sql = "SELECT CONCAT(Student_First_Name,' ',Student_Last_Name) AS 'name',Students.Student_ID FROM Students,Student_Classes WHERE Student_Classes.Class_ID=$Class_ID AND Student_Classes.Student_ID=Students.Student_ID ORDER BY Student_First_Name,Student_Last_Name";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name=$row["name"];
		$Student_ID=$row["Student_ID"];
		echo '<button class="tablinks" onclick="checkStudent(event,'."'$Student_ID'";
		echo ')">'.$name.'</button><br>';
	}
	}
	echo '</div>';
	
	echo '<div id="all" class="tabcontent">';
  	echo '<h1>All Progress</h1><br>';
  	echo '<p>';
  	all_student_progress($Course_ID,$Class_ID,$con);
  	echo '</p></div><br>';
	$sql = "SELECT CONCAT(Student_First_Name,' ',Student_Last_Name) AS 'name',Students.Student_ID FROM Students,Student_Classes WHERE Student_Classes.Class_ID=$Class_ID AND Student_Classes.Student_ID=Students.Student_ID ORDER BY Student_First_Name,Student_Last_Name";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name=$row["name"];
		$Student_ID=$row["Student_ID"];
		$get = array(); //skills accomplished
		$notget = array(); //skills that are not obtained
		echo "<div id='$Student_ID' class='tabcontent'><h3>";
		listskills($con,$Course_ID,$Student_ID);
		echo '</div>';
	}
	}
	CloseCon($con);
	?>

<script>
function checkStudent(evt, studentName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(studentName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>
