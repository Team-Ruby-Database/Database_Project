<!-Team Ruby
--This file gets the list of skills for the class that was clicked on the last page, studentClasses.php
--will display completeness, but we decided to work on that when we get back
--each skill links to question.php
--Something is wrong with my query.
!>
<html>
<body>
<?php
//build connections
include 'db_connection.php';
$conn=OpenCon();
echo "Skills"."<br><br>";
$Course_ID= $_GET['Course_ID'];
$sql="SELECT Skills.*
	FROM Skills,Courses
	WHERE Course_ID=$Course_ID";
$result=$conn->query($sql);
if($result->num_rows >0){
	while($row=$result->fetch_assoc()){
		$Skill_Name=$row["Skill_Name"];
		echo"<a href='question.php?Skill_ID=". $Skill_ID. "'>"."</a><br>";
	}
}
else{
	echo "No skills at this time.";
}
CloseCon($conn);
?>

</body>
</html>
