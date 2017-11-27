<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,th {
	padding: 15px;
	
    text-align: left;
    padding: 8px;
}

</style>
</head>
<body>

<?php
// build connections
/*--Team Ruby
--Displays all the questions of a skill
*/
include 'db_connection.php';
$conn = OpenCon();
session_start();


//$Student_ID=$_GET['Student_ID'];
//$Course_ID= $_GET['Course_ID'];
//$Skill_ID= $_GET['Skill_ID'];

$Skill_ID=1;
//$Student_ID= $_GET['Student_ID'];
$Student_ID=1;
$_SESSION['Student_ID']=$Student_ID;
$_SESSION['Skill_ID']=$Skill_ID;

$sql="SELECT Skill_Name FROM Skills WHERE Skills.Skill_ID=$Skill_ID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	echo "<h1><div align='center' >".$row['Skill_Name']."</div></h1>";
        echo "<h3><div align='center' >Practice Problems</div></h3>"."<hr>";
    }
} else {
    echo "NO such skill";
}

$sql="SELECT Question,Question_ID FROM Questions WHERE Questions.Skill_ID=$Skill_ID";
$result = $conn->query($sql);

echo "<ol><form action='feedback.php?Skill_ID=".$Skill_ID."'"."method='POST'>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	echo "<li>".'<div class="w3-padding w3-light-grey"><p class="w3-large" style="margin-bottom:30px;">';
        echo $row["Question"]."</p>";
        echo "Answer: <input type='text' name=".'q'.$row['Question_ID']."><br><br>";
        echo '</li></div><br>';
    }
    
    echo "<hr><font color='yellow'><div class='w3-container'>";
	echo "<input class='w3-btn w3-black w3-text-yellow' type='submit' value='Submit'></font></form></ol></div>";
    
} else {
    echo "<p align='center'>NO practice problem available</p> <br><br>";
    echo "</table><font color='yellow'><div align='center' class='w3-container'>";
	echo "<input class='w3-btn w3-black w3-text-yellow' type='submit' formaction='/studentclasses.php' value='Go back to Skill List'></font></form></ol></div>";
}

CloseCon($conn);
?>

</body>
	</html>