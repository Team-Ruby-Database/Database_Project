<!--Team Ruby (written by victoria)
--This file displays the list of classes students are taking.
--when you click a class, it will link you to studentskills.php.
--Now the Student_ID is hardcoded as 331475. Need to get it from login.php by Session. 
--!>
<html>
<body>
<?php
include 'db_connection.php';
$con=OpenCon();
echo "List of Classes"."<br><br>";
$sql="SELECT Courses.Course_ID,Course_Name,Classes.Section,Classes.Class_ID ";
$sql1="FROM Classes,Student_Classes,Courses ";
$sql2="WHERE Student_Classes.Class_ID=Classes.Class_ID AND Student_Classes.Student_ID=331475 AND Course_Status='active' AND Courses.Course_ID=Classes.Course_ID";
$result=$con->query($sql.$sql1.$sql2);
if($result->num_rows>0){
	//output data
	while($row=$result->fetch_assoc()){
		$Course_ID=$row["Course_ID"];
		$Class_ID=$row["Class_ID"];
		echo "<a href='studentskills.php?Course_ID=".$Course_ID."'>".$row["Course_Name"]."-".$row["Section"]."</a><br>";
	}
}
else{
	echo "No course active";
	}
CloseCon($con);
?>
</body>
</html>
