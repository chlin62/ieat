<!doctype html>
<html>
<head>
</head>
<?php 
	session_start();
	if($_SESSION['level']!='SuperUser')
		header("lacation : login.php");
	include("mysql_connect.php");
	
	if($_GET['delete']){
		$TM_ID=$_GET['delete'];
		mysql_query("delete from today_menu where TM_ID=$TM_ID and TM_DATE=curdate();")or die(mysql_error());
		header("location : today_order_superuser.php");
	}else
		header("location : today_order_superuser.php");
	
?>


<body>

</body>
</html>