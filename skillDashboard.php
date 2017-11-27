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
include 'db_connection.php';
$con=OpenCon();
echo "<h1><div align='center' >Skill List</div></h1>";

$Course_ID= $_GET['Course_ID'];
$Student_ID=331475; //hardcoded
$_Session['Student_ID']=$Student_ID;

$sql="SELECT * ";
$sql1="FROM skills ";
$sql2="WHERE Skills.Course_ID=".$Course_ID;

$result=$con->query($sql.$sql1.$sql2);

if($result->num_rows>0){
	//output data
	while($row=$result->fetch_assoc()){
		$Skill_ID=$row["Skill_ID"];
		///$Class_ID=$row["Class_ID"];
		echo "<a href='question.php?Course_ID=".$Course_ID."'>".$row["Skill_Name"]."</a><br>";
	}
}
else{
	echo "No class active";
	}
CloseCon($con);
?>     
</body>
</html>