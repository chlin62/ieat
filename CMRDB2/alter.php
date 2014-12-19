<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery Mobile: Theme Download</title>
	<link rel="stylesheet" href="themes/style.min.css" />
	<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
    <title>無標題文件</title>
    <style>
	.movie-list thead th,
.movie-list tbody tr:last-child {
    border-bottom: 1px solid #d6d6d6; /* non-RGBA fallback */
    border-bottom: 1px solid rgba(0,0,0,.1);
}
.movie-list tbody th,
.movie-list tbody td {
    border-bottom: 1px solid #e6e6e6; /* non-RGBA fallback  */
    border-bottom: 1px solid rgba(0,0,0,.05);
}
.movie-list tbody tr:last-child th,
.movie-list tbody tr:last-child td {
    border-bottom: 0;
}
.movie-list tbody tr:nth-child(odd) td,
.movie-list tbody tr:nth-child(odd) th {
    background-color: #eeeeee; /* non-RGBA fallback  */
    background-color: rgba(0,0,0,.04);
}
	</style>
</head>
<?php session_start();
		if($_SESSION['level']!='SuperUser')
			header("Location : login.php");
		include("mysql_connect.php");
		
 ?>
<body>
	<div data-role="page" data-theme="a">
    
   		 <div data-role="content" data-role="content" data-theme="a" align="center" class="ui-field-content"> 
            <form method="post" action="alterMBR.php">
                <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="欄位" data-column-popup-theme="a">
                
                	<thead>
                         <tr class="ui-bar-d">
                            <th class="label" >
                            帳號
                            </th>
                            <th class="label" data-priority="2">
                            密碼
                            </th>
                            <th class="label" >
                             姓名
                            </th>
                            <th class="label" data-priority="4">
                           等級
                            </th>
                              <th class="label" data-priority="4">
                           E-mail
                            </th>
                             <th class="label">
                            修改
                            </th>
							<th class="label">
                            刪除
                            </th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php
						$rs=mysql_query("select * from menber where 1 ;")or die("error2");
						while($value=mysql_fetch_row($rs)){
							
							echo "<tr>";
							for($i=1;$i<count($value);$i++){
								echo "<td>";
								echo "$value[$i]";
								echo "</td>";
							}
								echo "<td>";
								echo "<input type='radio' value='$value[1]' name='select'  >";
								echo "</td>";
								echo "<td>";
								echo "<a href='delete_MBR.php?MBR_NUM=$value[0]'>刪除</a>";
								echo "</td>";
							echo "</tr>";
							
						}
					?>
                     </tbody>
                    
                 </table>
                 <input type="submit" class="ui-btn ui-btn-inline" value="送出"/>
                 
               </form>
                    
                
				
                
                 	
                    	
                    
         
         </div>
        
       

    </div>
    


</body>
</html>