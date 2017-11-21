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
$sql="SELECT Course_Name,Courses.Course_ID,Classes.Section,Classes.Class_ID
	FROM Classes,Courses,student_classes
	WHERE Course_Status='active' AND Classes.Course_ID=Courses.Course_ID AND student_classes.Student_ID=333210";
$result=$con->query($sql);

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