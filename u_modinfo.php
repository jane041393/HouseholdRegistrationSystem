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

		/*check if threr is a user*/
		$user = "SELECT uid from users ";	
		$sql = mysqli_query($con,$user);
		$snum = mysqli_num_rows($sql);
		$i=1;
		$flag=0;
		while($i<=$snum){
			$row3=mysqli_fetch_array($sql);
			if($_POST['u_uid']==$row3['uid']){
				$flag=1;
			}
			$i++;
		}
		if($flag==0){
			echo"there is no such user!<br/>";
		}
		
		
		$u_start = strtotime($_POST['us_time']);
		$u_end = strtotime($_POST['uf_time']);
	
		$u_mod = "SELECT modtime,name,sex,birthday,hid FROM pmod_history WHERE uid='".$_POST['u_uid']."'ORDER BY modtime ASC" ;
		$u_result = mysqli_query($con,$u_mod);
		$u_num = mysqli_num_rows($u_result);
		$j=1;
		
		if($_POST['u_uid']!=NULL && $_POST['us_time']!=NULL && $_POST['uf_time']!=NULL && $flag==1){
			$j1=1;
			while($j<=$u_num){
			$row4=mysqli_fetch_array($u_result);
			$u_modtime = strtotime($row4['modtime']);
				if(($u_modtime>=$u_start) && ($u_modtime<=$u_end) ){
					echo"mod".$j.":<br/>";
					echo "name:".$row4['name']."<br/>sex:".$row4['sex']."<br/>birthday:".$row4['birthday'].
					"<br/>hid:".$row4['hid']."<br/>modtime:".$row4['modtime']."<br/><br/>";
					$j1++;
				}
			$j++;
			}
			$realj = $j1-1;
			echo "The user's modification time in the interval:".$realj."<br/>";
			
		}
		if($_POST['u_uid']!=NULL && $_POST['us_time']==NULL && $_POST['uf_time']==NULL && $flag==1){
			while($j<=$u_num){
			$row4=mysqli_fetch_array($u_result);
				echo"mod".$j.":<br/>";
				echo "name:".$row4['name']."<br/>sex:".$row4['sex']."<br/>birthday:".$row4['birthday'].
				"<br/>hid:".$row4['hid']."<br/>modtime:".$row4['modtime']."<br/><br/>";
					
			$j++;
			}
			$realj = $j-1;
			echo "The user's total modification time:".$realj."<br/>";
			
		}
		
		echo '<a href="main.php">Back to main!</a>';


?>
</html>