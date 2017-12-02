<!--
Team Ruby
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--This is supposed to be the page that displays a message when you successfully add a question in the question_editor.php
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
        h3 {
        text-align: center;
            color: darkblue;
    }
    a {
    color: darkblue;
    text-decoration:  none;
  font-weight:      bold;
    }
        
        a.goback {
            color:black;
        }
         div {
        text-align: center;
    }
    </style>
    <body>
          
        <?php
        session_start();
        $Course_ID=$_SESSION['Course_ID']; 
        $Skill_ID = $_SESSION['Skill_ID'];
        $Skill_Name = $_SESSION['Skill_Name'];
	   include 'db_connection.php';
	   $con=OpenCon();
            //Adds Question to Skill in DB
    function addQuestion($SID,$con) {
        $Question = $_POST['question_input']; 
        $Answer = $_POST['output_answer'];

        $sql = "INSERT INTO Questions(Question,Answer,Skill_ID) VALUES ('$Question','$Answer',$SID)"; 
        $result = $con->query($sql);
        
        //inserts new Question to DB
//        $sql = "SELECT Question FROM Questions WHERE Questions.Question=$Question"; 
//        if ($result-> num_rows > 0) {
//        while($row = $result->fetch_assoc()) {
//            $Question = $row["Question"];
//            echo '<a>'.$Question.'</a>';
//            }
//    }
        }
    
    addQuestion($Skill_ID,$con);
        echo '
        <h1>Skill: '.$Skill_Name.'</h1>
        <h1>Added Question:</h1>
        <h3>'.$_POST['question_input'].'</h3>
        <h1>Answer:</h1>
        <h3>'.$_POST['output_answer'].'</h3><br><br>
        <div><a href="skill_editor.php" class="previous">Go Back</a></div>';

?>
    </body>
</html>
