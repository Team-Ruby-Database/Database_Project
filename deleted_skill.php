<!--
Team Ruby
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--Deletes a skill into the database
-->

<!DOCTYPE HTML>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Deleted Skill</title>
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
        $_SESSION['Skill_ID'] = $_GET['Skill_ID'];
        $Skill_ID=$_SESSION['Skill_ID'];
        
        $_SESSION['Skill_Name'] = $_GET['Skill_Name'];
        $Skill_Name=$_SESSION['Skill_Name'];
	   include 'db_connection.php';
	   $con=OpenCon();
        
       
        function deleteSkill($SN,$CID,$con) {
//            $input = $_POST['skill_name']; 
           
            $sql = "DELETE FROM Skills WHERE Skills.Skill_Name='$SN' AND Course_ID=$CID"; 
            if ($con->query($sql) === TRUE) {
            echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $con->error;
            }
            $result = $con->query($sql);
           
        }
        deleteSkill($Skill_Name,$Course_ID,$con);
        
        echo '
        <h1 align="center" >Deleted Skill: '.$Skill_Name.'</h1>
        <div><a href="skill_editor.php" class="previous">Go Back</a><div>
        ';
        
        ?>
    </body>



</html>



