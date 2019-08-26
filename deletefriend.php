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
	$d_friend=$_GET['uid'];	
	$delete1="DELETE FROM friend WHERE uid='$uid' AND friend_uid='$d_friend'";
	$delete2="DELETE FROM friend WHERE uid='$d_friend' AND friend_uid='$uid'";
	//$delete_response="DELETE FROM response WHERE aid='$post'";
	if (!mysqli_query($con,$delete1)) {die('Error: ' . mysqli_error($con));}
	if (!mysqli_query($con,$delete2)) {die('Error: ' . mysqli_error($con));}
	
	$delete3="DELETE FROM message WHERE uid='$uid' AND friend_uid='$d_friend'";
	$delete4="DELETE FROM message WHERE uid='$d_friend' AND friend_uid='$uid'";
	if (!mysqli_query($con,$delete3)) {die('Error: ' . mysqli_error($con));}
	if (!mysqli_query($con,$delete4)) {die('Error: ' . mysqli_error($con));}
	echo"delete friend succeccfully!<br/>";
	
	$link= $_SESSION['uid'];
    echo "<a href=\"timeline.php?uid=$link\">Back to TIMELINE</a>";
	echo "<br/>";	

?>
</html>