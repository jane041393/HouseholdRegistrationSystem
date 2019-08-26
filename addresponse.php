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
	$text=$_POST['text'];
	$aid=$_POST['postid'];
	$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+6, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
	
	$comment = "SELECT rid FROM reply ORDER BY rid DESC" ;
	$s=mysqli_query($con,$comment);
	$response=mysqli_fetch_array($s);
	$rid=$response['rid']+1;
	
	$insert1="	INSERT INTO reply (rid,aid,uid,text,response_time)
				VALUES ('$rid','$aid','$uid','$text','$datetime')";	
	if (!mysqli_query($con,$insert1)) {die('Error: ' . mysqli_error($con));}
	echo"add comment succeccfully!<br/>";
	
	
	
		$link= $_SESSION['uid'];
    	echo "<a href=\"timeline.php?uid=$link\">Back to TIMELINE</a>";
		echo "<br/>";	

?>
</html>