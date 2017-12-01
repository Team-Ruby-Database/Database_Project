<!--Team Ruby--
Yin Song, Victoria Cummings, Michelle Kim, Xiao Jiang
This file builds a connection to the database HackerTracker.
To use it, put this line on the top of your code:
include ‘db_connection.php’;
-->

<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "centre79,";
 $db = "HackerTracker";
 
 
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 /* or die("Connect failed: %s\n". $conn -> error); */
 
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
