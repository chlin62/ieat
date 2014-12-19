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
	if(isset($_POST['submit']))
			$show=false;
	if(isset($_POST['submit2'])){
			$show=false;
	}
?>
<body>
<div data-role="page" data-theme="a">
        <div data-role="content"  align="center" class="ui-field-content">
        <?php if($show){?><!--選擇廠商類型-->
        <form  action="menu.php" method="post">
        	<select name="type">
        	<?php 
				$rs=mysql_query("select * from vendor_type where 1;");
				
				while($value = mysql_fetch_row($rs)){
					echo "<option value=$value[0] selected>$value[1]</option>";
				}
			?>
            <input type="submit" name="submit" value="送出"/>
        </form>
        
        <?php }else if(isset($_POST['submit'])){
					
		?>
         <form action="menu_show.php" method="post"><!--選擇廠商 -->
             <select name="vendor">
				<?php
                    $V_TYPE=$_POST['type'];
                    $rs=mysql_query("select * from vendor where VT_ID= $V_TYPE ;");
                    while($value=mysql_fetch_row($rs)){
                        echo "<option value='$value[0]' selected>$value[1]</option>"	;
                    }
                    
                ?>
            </select>	
            <input type = "submit" name="submit2" value="送出"/>
        </form>
        <?php }?>
        </div>
</div>
</body>
</html>