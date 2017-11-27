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
    
    //add student_answer to Student_Answer Table
    function addStudentAnswer($sid,$ans,$qid,$conn) {
		$sql = 'UPDATE Student_Questions SET Student_Answer='.'"'.$ans.'"'. 'WHERE Student_ID='.'"'. $sid.'"'.' AND Question_ID='.'"'.$qid.'"';
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

	echo '<div align="center">'."Correctness: $totalCorrect / ".$questionNum. " correct</div>";
	echo "<br>Incorrect answered questions: <br><ol>";
	foreach ($incorrect_question as $q) {
		echo '<li>'.$q.'</li>';
	}
	echo '</ol><br>';
	if ($totalCorrect===$questionNum) {
		echo "<br>You have obtained this skill!<br><br><hr>";
		echo '<div align="center">'.'<a href="studentClasses.php" class="w3-button w3-black"><font color="yellow" align="center">Go to the Skill List</font></a></div>';}
	else {
		//need to display incorrect questions here 
		echo "<hr>";
		echo '<div align="center">'.'<a href="question.php" class="w3-button w3-black"><font align="center" color="yellow">Retry All the Questions</font></a></div><br>';
		echo '<div align="center">'.'<a href="unfinishedQuestion.php" class="w3-button w3-black"><font align="center" color="yellow">Retry Incorrect Questions</font></a></div><br>';
		echo '<div align="center">'.'<a href="studentClasses.php" align="center" class="w3-button w3-black"><font color="yellow">Exit</font></a></div><br>';

	}
    
    CloseCon($conn);
?>