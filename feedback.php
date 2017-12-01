<!--Team Ruby
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--Once you submit answers for questions, it routes here. If you answered all correctly, it will show a congratulatory message.
--If you missed some, it will show you the ones you missed and some reference material if the professor provided it. 
--!>
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
	
	//initial connection
	include 'db_connection.php';
	$conn = OpenCon();
	session_start();
	//get skillid and studentid from question.php by POST
    $Skill_ID=$_SESSION['Skill_ID'];
    $Student_ID=$_SESSION['Student_ID'];
    $Course_ID=$_SESSION['Course_ID'];
    //add student_answer to Student_Answer Table
    function addStudentAnswer($sid,$ans,$qid,$conn) {
		$stmt = $conn->prepare("UPDATE Student_Questions SET Student_Answer = ?,Date=CURDATE(),Time=CURTIME() WHERE Student_ID = ? AND Question_ID = ?");
		$stmt->bind_param('sii',$ans,$sid,$qid);
		$stmt->execute();
		$stmt->close();
    }
    
    $totalCorrect = 0;
    $questionNum=0;
    $incorrect_question = array();
    $sql="SELECT Question,Question_ID,Answer FROM Questions WHERE Questions.Skill_ID=$Skill_ID";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	$Question_ID=$row["Question_ID"];
    	$Question=$row["Question"];
    	$Answer = $row["Answer"]; 
		$a=$_POST['q'.$Question_ID];
		addStudentAnswer($Student_ID,$a,$Question_ID,$conn);
		$questionNum++;
		if ($a===$Answer) { $totalCorrect++; }
		else {array_push($incorrect_question,$Question);}
    }
    }
	echo '<div align="center"><h1>FeedBack</h1><br>'."Total number of questions:$questionNum <br> Number of questions you answered correctly: $totalCorrect<br></div><br><br>";
	
	if ($totalCorrect===$questionNum) {
		echo "<br><div align='center'><h2>You have obtained this skill!<h2></div><br><br><hr>";
		echo '<div align="center">'.'<a href="skillDashboard.php?Course_ID='."'$Course_ID'".'" class="w3-button w3-black"><font color="yellow" align="center">Go to the Skill List</font></a></div>';}
	else {
		echo "<br><b>Incorrectly-answered questions: </b><br><ol>";
		foreach ($incorrect_question as $q) {
			echo '<li>'.$q.'</li>';
		}
		echo '</ol><br>';
		echo "<hr>";
		
		$sql = "SELECT Reference FROM Resources WHERE Resources.Skill_ID=$Skill_ID";
		$result = mysqli_query($conn,$sql);
		$hint = mysqli_fetch_row($result)[0];
		echo "<b>This reference might help: </b>".$hint;
		//echo '<div align="center">'.'<a href="skillDashboard.php?Course_ID='."'$Course_ID'".'" class="w3-button w3-black"><font color="yellow" align="center">Go to the Skill List</font></a></div>';}
		
    }
    CloseCon($conn);
?>

<br><br><div align='center'> <button class="w3-button w3-black" onclick="goBack()"><font  color="yellow">Retry</font></button></div>

<script>
function goBack() {
    window.history.back();
}
</script>
