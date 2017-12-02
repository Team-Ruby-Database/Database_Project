<html>
<body>

<h1>Help:</h1>
<p1>
    Help intructions:
</p1>
<br>
<br>
<?php $lastpage = $_POST['value']."php";
if($lastpage=='main_login')//page name
{
    echo "Please input your email and password correctly, and remember to choose the class you belong to (students or professors)";
}
else if($lastpage=="signup")
{
    echo "Please input your information correctly and make sure choose the right class you belong to (students or professors)";
}


?>

<br>

<a href=$lastpage>Back to the last page-></a>

</body>
</html>
