<?php session_start();?>
<html>
<head>
	<title>index</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="container"> 
	<div id="leftnav"> </div>
	<div id="rightnav"></div>
	
	
	
	<div id="header">
		<p>Login Interface</p>
	</div>
	
		<div id="body">
    	<form method="post" action="main.php">
    	<p>Account : <input type="text" name="username" /> </p> 
    	<p>Password: <input type="password" name="password" /></p>
    	<p><input type="submit" /> <br/></p>
    	</form>
    	</div>
    	
    	<div id="footer">
    	<?php
    	echo '<a href="register.php">Register new account</a>';
		?>
		</div>
		</div>
</body>
</html>