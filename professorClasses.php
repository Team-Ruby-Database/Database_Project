<!– Team Ruby
--Michelle Kim, Victoria Cummings, Xiao Jiang, Yin Song
--This file displays a list of classes that are currently taught by the professor. 
--When clicking a class, it opens a new page classDashboard.php
–>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<?php

// build connections
include 'db_connection.php';

//start session
$conn = OpenCon();
session_start();

//$Professor_ID = $_SESSION['Professor_ID'];
$Professor_ID = 1; //hard coded
$_SESSION['Professor_ID']=$Professor_ID;

//head
echo "<h1><div align='center' >Hello, Professor! Here is your Class List</div></h1>"."<hr>";

//query all the classes that the professor teaches
$sql = "SELECT Course_Name,Courses.Course_ID,Courses.Course_Code,Classes.Section,Classes.Class_ID FROM Classes,Courses WHERE Course_Status='active' AND Classes.Course_ID=Courses.Course_ID AND Classes.Professor_ID=$Professor_ID ORDER BY Courses.Course_ID,Section";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $Course_ID=$row["Course_ID"];
        $Class_ID=$row["Class_ID"];
        $code=$row["Course_Code"];
        echo "<div align='center' >";
        echo "<a href='classDashboard.php?Class_ID=".$Class_ID."&Course_ID=". $Course_ID."'>".$row["Course_Name"].": ".$code."-".$row["Section"]."</a><br>";
        echo '</div><br><br>';
    }
} else {
    echo "NO course is active";
}



CloseCon($conn);
 
?>

<br><br><div align='center'> <button class="w3-button w3-black" onclick="goBack()"><font  color="yellow">Back</font></button></div>

<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>
