<!doctype html>
<html>
<head>

<?php 
	session_start();
	if($_SESSION['level']!='SuperUser')
		header("lacation : login.php");
	include("mysql_connect.php");
	
	if($_GET['V_ID']){
		$V_ID=$_GET['V_ID'];
		$rs=mysql_query("select * from today_menu where V_ID=$V_ID and TM_DATE=curdate();");
		$value=mysql_fetch_row($rs);
		if(!isset($value[0])){
		mysql_query("insert into today_menu(V_ID,TM_DATE) values ($V_ID,CURDATE());") or die(mysql_error());}
		header("location : today_order_superuser.php");
	}else
		header("location : today_order_superuser.php");
	
?>


<body>

</body>
</html>