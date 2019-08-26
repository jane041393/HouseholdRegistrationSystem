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
	
	if($_POST['admin_hid'] == NULL)
	echo"no hid!<br/>";
	
	$hid=$_POST['admin_hid'];
	if($_POST['admin_hid']!=NULL){
		$sql = "SELECT uid,name,modtime,hid FROM pmod_history ORDER BY modtime ASC" ; 
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);
		$count=1;
		$arr_name = array();
		$arr_hid = array();
		$arr_uid = array();
		while($num>=$count){
			$row = mysqli_fetch_array($result);
			if(in_array($row['uid'], $arr_uid))
				$judge=1;
			else $judge=0;
			if($row['hid']== $hid && $judge==0  ){
				array_push($arr_name,$row['name']);
				array_push($arr_hid,$row['hid']);
				array_push($arr_uid,$row['uid']);
				$arrlength=count($arr_name);
				echo $row['modtime']."  ";
				for($x=0;$x<$arrlength;$x++){
  					echo $arr_name[$x];
  					echo "  ";
  		 		}
  		 		echo "<br/>";
			}
			$flag=0;
			$arrlength=count($arr_name);
			for($x=0;$x<$arrlength;$x++){
				if($row['uid']==$arr_uid[$x] && $row['hid']!=$arr_hid[$x]){
					$n = $x;
					$flag=1;
					for($i=$n;$i<$arrlength-1;$i++){
						$arr_name[$i]=$arr_name[$i+1];
						$arr_uid[$i]=$arr_uid[$i+1];
						$arr_hid[$i]=$arr_hid[$i+1];
						
					}
				}
			}
			if($flag==1){
				array_pop($arr_name);
				array_pop($arr_uid);
				array_pop($arr_hid);
				$length= count($arr_name);
				echo $row['modtime']."  ";
				for($k=0;$k<$length;$k++){
					echo $arr_name[$k];
  					echo "  ";
				}
				echo"<br/>";
			}
			
			$count++;
		}
		
		
	}
	
	
	
	echo '<a href="main.php">Back to main!</a>';
?>
</html>
