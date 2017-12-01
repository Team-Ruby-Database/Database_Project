<!--Team Ruby
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--This is page that comes after studentClasses.php. 
--This takes whichever class was clicked through the link and displays all skills related to that class.
--The next page is question.php, this file passes that one which skill has been clicked.
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
//51
include 'db_connection.php';
include 'grade.php';
session_start();
$con=OpenCon();
echo "<h1><div align='center' >Skill List</div></h1><hr>";

$Course_ID= $_GET['Course_ID'];
$Student_ID=3; //hardcoded
//$Student_ID = $_SESSION['Student_ID']; //comment out if hardcoding
$_Session['Student_ID']=$Student_ID;

$sql="SELECT * ";
$sql1="FROM skills ";
$sql2="WHERE Skills.Course_ID=".$Course_ID;

$result=$con->query($sql.$sql1.$sql2);

if($result->num_rows>0){
	//output data
	$get=listskills2($con,$Course_ID,$Student_ID);
	
	while($row=$result->fetch_assoc()){
		$Skill_ID=$row["Skill_ID"];
		$Skill_Name=$row["Skill_Name"];
		if(in_array($Skill_Name,$get)){
			echo "<div align='center' >";
			echo "<a href='question.php?Skill_ID=".$Skill_ID."'>".$row["Skill_Name"]."</a>";
			echo "		Skill Acquired"."<br>";
			echo '</div><br>';
		}
		else{
			echo "<div align='center' >";
			echo "<a href='question.php?Skill_ID=".$Skill_ID."'>".$row["Skill_Name"]."</a>";
			echo "		Skill Not Yet Acquired"."<br>";
		}
	}
}
else{
	echo "No class active";
	}

$_Session['Course_ID']=$Course_ID;

CloseCon($con);
?>     
</body>
</html>
