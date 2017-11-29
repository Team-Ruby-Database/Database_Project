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
//    $Skill_ID=$_SESSION['Skill_ID'];
	include 'db_connection.php';
	$con=OpenCon();
    
    echo '
<h1>Question Editor</h1>


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
<div class="tab"><button onclick="addQuestion()" >Add Question</button></div>
    
    
';
  

    //displays all Questions in Skill
    function displayQuestions($SID,$con) {
        $sql = "SELECT Question, Question_ID, Questions.Question FROM Questions WHERE Questions.Skill_ID=$SID";
        $result = $con->query($sql);
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Question_ID = $row["Question_ID"];
            $Question=$row["Question"];
            echo '<a>'.$Question.'</a><br>';
            }
        }

    }

//    displayQuestions(1,$con);

    //Adds Question to Skill in DB
    function addQuestion() {
        $Question = $_POST['question_input']; 
        $Answer = $_POST['output_answer'];

        $sql = "INSERT INTO Questions(Question,Answer,Skill_ID) VALUES ($Question,$Answer,$Skill_ID);"; //inserts new Question to DB

        $sql = "SELECT Question FROM Questions WHERE Questions.Question=$Question"; 
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Question = $row["Question"];
            echo '<a>"$Question"</a>';
            }
        }
    }

 
    echo '<div><a href="skill_editor.php" class="previous">Go Back</a><div>';
 ?>



<script>
    $(document).ready(function() {
   $('input[type="radio"]').click(function() {
//       if($(this).attr('id') == 'multiple_choice') {
//            $("#multiple_choice_answer").show();    
////           change to get element by
//       }
//
//       if($(this).attr('id') != 'multiple_choice') {
//            $("#multiple_choice_answer").hide();   
//       }
       
//       if($(this).attr('id') == "short_answer") {
//            $('#short_answer_answer').show();
//           $('#question_div').show();
//       }
//
//       if($(this).attr('id') != 'short_answer') {
//            $('#short_answer_answer').hide();
//           
//       }
//       if($(this).attr('id') == "output") {
//            $('#output_answer').show(); 
//           $('#question_div').show();
//       }
//
//       if($(this).attr('id') != 'output') {
//            $('#output_answer').hide(); 
//           
//       }
   });
});
    
  
    
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}
</script>

</body>
</html>


