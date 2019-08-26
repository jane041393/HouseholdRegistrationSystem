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
	

	$uid=$_SESSION['uid'];
	$post=$_GET['postid'];	
	$delete="DELETE FROM article WHERE aid='$post'";
	$delete_response="DELETE FROM reply WHERE aid='$post'";
	if (!mysqli_query($con,$delete)) {die('Error: ' . mysqli_error($con));}
	if (!mysqli_query($con,$delete_response)) {die('Error: ' . mysqli_error($con));}
	echo"delete article succeccfully!<br/>";
	
	
	
	
	
	
	$link= $_SESSION['uid'];
    echo "<a href=\"timeline.php?uid=$link\">Back to TIMELINE</a>";
	echo "<br/>";	

?>
</html>