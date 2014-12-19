<!doctype html>
<html>
<head>
<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>點餐系統會員註冊</title>
		<link rel="stylesheet" href="themes/style.min.css" />
		<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<title>無標題文件</title>
</head>
<?php 
	session_start(); 
	include("mysql_connect.php");
?>
<body>
	<div data-role="page" data-theme="a">
   		 <div data-role="content"  align="center" class="ui-field-content">
         	<form method="post" action="register.php" data-role="controlgroup"  data-type="horizontal" >
            <div class="ui-field-body">
				<img src="images/cmrdb.png"/>
				<br/>
            	<label for='name' align="left">請輸入真實姓名:</label>
                <input type="text" name="name" id="name">
            	<label for="id" align="left" >使用者帳戶:</label>
                <input type="text" name="id" id="id" width="10%"/>
                <label for="pwd1" align="left" >密碼:</label>
                <input type="password" name="password" id="pwd1" width="10"/>
                <label for="pwd2" align="left" >再輸入一次密碼:</label>
                <input type="password" name="password2" id="pwd2" width="10"/>
                <label for="email" align="left" >請輸入E-mail:</label>
                <input type="email" name="email" id="email"/>
                
                
                <input type="submit" value="送出" id="submit" data-theme="a"/>
                
            </div>
            </form>
            <?php
				$name=$_POST['name'];
				$id=$_POST["id"];
				$rs=mysql_query("SELECT MBR_ID from menber where MBR_ID= '$id'");
				$value=mysql_fetch_row($rs);
				$str=null;
				if($value[0]!=null)
					$str="帳號重複";
				//echo "run";
				$pwd1=$_POST["password"];
				$pwd2=$_POST["password2"];
				//echo $pwd1.$pwd2;
				if($pwd1!=$pwd2)
					if($str==null)
						$str="密碼有誤";
					
				if($str==null && $name!=null){
					$level=$_POST["level"];
					$email=$_POST["email"];
					mysql_query("insert into `menber`( `MBR_ID`, `MBR_PWD`, `MBR_NAME`, `MBR_LV`, `MBR_EMAIL`) values('$id','$pwd1','$name','NormalUser','$email');")or die(mysql_error());
					echo "<script>alert('成功註冊');location.replace('index.php')</script>";
					
				}else{
					if($str!=null)
						echo "<script>alert('註冊失敗，".$str."。');</script>";
				}
					
				
						
				
					
			?>
         </div>   
    </div>
</body>
</html>