<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
<?php
// build connections
/*--Team Ruby
--This file displays a list of classes taught by the professor. 
--When clicking a class, it opens a new page professorDashboard.php
*/
include 'db_connection.php';
$conn = OpenCon();
session_start();

//$Professor_ID = $_SESSION['Professor_ID'];
$Professor_ID = 1; //hard coded
$_SESSION['Professor_ID']=$Professor_ID;

echo "<h1><div align='center' >Class List</div></h1>"."<br><br><br>";

$sql = "SELECT Course_Name,Courses.Course_ID,Classes.Section,Classes.Class_ID FROM Classes,Courses WHERE Course_Status='active' AND Classes.Course_ID=Courses.Course_ID AND Classes.Professor_ID=$Professor_ID ORDER BY Courses.Course_ID,Section";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $Course_ID=$row["Course_ID"];
        $Class_ID=$row["Class_ID"];
        echo "<div align='center' >";
        echo "<a href='classDashboard.php?Class_ID=".$Class_ID."&Course_ID=". $Course_ID."'>".$row["Course_Name"]."-".$row["Section"]."</a><br>";
        echo '</div><br><br>';
    }
} else {
    echo "NO course is active";
}

CloseCon($conn);
 
?>
</body>
</html>
