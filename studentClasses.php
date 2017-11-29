<!--Team Ruby (written by victoria)
--This file displays the list of classes students are taking.
--when you click a class, it will link you to studentskills.php.
--Now the Student_ID is hardcoded as 3. Need to get it from login.php by Session. 
--!>
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
include 'db_connection.php';
$con=OpenCon();
session_start();

$Student_ID = $_SESSION['Student_ID']; //comment out if hardcoding
//$Student_ID = 3; //hard coded
$_SESSION['Student_ID']=$Student_ID;

//print the header
echo "<h1><div align='center' >List of Classes</div></h1><hr>";

//build sql query
$sql="SELECT Courses.Course_ID,Course_Name,Classes.Section,Classes.Class_ID ";
$sql1="FROM Classes,Student_Classes,Courses ";
$sql2="WHERE Student_Classes.Class_ID=Classes.Class_ID AND Student_Classes.Student_ID=".$Student_ID." AND Course_Status='active' AND Courses.Course_ID=Classes.Course_ID";

//send query
$result=$con->query($sql.$sql1.$sql2);


if($result->num_rows>0){  //if there's more than zero thing returned from the query
	//output data
	//while there are still things to cycle through
	while($row=$result->fetch_assoc()){
		$Course_ID=$row["Course_ID"];
		$Class_ID=$row["Class_ID"];
		//set up format
		echo "<div align='center' >";
		//create links for each class
		echo "<a href='skillDashboard.php?Course_ID=".$Course_ID."'>".$row["Course_Name"]."-".$row["Section"]."</a><br>";
		echo '</div><br>';
	}
}
else{
	echo "No course active";
	}
CloseCon($con);
?>
</body>
</html>
