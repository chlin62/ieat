<?php 
	include("mysql_connect.php");
	
	if(isset($_GET['MBR_NUM'])){
		$MBR_NUM=$_GET['MBR_NUM'];
		mysql_query("delete from menber where MBR_NUM=$MBR_NUM")or die(mysql_error());
		//echo "<script>alert('刪除成功!');location.replace('alter.php');</script>";
		header("location : alter.php");
	}else{
	header("location : login.php");
	}

?>