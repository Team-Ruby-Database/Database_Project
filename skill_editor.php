<!DOCTYPE html>
<html>
<head>
<title>Skills Editor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
    <style>
    div {
        text-align: center;
    }
    
/* Style the buttons inside the tab */

    h1 {
        text-align: center;
    }
    h3 {
        text-align: center;
    
    }

    a {
    color: darkblue;
    text-decoration:  none;
  font-weight:      bold;
    }
        
        a.delete {
            color:darkred;
        }
        a.goback {
            color:black;
        }
        
    a:hover {
    color: lightblue;
    }
    
        
        
    
div.tab {
    border: 1px solid white;
    background-color: white;
   
}

div.tab button {
    background-color: black;
    color: yellow;
    padding: 9px 23px;
   
    border: none;
    outline: none;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
    font-size: 19px;
}
/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: white;
    color: yellow;
}
/* Create an active/current "tab button" class */
div.tab button.active {
    background-color: white;
     color: black;
}
    </style>
<body>
    

<?php 
    session_start();
    $Course_ID=$_SESSION['Course_ID']; 
	include 'db_connection.php';
	$con=OpenCon();
    echo    
    '<h1>Skills Editor</h1>
    <div><form id="myForm" action="added_skill.php" method="post">
      <input type="text" name="skill_name" value="">
<!--      <input type="button" onclick="resetForm()" name="submit_skill" value="Add Skill">-->
    <input type="submit" value="Add Skill">
    </form></div>
    <br><br>
    <h3>Skills</h3>
    ';
    //displays all skills in course
    function displaySkills($CID,$con) {
    	//echo 'now try function display all skills';
		$sql="SELECT Skill_Name,Skill_ID FROM Skills WHERE Skills.Course_ID=$CID";
		$result = $con->query($sql);
		
		
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Skill_ID = $row["Skill_ID"];
            $Skill_Name=$row["Skill_Name"];
            echo '<div><a href="question_editor.php?Skill_ID=$Skill_ID">'.$Skill_Name.'</a><a class="delete">  &#10006;</a><div><br>';
        }
        }
        if(isset($_GET['Skill_ID'])) {
            $_SESSION['Skill_ID'] = $_GET['Skill_ID'];
        }
    }
    displaySkills($Course_ID,$con);
    $_SESSION['Course_ID']=$Course_ID;

    //Adds Skill to DB
/*
    if(isset($_POST['submit_skill'])){
        $input = $_POST['skill_name']; 
        $sql = "INSERT INTO Skills(Skill_Name,Course_ID) VALUES($input,$Course_ID)"; //inserts new Skill to DB

        $sql = "SELECT Skill_ID FROM Skills WHERE Skills.Skill_Name=$input"; //displays new skill
       	$result = $con->query($sql);
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Skill_ID = $row["Skill_ID"];
            $Skill_Name=$row["Skill_Name"];
            echo '<a href="question_editor.php?Skill_ID=$Skill_ID">'.$Skill_Name.'</a><br>';
            }
        }
    } 
*/
    echo '<div><a class="goback" href="classDashboard.php" class="previous">Go Back</a><div>';
    CloseCon($con);
?>
    
 
<script>
function resetForm() {
    document.getElementById("myForm").reset();
}
</script>

   
</body>
</html>
