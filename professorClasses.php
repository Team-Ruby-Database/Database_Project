<!--Team Ruby
--This file displays a list of classes taught by the professor. 
--When clicking a class, it opens a new page professorDashboard.php
--need to add professor_id variable in the link. let's call it profID. need to remove Classes.Professor_ID=1 by Classes.Professor_ID=profID
>

<html>
<body>
<?php
// build connections
include 'db_connection.php';
 
$conn = OpenCon();
 
echo "Class List"."<br><br>";

$sql = "SELECT Course_Name,Courses.Course_ID,Classes.Section,Classes.Class_ID FROM Classes,Courses WHERE Course_Status='active' AND Classes.Course_ID=Courses.Course_ID AND Classes.Professor_ID=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $Course_ID=$row["Course_ID"];
        $Class_ID=$row["Class_ID"];
        echo "<a href='studentProgress.php?Class_ID=". $Class_ID."'>".$row["Course_Name"]."-".$row["Section"]."</a><br>";
    }
} else {
    echo "NO course is active";
}

CloseCon($conn);
 
?>
</body>
</html>
