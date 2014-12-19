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
	if($_SESSION['level']!="SuperUser")
		header("Location : index.php");
	include("mysql_connect.php");
?>

<body>
	<div data-role="page" data-theme="a">
        <div data-role="content" data-theme="a" align="center" class="ui-field-content">
           
        <form method="post" action="ven_type.php"   >
           
            <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="刪除" data-column-popup-theme="a">
        	    	<thead>
                         <tr class="ui-bar-d" >
                            <th class="label"  >
                            編號
                            </th>
                            <th class="label" >
                            類型
                            </th>
                            <th class="label" data-priority="2">
                            刪除
                            </th>
                            
                         </tr>
                     </thead>
                     <tbody>
                     <?php
                     	
						$rs=mysql_query("select * from vendor_type where 1 ;")or die("error2");
						while($value=mysql_fetch_row($rs)){
							
							echo "<tr>";
							for($i=0;$i<count($value);$i++){
								echo "<td>";
								echo "$value[$i]";
								echo "</td>";
							}
								echo "<td valign='middle'>";
								echo "<input type='radio' value='$value[0]' name='select' >";
								echo "</td>";
							echo "</tr>";
							
						}
					?>
                    
                     </tbody>
                    
                 </table>
                 
              	
                
                <fieldset data-role="collapsible">
        			<legend>新增類別</legend>
                <label for="type" align="left" >輸入類別名稱:</label>
                <input type="text" id="type" name="type" />
                </fieldset>
                <input type="submit" name="submit" value="執行">
            	
        	
            </form>
           
            <?php 
				if(isset($_POST['submit'])){
					
					$type=$_POST['type'];
					$deltype=$_POST['select'];
					
					if($type!=null)
						mysql_query("INSERT INTO `vendor_type`(`V_TYPE`) VALUES ('$type')");
					if(!empty($deltype))
						mysql_query("DELETE FROM vendor_type WHERE VT_ID = '$deltype' ;")or die("error!");
					header("Location : ven_type.php");
				}
			?>
        </div>
    </div>
</body>
</html>	