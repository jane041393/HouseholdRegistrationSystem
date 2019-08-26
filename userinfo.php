<?php session_start(); ?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
	echo '<div id="container">';
	if( !isset($_SESSION['username']) ){
	echo"You have not log in!<br/>";
	echo '<a href="index.php">Login Interface</a>';
}
	echo '<div id="header"><p>';
	echo "User information";
	echo '</p></div>';
	if(isset($_SESSION['username']) && $_GET['uid'] ){
		$host ="localhost";
		$username = "dbuser";
		$password = "dbuser";
		$database = "db_0010145";
		$con = mysqli_connect($host, $username, $password, $database);
		if(mysqli_connect_errno($con)){echo "Fail to connect to MySQL: ".mysqli_connect_error();}
		
		
		
		
		$key = $_GET['uid'];
		$userinfo = "SELECT name,sex,birthday FROM personal_info WHERE uid ='".$key."'";
		$useremail = "SELECT email FROM users WHERE uid='".$key."'";
		$resultinfo=mysqli_query($con,$userinfo);
		$resultemail=mysqli_query($con,$useremail);
		$row1=mysqli_fetch_array($resultinfo);
		$row2=mysqli_fetch_array($resultemail);
		echo '<div id="body"><p>';
		echo "Name: ".$row1['name']."<br/>";
		echo "Sex: ".$row1['sex']."<br/>";
		echo "Birthday: ".$row1['birthday']."<br/>";
		echo "Email: ".$row2['email']."<br/>";
		$link=$row1['name'];
		echo "<br/>";
		echo '</p></div>';
		
		
		
		echo '<div id="footer"><center>';
		echo '<a href="main.php">Go to Main</a>';
		echo "<br/>";
		echo "<a href=\"householdinfo.php?name=$link\">Household Info</a>";
		echo "<br/>";
		echo '<a href="logout.php">Logout</a>';
		echo '</center></div>';
		
		
		
		echo '</div>';
		mysqli_close($con);
}

?>

</body>
</html>