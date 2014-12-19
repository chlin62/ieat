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
            <div data-role="content"  align="center" class="ui-field-content">
            	
                    <table  data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="刪除" data-column-popup-theme="a">
                        <thead>
                            <tr class="ui-bar-d" >
                            <th width="50%" >品項</th>
                            <th width="30%" >價格</th>
                            <th data-priority="3">刪除</th>
                            <tr>
                        </thead>
                        <?php 
							if(isset($_POST['vendor']))
                            	$V_ID=$_POST['vendor'];
							else
								$V_ID=$_GET['V_ID'];
                            $rs=mysql_query("select * from product where V_ID = $V_ID")or die(header("location: menu.php"));
                            
                            while($value = mysql_fetch_row($rs)){
                                echo "<tr>";
                                echo "<td>$value[1]</td>";
                                echo "<td>$value[2]</td>";
								echo "<td><a href='menu_delete.php?delete=$value[0]&V_ID=$value[3]'>刪除</a><td>";
                                echo "</tr>";
                            }
                            
                        
                        ?>
                    </table>
                    <a href="#popupLogin" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a" data-transition="pop">新增資料</a>
                   <div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all">
                        <form action="menu_insert.php" method="post">
                            <div style="padding:10px 20px;">
                                <div>
                                <h3>請輸入欲新增的資料</h3>
                                <input type="hidden" name="V_ID" value="<?php echo $V_ID;?>">
                                <label for="un" >品項</label>
                                <input type="text" name="P_NAME" id="un" value=""  data-theme="a">
                                <label for="pw" >價格</label>
                                <input type="text" name="P_PRICE" id="pw" value=""  data-theme="a">
                                <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check" name="insertMenu">新增</button>		</div>
                            </div>
                        </form>
                    </div>
                    
                    
            </div>
    </div>
</body>
</html>