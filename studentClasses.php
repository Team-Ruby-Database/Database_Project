<!--Team Ruby (written by victoria)
--This file displays the list of classes students are taking.
--when you click a class, it will link you to studentskills.php.
--I still need to get the Student_ID from the previous page from where they log in, so it is set to 333210 for now.
--everything prints twice right now for some reason, so this isn't perfect yet. Otherwise it works.
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
