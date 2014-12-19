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
	if($_SESSION['level']!='NormalUser')
		header("lacation : login.php");
	include("mysql_connect.php");
	if(isset($_GET['delete'])){
			$delete=$_GET['delete'];
			mysql_query("delete from line where LINE_NUM=$delete");
		}

	
	
?>
    	
<body>
<div data-role="page" data-theme="a">
   
   		 <div data-role="content"   class="ui-field-content">
       

          
          <table  data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" >
     <thead>
       <tr>
         <th>品項</th>
         <th>價格</th>
         <th >取消訂餐</th>
       </tr>
     </thead>
     <tbody>
    <?php
		
			$MBR_ID=$_SESSION['MBR_ID'];
				$rs=mysql_query("select * from line where INV_ID=(select INV_ID from invoice where MBR_NUM=$MBR_ID and INV_DATE = CURDATE())  ;")or die (mysql_error());
				$rs3=mysql_query("select TM_STATE from today_menu where TM_DATE=CURDATE();")or die(mysql_error());
				$num=mysql_fetch_row($rs3);
				while($value=mysql_fetch_row($rs)){
					$rs2=mysql_query("select P_NAME from product where P_ID=$value[2]");
					$value2=mysql_fetch_row($rs2);
					echo "<tr>";
						echo "<td>";
							echo "$value2[0]";
						echo "</td>";
						echo "<td>";
							echo "$value[3]";
						echo "</td>";
						echo "<td>";
						if($num[0]==0)
							echo "<a  href='today_order_check.php?delete=$value[0]'>刪除</a>";
						else
							echo "<font color='red'>已結單</font>";
						echo "</td>";
					echo "</tr>";	
					
			}
		
	?>
     </tbody>
   </table>
     
         <div>
</div>
</body>
</html>