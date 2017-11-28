<!DOCTYPE html>
<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<head>
    <title>Add Question</title>
<style>
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
    $Skill_ID=$_SESSION['Skill_ID']; 
	include 'db_connection.php';
	$con=OpenCon();



echo '
<h2>Question Editor</h2>
<!--
<div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Select Skill</button>
  <div id="myDropdown" class="dropdown-content">
    <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
    <a href="#about">New Skill</a>
    <a href="#about">For Loops</a>
    <a href="#base">Functions</a>
  </div>
</div>
-->
    
<!--
<div>
<h3>Question Type</h3>
<form action="">
<!--  <input id="multiple_choice" type="radio" name="question_type" value="multiple_choice">Multiple Choice<br>-->
  <input type="radio" name="question_type" id="short_answer" value="short_answer">Short Answer<br>
  <input type="radio" name="question_type" id="output" value="output">Input/Output
</form>
</div>
-->
    


<!--Question-->
<div id='question_div' style='display:none'>
<h3>Question</h3>
    <textarea name="question_input" cols="40" rows="5"></textarea>
<!--    <br><button onclick="" >Submit</button>-->
</div>

<!--Multiple Choice-->
<!--
 <div id='multiple_choice_answer' style='display:none'>
<h3>Multiple Choice Answer</h3> 
<form action="/action_page.php">
    a. <input type="text" name="answer1"><br>
    b. <input type="text" name="answer2"><br>
    c. <input type="text" name="answer3"><br>
    d. <input type="text" name="answer4">
<br><br>
<input type="submit">
</form> 
</div>
-->

<!--Short Answer-->
<!--
<div id='short_answer_answer' style='display:none'>
    
<h3>Short Answer</h3>
    <textarea name="output_answer" cols="30" rows="1"></textarea>
</div>
-->

<!--Input/Output-->
<div id='output_answer' style='display:none'>
<h3>Output</h3>
    <textarea name="output_answer" cols="40" rows="5"></textarea>
</div>
<br><button onclick="addQuestion()" >Add Question</button>
    
    
<div>
<h3>All Questions</h3>
</div>

';    
    

    //displays all Questions in Skill
    function displayQuestions() {
        $sql = "SELECT Question, Question_ID, Questions.Question FROM Questions WHERE Questions.Skill_ID=$Skill_ID";

        $result = $con->query($sql);
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Question_ID = $row["Question_ID"];
            $Question=$row["Question"];
            echo '<a value="$Question_ID">"$Question"</a>';
            }
        }

    }

    displayQuestions();

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



    CloseCon($con);
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

