<?php
/*Team Ruby*/
/*
Victoria Cummings
Michelle Kim
Yin Song
Xiao Jiang

login  page
*/
?>
<?php
    include 'db_connection.php';
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
   <head>
      <title>HackerTracker</title>
     <?php /*<link href = "css/bootstrap.min.css" rel = "stylesheet">*/?>
      
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2>Welcome to HackerTracker! Please login...</h2> 
      <div class = "container form-signin">
         
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password']))
            {


   	        $dbname = "HackerTracker";

   		    mysql_select_db($dbname);

	        $username=$_POST['username'];
	        $password=$_POST['password'];
	        $identity=$_POST['class'];

	       if($identity=='professor')
	       {
			$query = mysql_query("SELECT username FROM Professors WHERE Professor_Email='$username' and Professor_Password='$password'");
			if(mysql_num_rows($query)!=0){
				$_SESSION['Professor_ID']=mysql_query("SELECT Professor_ID FROM Professors WHERE Professor_Email='$username'");
				header("Location: professorClasses.php?Professor_ID=$Professor_ID");
	
			}
			else{
				echo "Invalid username or password";
			}
	       }

	       if($identity=='student')
	       {
			$query = mysql_query("SELECT username FROM Students WHERE Student_Email='$username' and Student_Password='$password'");
			if(mysql_num_rows($query)!=0){
				$_SESSION['Student_ID']=mysql_query("SELECT Student_ID FROM Students WHERE Student_Email='$username'");
				header("Location: studentClasses.php?Student_ID=$Student_ID");
			}
			else{
				echo "Invalid username or password";
			}
			
	       }
				


            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
	    <br />
	    <input type="radio" name="class" value="professor">I am a professor <br>
	    <input type="radio" name="class" value="student"checked> I am a student<br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
			
         Click here to clean <a href = "logout.php" tite = "Logout">Session.

      </div> 
      
   </body>
</html>