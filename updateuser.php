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
	
	
	$new_uid = mysqli_real_escape_string($con, $_POST['new_uid']);
	$new_name = mysqli_real_escape_string($con, $_POST['new_name']);
	$new_sex = mysqli_real_escape_string($con, $_POST['new_sex']);
	$new_bday = mysqli_real_escape_string($con, $_POST['new_bday']);
	$new_hid = mysqli_real_escape_string($con, $_POST['new_hid']);
	
	
	/*check if there is an existing uid*/
	$uid = "SELECT uid from personal_info ";	
	$result = mysqli_query($con,$uid);
	$num = mysqli_num_rows($result);
	$count=1;
	$flag=0;
	while($count<=$num){
		$row=mysqli_fetch_array($result);
		if( $_POST['new_uid']==$row['uid']){
			$flag=1;
		}
		$count++;
	}
	if($flag==0){
		echo"There is something wrong with your info!<br/>";
	}
	
	
	
	
	
	
	
	
	if(($_POST['new_uid']!=NULL) && ($_POST['new_name']!=NULL) && ($_POST['new_sex']!=NULL) 
		&& ($_POST['new_bday']!=NULL) && ($_POST['new_hid']!=NULL)&& ($flag==1)){

		
		$update1="	UPDATE personal_info
		SET uid='$new_uid', name='$new_name', sex='$new_sex', birthday='$new_bday', hid='$new_hid'
		WHERE uid='$new_uid'";
		
		
		$his="SELECT * FROM pmod_history";
		$num1=mysqli_query($con,$his);
		$hisnum=mysqli_num_rows($num1)+1;		
		$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+6, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;

		
		$insert1="	INSERT INTO pmod_history (historyid,uid,name,sex,birthday,hid,modtime)
				VALUES ('$hisnum','$new_uid','$new_name','$new_sex','$new_bday','$new_hid','$datetime')";

				
		
		
		if (!mysqli_query($con,$update1)) {die('Error: ' . mysqli_error($con));}
		if (!mysqli_query($con,$insert1)) {die('Error: ' . mysqli_error($con));}
		
		echo"You have update!<br/>";
		
		}
		else{
			echo"please enter all the info!<br/>";
		}
		
		echo '<a href="main.php">Back to main!</a>';
	
	
	
	
	
		

?>
</html>