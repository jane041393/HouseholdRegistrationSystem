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
	
	$start = strtotime($_POST['s_time']);
	$end = strtotime($_POST['f_time']);
	
	$mod = "SELECT modtime,name,sex,birthday,hid FROM pmod_history WHERE uid='".$_SESSION['uid']."'ORDER BY modtime ASC" ;
	$result = mysqli_query($con,$mod);
	$num = mysqli_num_rows($result);
	$count=1;


	if($_POST['s_time']!=NULL && $_POST['s_time']!=NULL ){
		$count1=1;
		while($count<=$num){
			$row=mysqli_fetch_array($result);
			$modtime = strtotime($row['modtime']);
			if(($modtime>=$start) && ($modtime<=$end) ){
					echo"mod".$count1.":<br/>";
					echo "name:".$row['name']."<br/>sex:".$row['sex']."<br/>birthday:".$row['birthday'].
					"<br/>hid:".$row['hid']."<br/>modtime:".$row['modtime']."<br/><br/>";
					$count1++;
			}
			$count++;
		}
		$realcount = $count1-1;
		echo "Modification time in the interval:".$realcount."<br/>";
		
		
	}
	if($_POST['s_time']==NULL || $_POST['s_time']==NULL){
			$count2=1;
		while($count2<=$num){
			$row1=mysqli_fetch_array($result);
			echo"mod".$count2.":<br/>";
			echo "name:".$row1['name']."<br/>sex:".$row1['sex']."<br/>birthday:".$row1['birthday'].
			"<br/>hid:".$row1['hid']."<br/>modtime:".$row1['modtime']."<br/><br/>";
			$count2++;
		}
		$rcount = $count2-1;
		echo "Total modification time:".$rcount."<br/>";
	}
	
	
	
	echo '<a href="main.php">Back to main!</a>';

?>
</html>