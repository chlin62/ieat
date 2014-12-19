<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="themes/style.min.css" />
		<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
        
</head>

<?php 
	session_start(); 
	include("mysql_connect.php");
	$typeRs=mysql_query("select * from vendor_type;") or die(mysql_error());
	
	if($_SESSION['level']!="SuperUser")
		header("Location : index.php");
	$V_NAME=$_GET['V_NAME'];
	
	
?>

<body>
<div data-role="page" data-dialog="true">
	<?php
    if(isset($V_NAME)){
		$rs=mysql_query("select * from vendor where V_NAME='$V_NAME';")or die(mysql_error()."1");
		$value= mysql_fetch_row($rs) ;
		$rs=mysql_query("select VP_TEL from vendor_phone where V_ID = $value[0] ;")or die(mysql_error()."2");
		$VP_TEL=mysql_fetch_row($rs);
		$typeRs=mysql_query("select * from vendor_type;") or die(mysql_error()."3");
	?>
		<div data-role="header" data-theme="a">
		<h1>修改店家資料</h1>
		</div>

		<div role="main" class="ui-content">
		
       <form method="post" action="alterVEN.php">
            <div>
            	<input type="hidden" name = "V_ID" value="<?php echo $value[0]; ?>">
            	<label for="name" align = "left">請輸入店家名稱:</label>
            	<input type="text" name="V_NAME" value="<?php echo $value[1]; ?>"  id ="name"/>
                <label for="tel" align = "left">請輸入店家電話:</label>
                <input type="text" name="V_TEL" id="tel" value="<?php echo $VP_TEL[0] ;?>" />
                <label for="select-choice-1" align = "left">請選擇商家類型:</label>
                <select name="V_TYPE" id="select-choice-1" data-native-menu="false">
                <?php
                	while($value2=mysql_fetch_row($typeRs)){
						if($value[2]==$value2[0])
							echo "<option value='$value2[0]' selected>$value2[1]</option>";
						else
							echo "<option value='$value2[0]'>$value2[1]</option>";
					}
				
				?>
                </select>
                
                <label for="note" align = "left">備註:</label>
                <input type="text" name="V_NOTE" value="<?php echo $value[3]; ?>" id="note"/>
          		<div align="center">
                    <button type="submit" name="submit" class="ui-btn ui-btn-inline" value="完成">完成</button>
                    <a href="alterVEN.php?deletecheck=<?php echo $value[0];?>" class="ui-btn ui-btn-inline">刪除</a>
                </div>
              </div>
       		</form>
			
            
		</div>
      <?php
	}else if(isset($_GET['deletecheck'])){
	?> <script language="javascript">
        
		var r=confirm("確認刪除?");
			if (r==true)
			  {
			 	document.location.href="alterVEN.php?delete=<?php echo $_GET['deletecheck'] ?>";
			  }
			else
			  {
			  	document.location.href="vendor.php";
			  }
		
 		 </script>
     
		<!--	-->
       
	<?php
	}else if(isset($_GET['delete']))
	{
		$delete=$_GET['delete'];
		mysql_query("delete from vendor_phone where V_ID=$delete") or die(mysql_error());
		mysql_query("delete from vendor where V_ID=$delete") or die(mysql_error());
		echo "<script>alert('刪除成功');document.location.href='vendor.php';</script>";
	}else
		echo '<script language="javascript" >document.location.href="vendor.php";</script>';
		
	
	if(isset($_POST['submit'])){
		$V_ID=$_POST['V_ID'];
		$V_NAME=$_POST['V_NAME'];
		$VP_TEL=$_POST['V_TEL'];
		$V_TYPE=$_POST['V_TYPE'];
		$V_NOTE=$_POST['V_NOTE'];
		
		if($V_NAME==null)
			echo "<script>alert('姓名不能為空')</script>";
		else if($VP_TEL==null)
			echo "<script>alert('電話不能為空')</script>";
		else{
			mysql_query("update  vendor set V_NAME='$V_NAME' ,VT_ID=$V_TYPE ,V_NOTE='$V_NOTE' where V_ID = $V_ID;")	or die (mysql_error().'3');
			mysql_query("update  vendor_phone set VP_TEL='$VP_TEL' where V_ID = $V_ID;")	or die (mysql_error().'4');
			echo  "<script>alert('修改成功')</script>";
			
		}
			
		
	}
	 
	?>
       
 
	</div>
</body>
</html>