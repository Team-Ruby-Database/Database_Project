<!--
Team Ruby
--Victoria Cummings,Yin Song, Michelle Kim, Xiao Jiang
--Deletes a question from the database
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
        $_SESSION['Question_ID'] = $_GET['Question_ID'];
        $Question_ID=$_SESSION['Question_ID'];
        
	   include 'db_connection.php';
	   $con=OpenCon();
        
       
        function deleteQuestion($QID,$CID,$con) {
//            $input = $_POST['skill_name']; 
        
            $sql = "DELETE FROM Questions WHERE Question_ID=$QID"; 
            if ($con->query($sql) === TRUE) {
            echo "Question deleted successfully";
            } else {
                echo "Error deleting record: " . $con->error;
            }
            $result = $con->query($sql);
           
        }
        deleteQuestion($Question_ID,$Course_ID,$con);
        
        echo "
        <h1 align='center' >Deleted Question</h1>
        <div><a href='skill_editor.php' class='previous'>Go Back</a><div>
        ";
        
        ?>
    </body>



</html>



