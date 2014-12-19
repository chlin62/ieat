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
	if(isset($_GET['delete'])){
			$delete=$_GET['delete'];
			mysql_query("delete from line where LINE_NUM=$delete");
	}
	$rs=mysql_query("select TM_STATE from today_menu where TM_DATE=curdate();");
	$state=mysql_fetch_row($rs);
	if($state[0]==0)
		$check=true;
	else
		$check=false;
	if(isset($_GET['TM_STATE'])){
		$rs=mysql_query("select TM_STATE from today_menu where TM_DATE=curdate();");
		$state=mysql_fetch_row($rs);
		if($state[0]==0)
			mysql_query("update today_menu set TM_STATE=1 where TM_DATE=curdate();");
		else
			mysql_query("update today_menu set TM_STATE=0 where TM_DATE=curdate();");
		header("location : today_order_manage.php");
	}
	
	
?>
    	
<body>
<div data-role="page" data-theme="a">
   
   		 <div data-role="content"   class="ui-field-content">
       

          
          <table  data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" >
     <thead>
       <tr>
       	 <th>使用者</th>
         <th data-priority="2">廠商</th>
         <th>品項</th>
         <th>價格</th>
         <th data-priority="2" >刪除</th>
       </tr>
     </thead>
     <tbody>
    <?php

				$rs=mysql_query("select * from invoice where INV_DATE=curdate();");
				while($value=mysql_fetch_row($rs)){
					$rs2=mysql_query("select * from line where INV_ID=$value[0]");
					$rs3=mysql_query("select MBR_NAME from menber where MBR_NUM=$value[1]")or die(mysql_error());
					$MBR_ID=mysql_fetch_row($rs3);
					while($value2=mysql_fetch_row($rs2)){
					echo "<tr>";
						echo "<td>";
							echo "$MBR_ID[0]";
						echo "</td>";
						$product=mysql_query("select * from product where P_ID=$value2[2]") or die(mysql_error());
						$product_value=mysql_fetch_assoc($product);
						$V_ID=$product_value['V_ID'];
						$vendor=mysql_query("select * from vendor where V_ID=$V_ID;") or die(mysql_error());
						$vendor_value=mysql_fetch_assoc($vendor);
						
						echo "<td>";
							echo $vendor_value['V_NAME'];
						echo "</td>";
						echo "<td>";
							echo $product_value['P_NAME'];
						echo "</td>";
						echo "<td>";
							echo "$value2[3]";
						echo "</td>";
						echo "<td>";
							echo "<a href='today_order_manage.php?delete=$value2[0]'>刪除</a>";
						echo "</td>";
					echo "</tr>";	
					}
			}
		
	?>
     </tbody>
   </table>
   <center>
   <a href="today_order_manage.php?TM_STATE=<?php echo $state[0];?>" class="ui-btn ui-btn-inline"><?php if($check) echo "結單"; else echo"結單取消"; ?></a>
   <a href="today_order_manage_list.php" class="ui-btn ui-btn-inline">列出報表</a>
   </center>
     
         <div>
</div>
</body>
</html>