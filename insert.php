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
		
		
		$r_user = mysqli_real_escape_string($con, $_POST['ruser']);
		$r_pw = mysqli_real_escape_string($con, md5($_POST['ruser']));
		$r_name = mysqli_real_escape_string($con, $_POST['rusername']);
		$r_sex = mysqli_real_escape_string($con, $_POST['rsex']);
		$r_birthday = mysqli_real_escape_string($con, $_POST['rbirthday']);
		$r_hid = mysqli_real_escape_string($con, $_POST['rhid']);
		$r_email = mysqli_real_escape_string($con, $_POST['remail']);
		
		
		
		
		
		/*check if there is an existing hid*/
		$ehid = "SELECT hid from household ";	
		$result = mysqli_query($con,$ehid);
		$hnum = mysqli_num_rows($result);
		$count=1;
		$flag=0;
		while($count<=$hnum){
			$row=mysqli_fetch_array($result);
			if($_POST['rhid']==$row['hid']){
				$flag=1;
			}
			$count++;
		}
		
		
		
		/*insert the value into table*/
		if(isset($_POST['rusername']) && isset($_POST['ruser']) && isset($_POST['rsex']) && isset($_POST['rbirthday']) 
		&& isset($_POST['remail']) && isset($_POST['rhid'])&& ($flag==1)){
			
			
			$user = "SELECT * FROM users";
			$num=mysqli_query($con,$user);
			$uid=mysqli_num_rows($num)+1;
			$isadmin=0;
			$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+6, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
			
			
			$his="SELECT * FROM pmod_history";
			$num1=mysqli_query($con,$his);
			$hisnum=mysqli_num_rows($num1)+1;
			
			
			
			$insert1="	INSERT INTO users (username,password,uid,email,isadmin)
				VALUES ('$r_user','$r_pw','$uid','$r_email','$isadmin')";
			$insert2="	INSERT INTO personal_info (uid,name,sex,birthday,hid,modtime)
				VALUES ('$uid','$r_name','$r_sex','$r_birthday','$r_hid','$datetime')";
			$insert3="	INSERT INTO pmod_history (historyid,uid,name,sex,birthday,hid,modtime)
				VALUES ('$hisnum','$uid','$r_name','$r_sex','$r_birthday','$r_hid','$datetime')";
			

	if (!mysqli_query($con,$insert1)) {die('Error: ' . mysqli_error($con));}
	if (!mysqli_query($con,$insert2)) {die('Error: ' . mysqli_error($con));}
	if (!mysqli_query($con,$insert3)) {die('Error: ' . mysqli_error($con));}
			
			echo "You have registered!<br/>";
			echo '<a href="index.php">Back to login</a>';
			
			}
		else{
			
			echo "there are something wrong with your info!<br/>";
			echo '<a href="register.php">register again!</a>';
		}



?>
</html>