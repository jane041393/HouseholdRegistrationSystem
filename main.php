<?php session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){
	$_SESSION['username']=$_POST['username'];
	$_SESSION['password']=$_POST['password'];
}

?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<style>
table,th,td
{
border:1px solid black;
}
</style>
</head>
<body>
<?php
$host ="localhost";
$username = "dbuser";
$password = "dbuser";
$database = "db_0010145";


	echo '<div id="container">';
$con = mysqli_connect($host, $username, $password, $database);
if(mysqli_connect_errno($con)){
	echo "Fail to connect to MySQL: ".mysqli_connect_error();
	}

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
$ps = md5($_SESSION['password']);
}


if(!isset($_SESSION['username']) && !isset($_SESSION['password'])){ 
	echo " you have not log in! <br/>";
	echo '<a href="index.php">Back to Login Interface</a>';
}

if(isset($_SESSION['username']) && isset($_SESSION['password'])){
	$sql = "SELECT username,uid,email,isadmin FROM users WHERE username='".$_SESSION['username']."'AND password='".$ps."'";
	$result=mysqli_query($con,$sql);
	
	
	if($row=mysqli_fetch_array($result)){
		$_SESSION['email']=$row['email'];
		$_SESSION['uid']=$row['uid'];
		$_SESSION['isadmin']=$row['isadmin'];

		$userinfo = "SELECT name,sex,birthday,hid FROM personal_info WHERE uid='".$_SESSION['uid']."'";
		$result1=mysqli_query($con,$userinfo);
		$user=mysqli_fetch_array($result1);
		$_SESSION['name']=$user['name']; $_SESSION['sex']=$user['sex']; $_SESSION['birthday']=$user['birthday'];
		$_SESSION['hid']=$user['hid'];
		
		$houseinfo = "SELECT address,size,city FROM household WHERE hid='".$user['hid']."'";
		$result2=mysqli_query($con,$houseinfo);
		$house=mysqli_fetch_array($result2);
		$_SESSION['address']=$house['address']; $_SESSION['size']=$house['size']; $_SESSION['city']=$house['city'];
		
		echo '<div id="header">';
		echo"<p>Welcome ".$_SESSION['username']."!</p>";
		echo '</div>';
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$mod = "SELECT uid,name,modtime FROM personal_info ORDER BY modtime DESC";
		$modresult=mysqli_query($con,$mod);

		/*if is admin*/
		echo '<div id="rightnav">';
		if($_SESSION['isadmin']==1){
			
			echo "<table>";
			echo "<tr>";
			echo "<th>latest modified users:<br/></th>";
			echo "</tr>";
			for($i=0;$i<5;$i++){
				$moduser=mysqli_fetch_array($modresult);
				$flag = $moduser['uid'];
				echo "<tr>";
				echo "<td>".$moduser['uid']." ".$moduser['name']." ".$moduser['modtime']."<a href=\"userinfo.php?uid=$flag\">"  .$moduser['name']."</a></td>";
				echo "</tr>";
				echo "<br/>";
			}
			echo "</table>";
			
			echo"<form action=\"userinfo.php\" method=\"get\">";
			echo"Search : <input type=\"text\" name=\"uid\"/>";
			echo"<input type=\"submit\"/><br/>";
			echo"</form>";
			
			
			/*create a new houseword*/
			echo"<br/>create a new household!";
			echo"<form action=\"newhousehold.php\" method=\"post\"><br/>";
			echo"Hid: <input type=\"text\" name=\"hid\"/><br/>";
			echo"Address: <input type=\"text\" name=\"address\"/><br/>";
			echo"size: <input type=\"text\" name=\"size\"/><br/>";
			echo"city: <input type=\"text\" name=\"city\"/><br/>";
			echo"headid: <input type=\"text\" name=\"headid\"/><br/>";
			echo"<input type=\"submit\"/><br/>";
			echo"</form>";
			
			/*update user info*/
			
			echo '<a href="updateinfo.php">Update user info!</a>';
			echo "<br/>";
			echo '<a href="updatehousehold.php">Update household info!</a>';
			
			
			/*enter user's uid and time interval*/
			echo"<br/><br/>Enter user's uid and time interval to show the modinfo of user!";
			echo"<form action=\"u_modinfo.php\" method=\"post\"><br/>";
			echo"User's uid: <input type=\"text\" name=\"u_uid\"/><br/>";
			echo"Time interval:<br/>";
			echo"start time: <input type=\"text\" name=\"us_time\"/><br/>";
			echo"end time: <input type=\"text\" name=\"uf_time\"/><br/>";
			echo"<input type=\"submit\"/><br/>";
			echo"</form>";
			echo"<br/>";
			
			
			/*enter hid to show member changes*/
			echo"<br/><br/>Enter hid to show member changing!";
			echo"<form action=\"admin_memberchange.php\" method=\"post\"><br/>";
			echo"Hid: <input type=\"text\" name=\"admin_hid\"/><br/>";
			echo"<input type=\"submit\"/><br/>";
			echo"</form>";
			echo"<br/>";
			
			
		}
		
		/*if ishousehold head*/
		$ishead = "SELECT hid,headid FROM household WHERE headid='".$_SESSION['uid']."'";
		$r_ishead=mysqli_query($con,$ishead);
		$check=mysqli_fetch_array($r_ishead);
		
		
		if($check!=NULL){
			echo"<br/><br/>Enter the time to show household member:";
			echo"<form action=\"head_household.php\" method=\"post\"><br/>";
			echo"Time: <input type=\"text\" name=\"head_time\"/><br/>";	
			echo"<input type=\"submit\"/><br/>";
			echo"</form>";
			echo"<br/>";
			
		}
		
		
		
		
		
		//$sql = "SELECT username,uid,email,isadmin FROM users WHERE username='".$_POST['username']."'AND password='".$ps."'";
		//$result=mysqli_query($con,$sql);
		//if($row=mysqli_fetch_array($result)){
			
		
		/*enter time interval*/
		echo"<br/><br/>Enter time interval to find your own modfication! ex:2014-04-01 23:59:59 (Please enter the form like this)<br/>";
		echo"<form action=\"modinfo.php\" method=\"post\"><br/>";
		echo"Start time: <input type=\"text\" name=\"s_time\"/><br/>";
		echo"End time: <input type=\"text\" name=\"f_time\"/><br/>";
		echo"<input type=\"submit\"/><br/>";
		echo"</form>";
		
		echo '</div>';
		/*
		$housemember = "SELECT name,uid FROM personal_info WHERE hid='".$_SESSION['hid']."'";
		$resultuser=mysqli_query($con,$housemember);
		$num=mysqli_num_rows($resultuser);
		$judge=1;
		echo '<div id="body">';
		echo "<table>";
		echo "<tr>";
		echo "<th>Household members:</th><br/>";
		echo "</tr>";
		while($judge<=$num){
			$row1=mysqli_fetch_array($resultuser);
			$house="SELECT uid,username FROM users WHERE uid='".$row1['uid']."'";
			$ans=mysqli_query($con,$house);
			$member=mysqli_fetch_array($ans);
			$link = $member['uid'];
			echo "<tr>";
			echo "<td><a href=\"userinfo.php?uid=$link\">".$member['username']."</a></td>";
			echo "</tr>";
			echo "<br/>";
			$judge++;
		
    	}
    	echo "</table>";
 
    	echo '</div>';
    	*/
    	$flag1 = $_SESSION['uid'];
		$flag2 = $_SESSION['name'];
		echo '<div id="leftnav">';
		echo "<br/>";
		echo "<a href=\"userinfo.php?uid=$flag1\">User info</a>";
		echo "<br/>";
		echo "<a href=\"householdinfo.php?name=$flag2\">Household Info</a>";
		echo "<br/>";
		echo '<a href="logout.php">Logout</a>';
		echo '</div>';
    	
    	
    	
    	
    	
    	
    	
    	
    	$housemember = "SELECT name,uid FROM personal_info WHERE hid='".$_SESSION['hid']."'";
		$resultuser=mysqli_query($con,$housemember);
		$num=mysqli_num_rows($resultuser);
		$judge=1;
		echo '<div id="body">';
		
		echo "Household members:<br/>";
		
		while($judge<=$num){
			$row1=mysqli_fetch_array($resultuser);
			$house="SELECT uid,username FROM users WHERE uid='".$row1['uid']."'";
			$ans=mysqli_query($con,$house);
			$member=mysqli_fetch_array($ans);
			$link = $member['uid'];
			echo "<a href=\"userinfo.php?uid=$link\">".$member['username']."</a>";
			echo "<br/>";
			$judge++;
		
    	}
    	echo "</table>";
 		

 		echo"<br/>";
 		//echo"Go to my timeline:"
 		//echo '<a href="timeline.php">Go to my timeline</a>';
 		//$timeline='TIMELINE';
 		
 		$link= $_SESSION['uid'];
    	echo "<a href=\"timeline.php?uid=$link\">TIMELINE</a>";
		echo "<br/>";
    	
    	//add friend!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    	
    	echo"<br/>";
    	echo"<br/>";
		echo"Add a friend:<br/>";
		echo"<form action=\"addfriend.php\" method=\"post\"><br/>";
		echo"friend's uid: <input type=\"text\" name=\"f_uid\"/><br/>";
		echo"Relation: <input type=\"text\" name=\"f_relation\"/><br/>";
		echo"<input type=\"submit\"/><br/>";
		echo"</form>";
		echo '</div>';
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
		}
		else
		{
			echo "wrong password!<br/>";
			echo '<a href="index.php">Back to login</a>';
			session_destroy();
		}

		
	}
	
	

	echo '</div>';

mysqli_close($con);
?>
	



</body>
</html>