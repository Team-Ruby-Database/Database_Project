<!--Team Ruby Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
This page allows you to enter in questions and answers for a skill. It also displays all the questions that a skill has at the bottom. You can delete a question by clicking the "x" next to a question. The back button takes you to back to the skill editor.
-->

<!DOCTYPE html>
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
    <title>Add Question</title>
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
    div{
        text-align: center;
    }
    a {
        text-align: center;
    color: darkblue;
    text-decoration:  none;
  font-weight:      bold;
    }
        a.goback {
            color:black;
        }
        a.delete {
            color:darkred;
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
    
.dropbtn {
    background-color: #16D9CD;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #14BAB0;
}
#myInput {
    border-box: box-sizing;
    background-image: url('searchicon.png');
    background-position: 14px 12px;
    background-repeat: no-repeat;
    font-size: 16px;
    padding: 14px 20px 12px 45px;
    border: none;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f6f6f6;
    min-width: 230px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd}

.show {display:block;}
</style>
</head>
    
    
<body>

<?php 
    session_start();
    $Course_ID=$_SESSION['Course_ID'];
    //$Skill_ID=$_SESSION['Skill_ID'];
    $_SESSION['Skill_ID'] = $_GET['Skill_ID'];
    $Skill_ID=$_SESSION['Skill_ID'];
    $_SESSION['Skill_Name'] = $_GET['Skill_Name'];
    $Skill_Name=$_SESSION['Skill_Name'];
	include 'db_connection.php';
	$con=OpenCon();
    
    
    
    echo '
<h1>Question Editor</h1>

<div><form id="myForm" action="added_question.php" method="post">
<div id="question_div">
<h3>Question</h3>
    <textarea name="question_input" cols="40" rows="5"></textarea>
<!--    <br><button onclick="" >Submit</button>-->
</div>


<div id="output_answer">
<h3>Answer</h3>

    <textarea name="output_answer" cols="40" rows="5"></textarea>
</div>
<br>
<div class="tab"><button id="question_button" type="submit">Add Question</button></div>
</form></div>
    
    <br><br><h3>All Questions</h3>
';

    //displays all Questions in Skill
    function displayQuestions($SID,$con) {
        $sql = "SELECT Question, Question_ID, Questions.Question FROM Questions WHERE Questions.Skill_ID=$SID";
        $result = $con->query($sql);
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Question_ID = $row["Question_ID"];
            $Question=$row["Question"];
            
                  
             echo " <div><a>".$Question."</a>
            <a href='deleted_question.php?Question_ID=".$Question_ID."&Skill_ID=.".$SID."' class='delete'> &#10006;</a></div>";
            
            
            }
        }

    }
$_SESSION['Skill_ID'] = $_GET['Skill_ID'];
    $Skill_ID=$_SESSION['Skill_ID'];
    displayQuestions($Skill_ID,$con);


//    echo '<a>'.$Skill_ID.'</a>';
  
 
    echo '<div><a href="skill_editor.php" class="previous">Go Back</a><div>'
        
        ;
 ?>

<script type="text/javascript">
    document.getElementById("question_button").onclick = function () {
        location.href = "added_question.php";
    };
</script>

</body>
</html>




