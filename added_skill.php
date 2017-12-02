<!--
Team Ruby
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--Inserts a skill into the database
-->


<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Added Skill</title>
    </head>
    <style>
      h1 {
        text-align: center;
    }
         div {
        text-align: center;
    }
    </style>
    <body>
        <?php
        session_start();
        $Course_ID=$_SESSION['Course_ID']; 
	   include 'db_connection.php';
	   $con=OpenCon();
        
        function insertSkill($CID,$con) {
            $input = $_POST['skill_name']; 
            $sql = "INSERT INTO Skills(Skill_Name,Course_ID) VALUES('$input',$CID)"; //inserts new Skill to DB
            $result = $con->query($sql);
           
            
            $sql = "SELECT Skill_ID, Skill_Name FROM Skills WHERE Skills.Skill_Name='$input'"; //displays new skill
            $result = $con->query($sql);
            if ($result-> num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $Skill_ID = $row["Skill_ID"];
                $Skill_Name=$row["Skill_Name"];
//                echo '<a href="question_editor.php?Skill_ID=$Skill_ID">'.$Skill_Name.'</a><br>';
                }
            }
        }
        insertSkill($Course_ID,$con);
        
        echo '
        <h1 align="center" >Added Skill: '.$_POST["skill_name"].'</h1>
        <div><a href="skill_editor.php" class="previous">Go Back</a><div>
        ';
        
        ?>
    </body>



</html>



