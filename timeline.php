<?php session_start(); ?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php

if(isset($_SESSION['name']) && $_GET['uid']){
	$host ="localhost";
	$username = "dbuser";
	$password = "dbuser";
	$database = "db_0010145";
	$con = mysqli_connect($host, $username, $password, $database);
	if(mysqli_connect_errno($con)){echo "Fail to connect to MySQL: ".mysqli_connect_error();}
	
	echo '<div id="header"><p>';
	
	$now_name= "SELECT name FROM personal_info WHERE uid ='".$_GET['uid']."'" ;
	$b1=mysqli_query($con,$now_name);
	$row2=mysqli_fetch_array($b1);
	
	echo $row2['name'];
	echo "<br/>";
	echo '</div></p>';
	
	
	
	
	$now_id=$_GET['uid'];
	//$hmember = "SELECT name,uid FROM personal_info WHERE hid ='".$_SESSION['hid']."'";
	$friend = "SELECT friend_uid FROM friend WHERE uid ='".$_GET['uid']."'";
	$mem=mysqli_query($con,$friend);
	$num=mysqli_num_rows($mem);
	$judge=1;
	
	
	echo '<div id="leftnav">';
	
	if($_GET['uid']==$_SESSION['uid']){
	echo "<br/>Friend's timeline:<br/>";
	while($judge<=$num){
		$friendmem=mysqli_fetch_array($mem);
		$link = $friendmem['friend_uid'];		
		$friend1 = "SELECT name FROM personal_info WHERE uid ='".$friendmem['friend_uid']."'";
		$mem1=mysqli_query($con,$friend1);
		$friendmem1=mysqli_fetch_array($mem1);
		echo "<a href=\"timeline.php?uid=$link\">".$friendmem1['name']."</a>";
		echo "<br/>";
		$judge++;
	}
	echo"<br/><br/>";
	
	
	}
	if($now_id!==$_SESSION['uid']){
		//echo '<div id="leftnav">';
		$link=$_SESSION['uid'];
		$word="My timeline";
		echo "<a href=\"timeline.php?uid=$link\">".$word."</a>";
		echo"<br/>";
		//echo"</div>";
	}
	
	echo '<a href="main.php">Main</a>';
	echo '</div>';
	}
	
	
	
	
	
	
	
	
	//right side!!!!!!!!!!!!!!!!!!!!!!!!!
	
	echo '<div id="rightnav">';
	//echo"Search article:<br/>";
	//echo"<form action=\"searcharticle.php\" method=\"post\"><br/>";
	//echo"<input type=\"text\" name=\"article\"/><br/>";
	//echo"<input type=\"submit\"/><br/>";
	//echo"</form>";
	
	
	
	//$now_id=$_GET['uid'];
	//$hmember = "SELECT name,uid FROM personal_info WHERE hid ='".$_SESSION['hid']."'";
	
	if($_GET['uid']==$_SESSION['uid']){
		$friend_chat = "SELECT friend_uid FROM friend WHERE uid ='".$_GET['uid']."'";
		$mem_chat=mysqli_query($con,$friend_chat);
		$num_chat=mysqli_num_rows($mem_chat);
		$count=1;
	echo "<br/>Friend:<br/>";
	while($count<=$num_chat){
		$friendmem_chat=mysqli_fetch_array($mem_chat);
		$link = $friendmem_chat['friend_uid'];		
		$friend_chat = "SELECT name FROM personal_info WHERE uid ='".$friendmem_chat['friend_uid']."'";
		$sql=mysqli_query($con,$friend_chat);
		$result=mysqli_fetch_array($sql);
		$word1="Chat";
		$word2="Delete";
		$friend_id=$friendmem_chat['friend_uid'];	
		echo $result['name'];
		echo "<br/>";
		echo "<a href=\"chat.php?uid=$link\">".$word1."</a>";
		echo " ";
		//echo " <A href=deletefriend.php?f_uid=$friend_id;>delete</A>";
		echo "<a href=\"deletefriend.php?uid=$link\">".$word2."</a>";
		echo "<br/>";
		$count++;
	}
	}

	echo '</div>';	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	echo'<div id="body">';
	if($now_id==$_SESSION['uid']){
		
	echo"<form method=\"post\" action=\"addarticle.php\">";
	echo"<font size=\"5\">Want to say: </font></br>";
	echo"<textarea name=\"text\" rows=\"5\" cols=\"50\">";
	echo"</textarea></br>";
	echo"<input type=\"submit\">";
	echo"</form>";
	
	
	$article5 = "SELECT aid,content,uid,post_time FROM article WHERE uid ='".$_SESSION['uid']."'ORDER BY post_time DESC" ;
	$a5=mysqli_query($con,$article5);
	$number5=mysqli_num_rows($a5);
	$j5=1;
	
	echo"<br/>";
	echo "Article : <br/>";
	while($j5<=$number5){
		$row5=mysqli_fetch_array($a5);
		//$link = $housemem['uid'];
		echo $row5['content'];
		echo"<br/>";
		echo"POST BY ";
		$select5= "SELECT name FROM personal_info WHERE uid ='".$_SESSION['uid']."'" ;
		$b5=mysqli_query($con,$select5);
		$row4=mysqli_fetch_array($b5);
		echo $row4['name'];
		echo" AT ";
		echo $row5['post_time'];
		echo"    ";
		$postid1 = $row5['aid'];
		
		echo " <A href=deletearticle.php?postid=$postid1 ;>delete</A>";
		//response!!!!!!!!!!!!!!!!!!!!!!!!!
		
		
		$comment = "SELECT rid,aid,uid,text,response_time FROM reply WHERE aid ='".$postid1."'ORDER BY response_time DESC" ;
		$s=mysqli_query($con,$comment);
		$numberofresponse=mysqli_num_rows($s);
		$k=1;
		echo"<br/>";
		while($k<=$numberofresponse){
			echo"<br/>";
			$response=mysqli_fetch_array($s);
			echo $response['text'];
			
			$selectname= "SELECT name FROM personal_info WHERE uid ='".$response['uid']."'" ;
			$how=mysqli_query($con,$selectname);
			$response1=mysqli_fetch_array($how);
			//echo $response1['name'];
			echo" REPLY BY";
			echo $response1['name'];
			echo" AT ";
			echo $response['response_time'];
			//$re_text=$response['response_time'];
			//echo"yes!";
			//$re_text=$response['text'];
			//$postid=$response['aid'];
			//echo"test is";
			//echo $text;
			//echo " <A href=deleteresponse.php?time=$time&postid=$postid ;>delete</A>";
			//$comment1 = "SELECT rid,aid,uid,text,response_time FROM reply WHERE response ='".$postid1."'ORDER BY rid DESC" ;
			//$s1=mysqli_query($con,$comment1);
			//$response2=mysqli_fetch_array($s1);
			$rid=$response['rid'];
			echo " <A href=deleteresponse.php?response=$rid ;>delete</A>";
			$k++;
			
		}
		
		
		
		
		
		
		echo"<form method=\"post\" action=\"addresponse.php\">";
		echo"Give comment: ";
		echo"<input type=\"hidden\" name=\"postid\" value=\"$postid1\">";
		echo"<textarea name=\"text\" rows=\"1\" cols=\"25\">";
		echo"</textarea>";
		echo"<input type=\"submit\">";
		echo"</form>";
		
		
		//echo "<a href=\"userinfo.php?uid=$link\">".$member['username']."</a>";
		
		
		
		
		
		//echo "<a href=\"userinfo.php?uid=$link\">".$housemem['name']."</a>";
		echo "<br/><br/>";
		$j5++;
	
	
	}
	}
	

	
	
	//$mod = "SELECT modtime,name,sex,birthday,hid FROM pmod_history WHERE uid='".$_SESSION['uid']."'ORDER BY modtime ASC" ;
	if($now_id!=$_SESSION['uid']){
		
	$article = "SELECT aid,content,uid,post_time FROM article WHERE uid ='".$now_id."'ORDER BY post_time DESC" ;
	$a=mysqli_query($con,$article);
	$number=mysqli_num_rows($a);
	$j=1;
	
	
	//echo'<div id="body">';
	echo"<br/>";
	echo "Article : <br/>";
	while($j<=$number){
		$row=mysqli_fetch_array($a);
		//$link = $housemem['uid'];
		echo $row['content'];
		echo"<br/>";
		echo"POST BY ";
		$select= "SELECT name FROM personal_info WHERE uid ='".$now_id."'" ;
		$b=mysqli_query($con,$select);
		$row1=mysqli_fetch_array($b);
		echo $row1['name'];
		echo" AT ";
		echo $row['post_time'];
		$postid1=$row['aid'];
		//show comment
		$comment = "SELECT rid,aid,uid,text,response_time FROM reply WHERE aid ='".$postid1."'ORDER BY response_time DESC" ;
		$s=mysqli_query($con,$comment);
		$numberofresponse=mysqli_num_rows($s);
		$k=1;
		echo"<br/>";
		while($k<=$numberofresponse){
			echo"<br/>";
			$response=mysqli_fetch_array($s);
			echo $response['text'];
			$selectname= "SELECT name FROM personal_info WHERE uid ='".$response['uid']."'" ;
			$how=mysqli_query($con,$selectname);
			$response1=mysqli_fetch_array($how);
			echo" REPLY BY";
			echo $response1['name'];
			echo" AT ";
			echo $response['response_time'];
			if($response['uid']==$_SESSION['uid']){
				//$comment1 = "SELECT rid,aid,uid,text,response_time FROM reply WHERE aid ='".$postid1."'ORDER BY rid DESC" ;
				//$s1=mysqli_query($con,$comment1);
				//$response2=mysqli_fetch_array($s1);
				$rid=$response['rid'];
				//$postid=$response['aid'];
				//echo " <A href=deleteresponse.php?time=$time&postid=$postid ;>delete</A>";
				echo " <A href=deleteresponse.php?response=$rid ;>delete</A>";
			}
			$k++;
			
		}
		
		
		
		
		
		
		
		
		
		
		//echo $postid;
		echo"<br/>";
		//response!!!!!!!!!!!!!!!!!!!!!!
		echo"<form method=\"post\" action=\"addresponse.php\">";
		echo"Give comment: ";
		echo"<input type=\"hidden\" name=\"postid\" value=\"$postid1\">";
		echo"<textarea name=\"text\" rows=\"1\" cols=\"25\">";
		echo"</textarea>";
		echo"<input type=\"submit\">";
		echo"</form>";
		
		
		
		echo "<br/><br/>";
		$j++;
	}
	}
	echo '</div>';
	
?>



</body>
</html>