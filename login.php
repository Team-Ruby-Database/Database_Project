<?php
/* Adapted from https://www.tutorialspoint.com/php/php_login_example.htm
    also:https://www.w3tweaks.com/php/simple-php-login-and-logout-script-using-php-session-and-database-using-mysql.html */

/*Team Ruby*/
/*
Victoria Cummings
Michelle Kim
Yin Song
Xiao Jiang

login  page
*/
    include 'db_connection.php';
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en"><!--NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!
                    NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!
                    NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!
                    NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!
                    NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!
                    NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!
                    NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!NOT THE SAME AT ALL!!!
                    -->
   
   <head>
      <title>HackerTracker</title>
     <?php /*<link href = "css/bootstrap.min.css" rel = "stylesheet">*/?>

       <?php/*set up page style*/?>
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
      <div class = "container form-signin"> <!--call container form to collect login information such as
                                                    username, password, and identity class-->
         
         <?php
            $msg = '';
            /* if login button is clicked and username and password is not empty: */
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password']))
            {


   	        $dbname = "HackerTracker";

   		    mysql_select_db($dbname);
            /* set up variables to contain username, password, and identity class */
	        $username=$_POST['username'];
	        $password=$_POST['password'];
	        $identity=$_POST['class'];

	       if($identity=='professor')/*if identity is professor */
	       {
	           /* query the database with username and password in Professors table*/
			$query = mysql_query("SELECT username FROM Professors WHERE Professor_Email='$username' and Professor_Password='$password'");
			if(mysql_num_rows($query)!=0){
			    /*if the result is not 0, get professor ID and send the ID to professorClasses.php*/
				$_SESSION['Professor_ID']=mysql_query("SELECT Professor_ID FROM Professors WHERE Professor_Email='$username'");
				header("Location:professorClasses.php");/*?Professor_ID=$Professor_ID*/
	
			}
			else{
                /*if the result is 0, display error message*/

                echo "Invalid username or password";
			}
	       }

	       if($identity=='student')/*if identity is student */
	       {
               /* query the database with username and password in Students table*/

               $query = mysql_query("SELECT username FROM Students WHERE Student_Email='$username' and Student_Password='$password'");
			if(mysql_num_rows($query)!=0){
                /*if the result is not 0, get student ID and send the ID to studentrClasses.php*/
                $_SESSION['Student_ID']=mysql_query("SELECT Student_ID FROM Students WHERE Student_Email='$username'");
				header("Location:studentClasses.php");/*?Student_ID=$Student_ID*/
			}
			else{
                /*if the result is 0, display error message*/
				echo "Invalid username or password";
			}
			
	       }
				


            }
         ?>
      </div> <!-- /container -->

      <?php/*login information form collection*/?>
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  /*This action will send the
                                                                             form to this login.php file itself */
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
	    <br />
             <?php/*Let the user choose his/her class so that we can use his/her username and password
                    to determine in which specific table we should search*/?>
	    <input type="radio" name="class" value="professor">I am a professor <br>
	    <input type="radio" name="class" value="student"checked> I am a student<br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
			
         <!--Click here to clean <a href = "logout.php" tite = "Logout">Session.-->

      </div> 
      
   </body>
</html>