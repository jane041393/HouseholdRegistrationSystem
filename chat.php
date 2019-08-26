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
	
	
	
	if(isset($_GET['uid']) && isset($_SESSION['uid'])){
		$_SESSION['friend_id']=$_GET['uid'];
		$uid=$_SESSION['uid'];
		$f_uid=$_GET['uid'];
		$message="SELECT uid,friend_uid,message,send_time from message ORDER BY send_time ASC";
		$sql=mysqli_query($con,$message);
		$num=mysqli_num_rows($sql);
		$count=1;
		while($count<=$num){
		$row=mysqli_fetch_array($sql);
		if($row['uid']==$uid && $row['friend_uid']==$f_uid){
			echo"<p align=\"left\">";
			//$select= "SELECT name FROM personal_info WHERE uid ='".$now_id."'" ;
			$name="SELECT name FROM personal_info WHERE uid='".$row['uid']."'";
			$name1=mysqli_query($con,$name);
			$name2=mysqli_fetch_array($name1);
			echo $name2['name']." say: ".$row['message']." at ".$row['send_time'];
			echo"<br/>";
			echo"</p>";
		}
		if($row['friend_uid']==$uid && $row['uid']==$f_uid){
			echo"<p align=\"right\">";
			$name="SELECT name FROM personal_info WHERE uid='".$row['uid']."'";
			$name1=mysqli_query($con,$name);
			$name2=mysqli_fetch_array($name1);
			echo $name2['name']." say: ".$row['message']." at ".$row['send_time'];
			echo"<br/>";
			echo"</p>";			
		}
		$count++;
	}

	echo"<form method=\"post\" action=\"chat.php\">";
	echo"say something:";
	echo"<textarea name=\"message\" rows=\"1\" cols=\"50\">";
	echo"</textarea>";
	echo"<input type=hidden name=\"id\" value='$f_uid'>";
	echo"<input type=\"submit\">";
	echo"</form>";
	
	
		
	}
	
	
	if(isset($_POST['id'])&&  isset($_POST['message'])  &&   isset($_SESSION['uid'])){
		$uid=$_SESSION['uid'];
		$text = $_POST['message'];
		$f_id=$_POST['id'];
		$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+6, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
		$insert1="	INSERT INTO message (uid,friend_uid,message,send_time)
				VALUES ('$uid','$f_id','$text','$datetime')";	
		if (!mysqli_query($con,$insert1)) {die('Error: ' . mysqli_error($con));}
		
		
		$message="SELECT uid,friend_uid,message,send_time from message ORDER BY send_time ASC";
		$sql=mysqli_query($con,$message);
		$num=mysqli_num_rows($sql);
		$count=1;
		while($count<=$num){
		$row=mysqli_fetch_array($sql);
		if($row['uid']==$uid && $row['friend_uid']==$f_id){
			echo"<p align=\"left\">";
			$name="SELECT name FROM personal_info WHERE uid='".$row['uid']."'";
			$name1=mysqli_query($con,$name);
			$name2=mysqli_fetch_array($name1);
			echo $name2['name']." say: ".$row['message']." at ".$row['send_time'];
			echo"<br/>";
			echo"</p>";
		}
		if($row['friend_uid']==$uid && $row['uid']==$f_id){
			echo"<p align=\"right\">";
			$name="SELECT name FROM personal_info WHERE uid='".$row['uid']."'";
			$name1=mysqli_query($con,$name);
			$name2=mysqli_fetch_array($name1);
			echo $name2['name']." say: ".$row['message']." at ".$row['send_time'];
			echo"<br/>";
			echo"</p>";			
		}
		$count++;
	}	
		$message1="SELECT uid,friend_uid,message,send_time from message ORDER BY send_time DESC";
		$sql1=mysqli_query($con,$message1);
		$row1=mysqli_fetch_array($sql1);
		$id=$row1['friend_uid'];
		echo"<form method=\"post\" action=\"chat.php\">";
		echo"say something:";
		echo"<textarea name=\"message\" rows=\"1\" cols=\"50\">";
		echo"</textarea>";
		echo"<input type=hidden name=\"id\" value='$id'>";
		echo"<input type=\"submit\">";
		echo"</form>";
		
	}
	
	echo"<br/>";
	$link= $_SESSION['uid'];
    echo "<a href=\"timeline.php?uid=$link\">Back to TIMELINE</a>";
	echo "<br/>";
	
	

?>
</html>