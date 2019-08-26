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
	
	$hid = mysqli_real_escape_string($con, $_POST['hid']);
	$headid = mysqli_real_escape_string($con, $_POST['headid']);
	
	$update1="	UPDATE household
		SET headid='$headid'
		WHERE hid='$hid'";
		
		if (!mysqli_query($con,$update1)) {die('Error: ' . mysqli_error($con));}
		
		echo '<a href="main.php">Back to main!</a>';

?>
</html>