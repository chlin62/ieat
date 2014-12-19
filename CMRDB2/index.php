<!doctype html>
<html>
<head>
 <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="themes/style.min.css" />
		<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
        <style>
		

		</style>
<title>愛點餐!</title>
</head>
<?php  session_start(); 
session_register("username");
session_register("level"); 
unset($_SESSION['username']);
unset($_SESSION['level']);
?>
<body>
<div data-role="page" data-theme="a">
			<div data-role="header" data-position="inline" align="center">
				
			</div>
			<div data-role="content" data-theme="a"  align="center" >
				
			
         
            <img src="images/cmrdb.png">
				<form method="post" action="index.php" data-role="controlgroup"  data-type="horizontal"  >
					<div >
                        <label for="name" align="left" >使用者名稱:</label>
                        <input type="text" name="name" id="name"   />
                                      
                        <label for="pwd" align="left" >密碼:</label>
                        <input type="password" name="pwd" id = "pwd"/>
                       
                        <input  type="submit" value="送出" />
						<h6 align='right'><a href="register.php">會員註冊</a></h6>
                    </div>
                  

                    
				</form>
               
          
                
                 
        <?php
			include("mysql_connect.php");
			
        	$name = $_POST['name'];
			$pwd = $_POST['pwd'];
			$result=mysql_query("select MBR_ID,MBR_PWD,MBR_LV,MBR_NUM from menber where MBR_ID= '$name' ")or die("系統異常");
			$value=mysql_fetch_row($result);
			$str="";
			if($value==null)
				$str= "系統無法辨識身分請洽管理員";
			else if($pwd!=$value[1])
				$str= "系統無法辨識身分請洽管理員";
			else if($pwd==$value[1]&&$name==$value[0]){
				$str= "成功登入";
				$_SESSION['username']=$name;
				$_SESSION['MBR_ID']=$value[3];
				$_SESSION['level']=$value[2];
				 echo "<script>location.replace('login.php');</script>";
			}else{
				$str= "系統無法辨識身分請洽管理員";
				}
			if($name!=null && $pwd!=null)
				echo "<font color='RED'>$str</font>"
			
			
			//echo $name;echo $pwd;
		?>
		
			</div>
            <div data-role="footer" data-position="fixed" data-tap-toggle="true" class="footer"  >
					<center><p>行雲者研發基地,2014</p></center>
				</div><!-- /footer --> 
		</div>
        
      
 		


</body>
</html>