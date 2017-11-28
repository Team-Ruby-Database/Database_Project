<!DOCTYPE HTML>
<html>
    <head>
        <title>Added Skill</title>
    </head>
    <body>
        <?php
        session_start();
        $Course_ID=$_SESSION['Course_ID']; 
	   include 'db_connection.php';
	   $con=OpenCon();
        
        function insertSkill($CID,$con) {
            $input = $_POST['skill_name']; 
            $sql = "INSERT INTO Skills(Skill_Name,Course_ID) VALUES($input,$CID)"; //inserts new Skill to DB
            $result = $con->query($sql);
            echo '//inserted skill';
            
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
        insertSkill($Course_ID,$con);
        
        echo '
        <h1>Added Skill: .'$_POST["skill_name"].'</h1>
        <a href="php.html" class="previous">Go Back</a>
        ';
        
        ?>
    </body>



</html>



