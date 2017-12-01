<?php

//Team Ruby: Michelle Kim, Victoria Cummings, Xiao Jiang, Yin Song
//Purpose: create several functions that support tracking student progress
	
	function isAcquired($sid,$skillid,$con){
		//return a boolean shows if a student gets a specific skill
		
		//retrieve the correct answers and student's answers of all the questions of the skill
		$sql = "SELECT Answer,Student_Questions.Student_Answer FROM Questions,Student_Questions WHERE Questions.Skill_ID=$skillid AND Student_Questions.Student_ID=$sid AND Student_Questions.Question_ID=Questions.Question_ID";
		$result = $con->query($sql);
		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		    	$Answer=$row["Answer"]; //compare the correct answer with student's answer
		    	$ans=$row["Student_Answer"];
				if ($Answer != $ans) {return false;} //if at least one answer is incorrect, the skill is not obtained
		    }
	    }
	    else {return false;} //if the skill doesn't have questions yet, then no one has obtained the skill
	    return true; //if all the questions are answered correctly, then the skill is successfully obtained
	}
		
		
	function skillsForAClass($courseid,$con) {
		//find all the skills'id of this course, put them in an array
		//return this array
		
		$arr = array();//initial an array to collect skill_id
		$sql = "SELECT Skill_ID FROM Skills WHERE Skills.Course_ID=$courseid"; //
		$result = $con->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$Skill_ID=$row["Skill_ID"];
				array_push($arr,$Skill_ID); //put the skill_id in the array
			}
			return $arr;
		}
		else {echo 'no skills for this class';} //if there is no skills, return 
	}
	
	
	function printlist($arr){
		//print out all the elements of an array
		if (sizeof($arr)===0) {echo '<li>No Skills</li>';}
		else {
			foreach ($arr as $a) {
				echo "<li>".$a."</li>";
				}
		}
	}
	

	function listskills2($con,$Course_ID,$Student_ID){
		//returns what skills a student acquired from a course

		$skill_id_list = skillsForAClass($Course_ID,$con);
		$get = array(); //skills accomplished
		$notget = array(); //skills not yet accomplished
		foreach ($skill_id_list as $skill_id) {
			$id = (int) $skill_id;
			$sql="SELECT Skill_Name FROM Skills WHERE Skill_ID = $id"; //retrieve all the skills' names of the course
			$result = $con->query($sql);
			if ($result->num_rows > 0) {
	    		while($row = $result->fetch_assoc()) {
					$Skill_Name= $row["Skill_Name"]; 
					if (isAcquired($Student_ID,$skill_id,$con)) { //If all the questions of this skill are answered correctly, the skill is obtained.
						array_push($get,$Skill_Name);  			//add the skill to $get array
					
						} 
					else {//If not all the questions of the skill is finished, the skill is not yet obtained. 
						array_push($notget,$Skill_Name); //add the skill to $notget array
						}
				}
			}
		}
		return $get;
	}
		
		
	function listskills($con,$Course_ID,$Student_ID){
		//list what skills a student acquired from a course
		//list what skills a student hasn't acquired from a course
		
		$skill_id_list = skillsForAClass($Course_ID,$con);
		$get = array(); //skills accomplished
		$notget = array(); //skills not yet accomplished
		foreach ($skill_id_list as $skill_id) {
			$id = (int) $skill_id;
			$sql="SELECT Skill_Name FROM Skills WHERE Skill_ID = $id"; //retrieve all the skills' names of the course
			$result = $con->query($sql);
			if ($result->num_rows > 0) {
	    		while($row = $result->fetch_assoc()) {
					$Skill_Name= $row["Skill_Name"]; 
					if (isAcquired($Student_ID,$skill_id,$con)) { //If all the questions of this skill are answered correctly, the skill is obtained.
						array_push($get,$Skill_Name);  			//add the skill to $get array 
						} 
					else {//If not all the questions of the skill is finished, the skill is not yet obtained. 
						array_push($notget,$Skill_Name); //add the skill to $notget array
						}
				}
			}
		}
		echo '<b>Finished Skills</b>';printlist($get);
		echo '<br>';
		echo '<b>Unfinished Skills</b>';printlist($notget);
	}
	
	function how_many_obtained_the_skill($skill_id,$cid,$con){
		
		//return the number of students within a class
		$count = 0;
		$sql = "SELECT Student_ID FROM Student_Classes WHERE Student_Classes.Class_ID= $cid";
		$result = $con->query($sql);
		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
				$student_id= $row["Student_ID"]; 
				if (isAcquired($student_id,$skill_id,$con)) { //If all the questions of this skill are answered correctly, the skill is obtained.
					$count++;//update 
					} 
			}
		}
		return $count;
	}
	
	
	function all_student_progress($Course_ID,$class_id,$con) {
		//print out a general overview of students' progress in a class
		echo "Number of students obtained each skill:<br>";
		$skill_id_list = skillsForAClass($Course_ID,$con);
		$total_skill=sizeof($skill_id_list);
		foreach ($skill_id_list as $skill_id) {
			$result = mysqli_query($con,"SELECT Skill_Name FROM Skills WHERE Skill_ID=$skill_id");
			$row = mysqli_fetch_row($result);
			$num = how_many_obtained_the_skill($skill_id,$class_id,$con);
			echo '<li>'.$row[0].': '.$num.' </li>';
		}
		
	}
	
	function countStudent($classid,$con){
		//return the total number of students of a class	
		$sql="SELECT COUNT(Student_ID) FROM Student_Classes WHERE Student_Classes.Class_ID=$classid";
		$result = mysqli_query($con,$sql);
		$c = mysqli_num_rows($result);
		echo $c;	
	}
	
	
	?>