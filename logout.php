<?php session_start(); ?>
<html>
<body>

<?php
	echo "Goodbye!<br/>";
	echo '<a href="index.php">Back</a>';
	
	
	session_destroy();	
?>

</body>
</html>