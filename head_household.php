<?php session_start(); ?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<?php
	$host ="localhost";
	$username = "dbuser";
	$password = "dbuser";
	$database = "db_0010145";
	$con = mysqli_connect($host, $username, $password, $database);
	if(mysqli_connect_errno($con)){
		echo "Fail to connect to MySQL: ".mysqli_connect_error();
	}
	
	if($_POST['head_time']!=NULL){
		
	$now_time = strtotime($_POST['head_time']);
	
	$sql = "SELECT DISTINCT uid FROM pmod_history WHERE hid='".$_SESSION['hid']."'ORDER BY modtime ASC" ;  /*�䦳��L��J��hid���H*/
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	$count=1;
	echo '<div id="header"><p>';
	echo"Member at time ".$_POST['head_time']."<br/>";
	echo '</p></div>';
	while($count<=$num){
		$row=mysqli_fetch_array($result);
		$sql2 = "SELECT hid,uid,name,modtime FROM pmod_history WHERE uid='".$row['uid']."'ORDER BY modtime DESC";  /*�C�@�Ӧ�Lhid���H��modtime�q�j�ƨ�p*/
		$result2 = mysqli_query($con,$sql2);
		$num2 = mysqli_num_rows($result2);
		$count2=1;
		echo '<div id="body"><center><font size:"30">';
		while($count2<=$num2){
			$row2=mysqli_fetch_array($result2);
			$modtime = strtotime($row2['modtime']);
			if($now_time>=$modtime ){     /*�����J�ɶ��٭n�p���Ĥ@��modtime*/
				if($row2['hid'] == $_SESSION['hid']) 
				echo"uid:".$row2['uid']."  name:".$row2['name']."<br/>";
			break;   /*�פ�while�j��*/
			}
			$count2++;
		}
		$count++;
		echo '</font></center></div>';
		
				
	}

	
	}
	echo '<div id="footer">';
	echo '<a href="main.php">Back to main!</a>';
	echo '</div>';

?>
</html>