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
	if($_SESSION['level']!='NormalUser')
		header("lacation : index.php");
	include("mysql_connect.php");
	$orderArray=array();
	
?>


<body>
<div data-role="page" data-theme="a">
			
			<div data-role="content" data-theme="a"  align="center" >
   
    	
        
   <?php 
   $MBR_ID=$_SESSION['MBR_ID'];
  	 if(isset($_GET['P_ID'])){
		 $P_ID=$_GET['P_ID'];
				mysql_query("insert into line(INV_ID,P_ID,P_PRICE) values((select INV_ID from invoice where MBR_NUM=$MBR_ID and INV_DATE=curdate()),$P_ID,(select P_PRICE from product where P_ID=$P_ID) )")or die(mysql_error())	;
				echo "<script>alert('已成功點餐!'); </script>";
				//exit();
				//header("location : today_order_user.php?V_ID=$V_ID");
		}
	
   		if($_GET['V_ID']){
   ?>
    <table  data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" >
     <thead>
       <tr>
         <th>品項</th>
         <th>價格</th>
         <th >點餐</th>
       </tr>
     </thead>
     <tbody>
    <?php
		$V_ID=$_GET['V_ID'];
			//echo $V_ID;
			$rs= mysql_query("select * from product where V_ID=$V_ID;")or die(mysql_error());
			while($value=mysql_fetch_row($rs)){
				echo "<tr>";
					echo "<td>";
						echo "$value[1]";
					echo "</td>";
					echo "<td>";
						echo "$value[2]";
					echo "</td>";
					echo "<td>";
						echo "<a href='today_order_user_show_menu.php?P_ID=$value[0]&V_ID=$V_ID'>點餐</a>";
					echo "</td>";
				echo "</tr>";	
			}
		
	
	?>
     </tbody>
   </table>
 <?php
		}else {
			
 				header("location : today_order_user.php");
 
		}
 ?>
 
    		</div>
    </div>
</body>
</html>