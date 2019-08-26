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
	
	echo"<form action=\"updateuser.php\" method=\"post\"><br/>";
	echo"<br/>Enter the following value:";
	echo"<br/>if want to keep the same,please enter the user's' old value<br/>";
	echo"Uid: <input type=\"text\" name=\"new_uid\"/><br/>";
	echo"Name: <input type=\"text\" name=\"new_name\"/><br/>";
	echo"Sex: <input type=\"text\" name=\"new_sex\"/><br/>";
	echo"Birthday: <input type=\"text\" name=\"new_bday\"/><br/>";
	echo"Hid: <input type=\"text\" name=\"new_hid\"/><br/>";
	echo"<input type=\"submit\"/><br/>";
	echo"</form>";	


?>
</html>