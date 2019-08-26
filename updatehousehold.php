<?php session_start(); ?>
<html>
<?php
	$host ="localhost";
	$username = "dbuser";
	$password = "dbuser";
	$database = "db_0010145";
	$con = mysqli_connect($host, $username, $password, $database);
	if(mysqli_connect_errno($con)){
		echo "Fail to connect to MySQL: ".mysqli_connect_error();
	}
	
	echo"<form action=\"updatehouseholdinfo.php\" method=\"post\"><br/>";
	echo"Which hid do you want to change: <input type=\"text\" name=\"hid\"/><br/>";
	echo"New headid: <input type=\"text\" name=\"headid\"/><br/>";
	echo"<input type=\"submit\"/><br/>";
	echo"</form>";	


?>
</html>