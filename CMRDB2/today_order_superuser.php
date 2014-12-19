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
	if($_SESSION['level']!='SuperUser')
		header("lacation : login.php");
	include("mysql_connect.php");
	$show=true;
	$rs=mysql_query("select * from today_menu where TM_DATE=CURDATE();")or die(mysql_error);
	$value=mysql_fetch_row($rs);
	if(isset($value[0]))
		$show=false;
	if(isset($_GET['insert']))
		$show=true;
	if(isset($_POST['submit']))
		$show=true;
	
	
?>


<body>
<div data-role="page" data-theme="a">
			
			<div data-role="content" data-theme="a"  align="center" >
    <?php
		if($show){    
	?>        
    <form  action="today_order_superuser.php" method="post"  >
                
                <select name="type">
                <?php 
                    $rs=mysql_query("select * from vendor_type where 1;");
                    
                    while($value = mysql_fetch_row($rs)){
                        echo "<option value=$value[0] selected>$value[1]</option>";
                    }
					
                ?>
                <input type="submit" name="submit" value="送出"/>
                
    </form>
    <Br/>
    <?php 
		if(isset($_POST['submit'])){
			//echo $_POST['type'];
	?>
    	<ul data-role="listview" >
        <?php
			$V_TYPE=$_POST['type'];
        	$rs=mysql_query("select * from vendor where VT_ID= $V_TYPE ;")or die(mysql_error());
			while($value=mysql_fetch_row($rs))
				echo "<li ><a href='today_order_decide.php?V_ID=$value[0]'  >$value[1]</a></li>";
		?>
    	</ul>
        
    <?php 
		}
	}else{//end show -- 如果show 為true 顯示選擇表單;?>
    <table  data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" >
     <thead>
       <tr>
         <th>店家名稱</th>
         <th >刪除</th>
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
						echo "<a href='today_order_delete.php?delete=$value2[0]'>刪除</a>";
					echo "</td>";
				echo "</tr>";	
			}
		}
	
	?>
     </tbody>
   </table>
   <a href="today_order_superuser.php?insert=1" class="ui-btn ui-btn-inline">新增項目</a>
   <?php 
	}
   ?>
    		</div>
    </div>
</body>
</html>