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
	$text = mysqli_real_escape_string($con, $_POST['text']);
	$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+6, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
	$art = "SELECT aid from article ORDER BY aid DESC";	
	$sql = mysqli_query($con,$art);
	$numofart=mysqli_fetch_array($sql);
	//$art_num = mysqli_num_rows($sql);
	//echo $numofart['aid'];
	$article = $numofart['aid']+1;
	//echo $article;
	$insert1="	INSERT INTO article (aid,content,post_time,uid)
				VALUES ('$article','$text','$datetime','$uid')";	
	if (!mysqli_query($con,$insert1)) {die('Error: ' . mysqli_error($con));}
	echo"add article succeccfully!<br/>";
	
	
	
	$link= $_SESSION['uid'];
    	echo "<a href=\"timeline.php?uid=$link\">Back to TIMELINE</a>";
		echo "<br/>";	

?>
</html>