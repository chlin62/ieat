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
		
	if(isset($_POST['insertMenu'])){//新增菜單有確實被點選
		$V_ID=$_POST['V_ID'];
		$P_NAME=$_POST['P_NAME'];
		$P_PRICE=$_POST['P_PRICE'];
		$insert = true;
		if($P_NAME==null){
			echo "<script>alert('品項不可為空!'); location.replace('menu_show.php?V_ID=$V_ID');</script>";
			$insert=false;
		}//	判斷品項是否為空
		if($P_NAME==null){
			echo "<script>alert('價格不可為空!'); location.replace('menu_show.php?V_ID=$V_ID');</script>";
			$insert=false;
		}//	判斷價格是否為空
		if(!is_numeric($P_PRICE)){
			echo "<script>alert('價格必須為數值!'); location.replace('menu_show.php?V_ID=$V_ID');</script>";
			$insert=false;
		}//判斷價格是否為數值
		if($insert){
			mysql_query("insert into product(P_NAME,P_PRICE,V_ID) values('$P_NAME',$P_PRICE,$V_ID);")or die(mysql_error());
			header("Location : menu_show.php?V_ID=$V_ID");
		}//成功加入
	}else
		header("Location : menu.php");

?>
</body>
</html>