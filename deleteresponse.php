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
	
	
	
	
	
	
	//if(isset($_GET['response'])) echo"yea!";
	
	$uid=$_SESSION['uid'];
	$response=$_GET['response'];	
	$delete="DELETE FROM reply WHERE rid='$response'";
	//$delete_response="DELETE FROM response WHERE aid='$post'";
	if (!mysqli_query($con,$delete)) {die('Error: ' . mysqli_error($con));}
	//if (!mysqli_query($con,$delete_response)) {die('Error: ' . mysqli_error($con));}
	echo"delete response succeccfully!<br/>";
	
	
	$link= $_SESSION['uid'];
    echo "<a href=\"timeline.php?uid=$link\">Back to TIMELINE</a>";
	echo "<br/>";	

?>
</html>