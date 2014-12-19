<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
<?php
	session_start(); 
	if($_SESSION['level']!='SuperUser')
		header("lacation : login.php");
	include("mysql_connect.php");
	/*
	foreach($_GET as $value)
		echo $value;
	*/
	if(!isset($_GET['delete']))
		header("location : menu.php");
	$P_ID=$_GET['delete'];
	$V_ID=$_GET['V_ID'];
	mysql_query("delete from product where P_ID=$P_ID;")or die(mysql_error());
	header("location : menu_show.php?V_ID=$V_ID");
?>
</body>
</html>