<?php session_start(); ?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if( !isset($_SESSION['username']) ){
	echo"You have not log in!<br/>";
	echo '<a href="index.php">Login Interface</a>';
}

if(isset($_SESSION['name']) && $_GET['name']){
	$host ="localhost";
	$username = "dbuser";
	$password = "dbuser";
	$database = "db_0010145";
	$con = mysqli_connect($host, $username, $password, $database);
	if(mysqli_connect_errno($con)){echo "Fail to connect to MySQL: ".mysqli_connect_error();}
	echo '<div id="header"><p>';
	echo $_GET['name'];
	echo "<br/>";
	echo '</div></p>';
	
	echo '<div id="rightnav">';
	echo "<br/>House Info<br/>";
	
	$key = $_GET['name'];
	$houseid = "SELECT hid FROM personal_info WHERE name ='".$key."'";
	$rhid=mysqli_query($con,$houseid);
	$hid=mysqli_fetch_array($rhid);
	
	
	$houseinfo = "SELECT hid,address,size,city FROM household WHERE hid ='".$_SESSION['hid']."'";
	$rhouse=mysqli_query($con,$houseinfo);
	$house=mysqli_fetch_array($rhouse);	
	echo "House id : ".$house['hid']."<br/>";
	echo "Address : ".$house['address']."<br/>";
	echo "Size : ".$house['size']."<br/>";
	echo "City : ".$house['city']."<br/>";
	echo "<br/>";
	echo '</div>';
	
	$hmember = "SELECT name,uid FROM personal_info WHERE hid ='".$_SESSION['hid']."'";
	$mem=mysqli_query($con,$hmember);
	$num=mysqli_num_rows($mem);
	$judge=1;
	
	echo '<div id="leftnav">';
	echo "My household members are : <br/>";
	while($judge<=$num){
		$housemem=mysqli_fetch_array($mem);
		$link = $housemem['uid'];
		echo "<a href=\"userinfo.php?uid=$link\">".$housemem['name']."</a>";
		echo "<br/>";
		$judge++;
	}
	echo '</div>';
	$flag=$_SESSION['uid'];
	
	echo '<div id="body">';
	echo "<br/>";
	echo "<a href=\"userinfo.php?uid=$flag\">User Info</a>";
	echo "<br/>";
	echo '<a href="main.php">Go to Main</a>';
	echo "<br/>";
	echo '<a href="logout.php">Logout</a>';
	echo '</div>';
	
}













?>

</body>
</html>