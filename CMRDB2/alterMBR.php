<!doctype html>
<html>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="themes/style.min.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
    <title>無標題文件</title>

</head>
<?php
	session_start();
	if($_SESSION['level']!='SuperUser')
		header("lacation : login.php");
	include("mysql_connect.php");
	$id=$_POST['select'];
	
	$rs=mysql_query("SELECT * FROM menber WHERE MBR_ID = '$id';")or die("die");
	
?>


<body>
<div data-role="page" data-theme="a">
   
   		 <div data-role="content"   class="ui-field-content">
        
         <form method="post" action="alterMBR.php" data-role="controlgroup" align="center"  data-type="horizontal">
         <div align="left " >
         <a href="alter.php" class="ui-btn ">上一頁</a>
         <?php
         	
			$value = mysql_fetch_row($rs);
			if($value==null)
				header("location : alter.php");
								
				echo "<label for='id'  algin='left'>使用者帳戶</label>";
				echo "<input type='text' value='$value[1]' name='ID' readonly='true' id='id'>";
				echo "<label for='password' algin='left'>使用者密碼</label>";
				echo "<input type='text' name='password' value='$value[2]' id='password'>";
				echo "<label for='name' algin='left'>使用者名稱</label>";
				echo "<input type='text' value='$value[3]' readonly='true' id='name'>";
				echo "<label for='level' algin='left'>使用者級別</label>";
				echo '<select name="level" id="level" width="100%" data-native-menu="false">';
				if($value[4]=="SuperUser"){
					echo '<option value="SuperUser">SuperUser</option>';
    				echo '<option value="NormalUser">NormalUser</option>';
				}else{
					echo '<option value="NormalUser">NormalUser</option>';
					echo '<option value="SuperUser">SuperUser</option>';
				}
				echo '</select><br/><br/><br/>';
				echo "<label for='email' algin='left'>E-mail</label>";
				echo "<input type='text' name='email' id='email' value='$value[5]'>";
				
				
			
		 ?>
         <input type="submit" value="Save" />
         </div>
         <form>
         
         <?php 
		 	$id=$_POST["ID"];
			$pwd=$_POST['password'];
			$level=$_POST['level'];
			$email=$_POST['email'];
			mysql_query("   UPDATE `menber` 
							SET `MBR_PWD`='$pwd',`MBR_LV`='$level',`MBR_EMAIL`='$email' 
							WHERE MBR_ID= '$id';") or die("do not");
			if($id!=null)
				echo"<script>alert('修改成功');location.replace('alter.php');</script>";
		 ?>
         
         	
         <div>
</div>
</body>
</html>