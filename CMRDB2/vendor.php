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
        
<title>愛點餐!</title>
 

</head>
<?php 
	session_start(); 
	include("mysql_connect.php");
	$typeRs=mysql_query("select * from vendor_type;") or die(mysql_error());
	
	if($_SESSION['level']!="SuperUser")
		header("Location : index.php");
	$submit=true;
	if(isset($_POST['submit']))
		$submit=false;
	if(isset($_POST['submit2'])){
		$submit=true;
	
	}
	
?>

<body>
	<div data-role="page" data-theme="a">
        <div data-role="content"  align="center" class="ui-field-content">
          <?php 
		  if(isset($_POST['submit2'])){
		
		$V_NAME=trim($_POST['V_NAME']);
		$V_TEL=trim($_POST['V_TEL']);
		$V_TYPE=$_POST['V_TYPE'];
		$V_NOTE=$_POST['V_NOTE'];
		if($V_NAME==null){
			echo '<script>alert("店家姓名為空");</script>';
			$submit=false;
		}else if($V_TEL==null){
			echo '<script>alert("電話不能為空");</script>';
			$submit=false;
		}else{
		mysql_query("INSERT INTO vendor(V_NAME, VT_ID, V_NOTE) VALUES('$V_NAME',$V_TYPE,'$V_NOTE') ;") or die(mysql_error());
		$rs=mysql_query("SELECT V_ID from vendor where V_NAME like '$V_NAME';")or die(mysql_error());
		$value=mysql_fetch_row($rs);

		
		mysql_query("INSERT INTO vendor_phone (VP_TEL,V_ID) VALUES ('$V_TEL',$value[0]);") or die(mysql_error());
		}
	}
	
		  if($submit){
		  	
			while($value=mysql_fetch_row($typeRs))
			{ ?>
            <div data-role="collapsible" data-inset="false">
			<?php
				echo "<h3>$value[1]</h3>";
			?>
            	<ul data-role="listview">	
            <?php
				$vendorRs=mysql_query("select V_NAME from vendor where VT_ID = $value[0] ;") or die(mysql_error());
				
				while($venRes = mysql_fetch_row($vendorRs)){
					echo '<li><a href="alterVEN.php?V_NAME='.$venRes[0].'" target="_self"   class="ui-shadow ui-btn ui-corner-all ui-btn-inline" data-transition="pop">'.$venRes[0].'</a></li>';
				}
				echo "</ul>";
				echo " </div><!-- /collapsible -->";
			}
		  	
		  ?>
          <form method="post" action="vendor.php">
          <input type="submit" name="submit" value="新增資料" />
       		</form>
                
           <?php  }else{
			  ?>
              
		 	<form method="post" action="vendor.php">
            <div>
            	<label for="name" align = "left">請輸入店家名稱:</label>
            	<input type="text" name="V_NAME"  id ="name"/>
                <label for="tel" align = "left">請輸入店家電話:</label>
                <input type="text" name="V_TEL" id="tel" />
                <label for="select-choice-1" align = "left">請選擇商家類型:</label>
                <select name="V_TYPE" id="select-choice-1" data-native-menu="false">
                <?php
                	while($value=mysql_fetch_row($typeRs)){
						echo "<option value='$value[0]'>$value[1]</option>";
					}
				
				?>
                </select>
                
                <label for="note" align = "left">備註:</label>
                <input type="text" name="V_NOTE" id="note"/>
          		<input type="submit" name="submit2" value="完成" />
              </div>
       		</form>
		   	
			
		   <?php
		   }
		   
		   
		   ?>
        
              
            
        
        </div>
    </div>
</body>
</html>	