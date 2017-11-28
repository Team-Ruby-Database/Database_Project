<!DOCTYPE html>
<html>
<head>
<title>Skills Editor</title>
</head>
<body>

<?php 
    session_start();
    $Course_ID=$_SESSION['Course_ID']; 

	include 'db_connection.php';
	$con=OpenCon();

    echo    
    '<h1>Skills Editor</h1>
    <form id="myForm" action="">
      <input type="text" name="skill_name" value="">
      <input type="button" onclick="resetForm()" name="submit_skill" value="Add Skill">
    </form>
    <br><br>
    <h3>Skills</h3>
    ';

    //displays all skills in course
    function displaySkills() {
        $sql = "SELECT Skill_ID, Skill_Name FROM Skills WHERE Skills.Course_ID=$Course_ID";

        $result = $con->query($sql);
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Skill_ID = $row["Skill_ID"];
            $Skill_Name=$row["Skill_Name"];
            echo '<a href='question_editor.php?Skill_ID=value value="$Skill_ID">"$Skill_Name"</a>';
            }
        }

        if(isset($_POST['Skill_ID'])) {
            $_SESSION['Skill_ID'] = $_POST['Skill_ID'];
        }
    }

    displaySkills();

    //Adds Skill to DB
    if(isset($_POST['submit_skill'])){
        $input = $_POST['skill_name']; 

        $sql = "INSERT INTO Skills(Skill_Name,Course_ID) VALUES($input,$Course_ID)"; //inserts new Skill to DB
       // displaySkills(); //re-displays everything


        $sql = "SELECT Skill_ID FROM Skills WHERE Skills.Skill_Name=$input"; //displays new skill
        if ($result-> num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $Skill_ID = $row["Skill_ID"];
            $Skill_Name=$row["Skill_Name"];
            echo '<a href='question_editor.php?Skill_ID=value value="$Skill_ID">"$Skill_Name"</a>';
            }
        }


    } 



    CloseCon($con);
?>
    
 
<script>
function resetForm() {
    document.getElementById("myForm").reset();
}
</script>

   
</body>
</html>
