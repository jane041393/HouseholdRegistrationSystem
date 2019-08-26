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
	
	$f_uid = mysqli_real_escape_string($con, $_POST['f_uid']);
	//$headid = mysqli_real_escape_string($con, $_POST['headid']);
	$relation = mysqli_real_escape_string($con, $_POST['f_relation']);
	
	//echo $relation;
	
	
	$uid = $_SESSION['uid'];
		
		$check=0;
		
		//echo $f_uid;
		if($uid==$f_uid){
			$check=3;
		}
		else{
			
			$is_uid = "SELECT uid FROM personal_info";
			$resultuser=mysqli_query($con,$is_uid);
			$num=mysqli_num_rows($resultuser);
			$i=1;
			
		while($i<=$num){
			$row1=mysqli_fetch_array($resultuser);
			//echo $row1['uid'];
			//echo"<br/>";
			//$house="SELECT uid,username FROM users WHERE uid='".$row1['uid']."'";
			if($row1['uid']==$f_uid){
				$check=1;
				break;
			}
			//$ans=mysqli_query($con,$house);
			//$member=mysqli_fetch_array($ans);
			//$link = $member['uid'];
			//echo "<a href=\"userinfo.php?uid=$link\">".$member['username']."</a>";
			//echo "<br/>";
			$i++;
    	}
    	
		$is_uid1 = "SELECT uid,friend_uid FROM friend WHERE  uid ='".$uid."'";
		$resultuser1=mysqli_query($con,$is_uid1);
		$num1=mysqli_num_rows($resultuser1);
		$i1=1;
		while($i1<=$num1){
			$row2=mysqli_fetch_array($resultuser1);
			if($row2['friend_uid']==$f_uid){
				$check=2;
				break;
			}
			$i1++;
		}
		}
		
		if($check==1){
			echo"add a friend successfully!";
			$insert1="	INSERT INTO friend (uid, friend_uid, relation)
				VALUES ('$uid','$f_uid','$relation')";
			$insert2="	INSERT INTO friend (uid, friend_uid, relation)
				VALUES ('$f_uid','$uid','$relation')";
			if (!mysqli_query($con,$insert1)) {die('Error: ' . mysqli_error($con));}
			if (!mysqli_query($con,$insert2)) {die('Error: ' . mysqli_error($con));}

		}
		else if($check==3){
			echo"you can't add yourself!";
		}
		else if($check==2){
			echo"you are already friends!";
		}
		else{
			echo"no user's id!";
		}
		

		
		echo"<br/>";
		echo '<a href="main.php">Back to main!</a>';

?>
</html>