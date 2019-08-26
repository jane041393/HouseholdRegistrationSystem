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
	
	
	/*check if there is the headid and no same headid*/
	$ehid = "SELECT hid,headid from household ";	
	$result = mysqli_query($con,$ehid);
	$hnum = mysqli_num_rows($result);
	$count=1;
	$flag=1;
	while($count<=$hnum){
		$row=mysqli_fetch_array($result);
		if($_POST['hid']==$row['hid'] || $_POST['headid']==$row['headid'] ){  /*hid,uid不能重複*/
			$flag=0;
		}
		$count++;
	}
	
	$euid = "SELECT uid from personal_info ";	
	$result1 = mysqli_query($con,$euid);
	$usernum = mysqli_num_rows($result1);
	$count1=1;
	$flag1=0;
	while($count1<=$usernum){
		$row1=mysqli_fetch_array($result1);
		if($_POST['headid']==$row1['uid']){   /*要有這個uid*/
			$flag1=1;
		}
		$count1++;
	}
	
	
	
	
	if(($flag==1) && ($flag1==1) && isset($_POST['hid']) && isset($_POST['address']) 
	&& isset($_POST['size']) &&isset($_POST['city']) && isset($_POST['headid']) ){
	$new_id = mysqli_real_escape_string($con, $_POST['hid']);
	$new_ad = mysqli_real_escape_string($con, ($_POST['address']));
	$new_size = mysqli_real_escape_string($con, $_POST['size']);
	$new_city = mysqli_real_escape_string($con, $_POST['city']);
	$new_headid = mysqli_real_escape_string($con, $_POST['headid']);
	
	$insert1="	INSERT INTO household (hid,address,size,city,headid) 
		VALUES('$new_id','$new_ad','$new_size','$new_city','$new_headid') ";
	
	if (!mysqli_query($con,$insert1)) {die('Error: ' . mysqli_error($con));}
	echo "You have create new household!<br/>";
	echo '<a href="main.php">Back to main!</a>';
	
	}
	else{
		echo "there are something wrong with your info!<br/>";
		echo '<a href="main.php">Back to main!</a>';
		
	}
	

?>
</html>