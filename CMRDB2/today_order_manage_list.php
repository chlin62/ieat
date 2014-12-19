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
	
	
?>
    	
<body>
<div data-role="page" data-theme="a">
   
   		 <div data-role="content"   class="ui-field-content">
       <?php 
	  $today_menu= mysql_query("select V_ID from today_menu where TM_DATE = curdate();");
	   	while($today_menu_V_ID=mysql_fetch_row($today_menu)){
	   		$vendor=mysql_query("select V_NAME from vendor where V_ID =$today_menu_V_ID[0] ")or die(mysql_error());
			while($vendor_value = mysql_fetch_assoc($vendor)){
			echo "<h3 align=".'center'.">".$vendor_value['V_NAME']." </h3>";
			$sum=0;
	   ?>
		<center>
          
          <table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">
     <thead>
       <tr>
       	 <th width="40%">品項</th>
         <th >數量</th>
         <th data-priority="2">單價</th>
         <th data-priority="2">總額</th>
       </tr>
     </thead>
     <tbody>
    <?php
			$pro_QOH=mysql_query("select P_ID,count(LINE_NUM) from line where date_format(LINE_DATE,'%Y-%m-%d')=curdate() group by P_ID");
			
			while($product_QOH=mysql_fetch_assoc($pro_QOH)){
						$P_ID=$product_QOH['P_ID'];
						$pro_name=mysql_query("select * from product where P_ID= '$P_ID' and V_ID='$today_menu_V_ID[0]' ")or die (mysql_error());
						$product_name=mysql_fetch_assoc($pro_name);
						if($product_name['P_NAME']!=null){
						echo "<tr>";
						echo "<td>";
							echo $product_name['P_NAME'];
						echo "</td>";
						echo "<td>";
							echo $product_QOH['count(LINE_NUM)'];
						echo "</td>";
						echo "<td>";
							echo $product_name['P_PRICE'];
						echo "</td>";
						echo "<td>";
							echo $product_name['P_PRICE']*$product_QOH['count(LINE_NUM)'];
							$sum=$sum+$product_name['P_PRICE']*$product_QOH['count(LINE_NUM)'];
						echo "</td>";
					echo "</tr>";
						}
					
			}
			echo "<tr>";
			echo "<td colspan='4' >";
			echo "金額總計:<font color='red'>".$sum."</font>";
			echo "</td>";
			echo "</tr>";
			
		
	?>
     </tbody>
   </table>
   </center>
   <?php
   	}}
	
   ?>
 
     
         <div>
</div>
</body>
</html>