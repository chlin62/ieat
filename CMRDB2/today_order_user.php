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
		header("lacation : login.php");
	include("mysql_connect.php");
	$show=true;
	$rs=mysql_query("select * from today_menu where TM_DATE=CURDATE();")or die(mysql_error);
	$value=mysql_num_rows($rs);
	if($value>0)
		$show=true;
	else
		$show=false;
		
	if(isset($_GET['insert']))
		$show=true;
	if(isset($_POST['submit']))
		$show=true;
		
	$MBR_ID=$_SESSION['MBR_ID'];
	$rs= mysql_query("select * from invoice where MBR_NUM=$MBR_ID and INV_DATE=curdate()")or die(mysql_error());
	if(mysql_num_rows($rs)<=0){//如果沒有invoice的話就建立一個invoice
		$MBR_ID=$_SESSION['MBR_ID'];
		mysql_query("insert into invoice (MBR_NUM,INV_DATE) values ($MBR_ID , curdate() );")or die(mysql_error());
	}
	$rs=mysql_query("select TM_STATE from today_menu where TM_DATE=CURDATE();")or die(mysql_error());
	$value=mysql_fetch_row($rs);
	//echo $value[0];
	if($value[0]==1){
		echo "<script>alert('今日已結單!'); location.replace('main.php')</script>";
		exit();
	}
	
		
?>


<body>
<div data-role="page" data-theme="a">
			
			<div data-role="content" data-theme="a"  align="center" >
    <?php
		if(!$show){    
	?>        
    	<script>
			alert("今天的菜單還沒有出來呦!");
			location.replace("main.php");
		</script>
    <Br/>
    
        
    <?php 
		
	}else{//end show -- 如果show 為true 顯示選擇表單;?>
    <table  data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" >
     <thead>
       <tr>
         <th>店家名稱</th>
         <th >餐單</th>
       </tr>
     </thead>
     <tbody>
    <?php
		$rs2=mysql_query("select * from today_menu where TM_DATE=CURDATE();")or die(mysql_error);
		while($value2= mysql_fetch_row($rs2)){
			$rs= mysql_query("select * from vendor where V_ID=$value2[1];")or die(mysql_error());
			while($value=mysql_fetch_row($rs)){
				echo "<tr>";
					echo "<td>";
						echo "$value[1]";
					echo "</td>";
					
					echo "<td>";
						echo "<a href='today_order_user_show_menu.php?V_ID=$value2[1]'>看餐單</a>";
					echo "</td>";
				echo "</tr>";	
			}
		}
	
	?>
     </tbody>
   </table>
 
   <?php 
	}
   ?>
    		</div>
    </div>
</body>
</html>