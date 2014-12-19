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
	if($_SESSION['username']==null)
		header("Location : index.php");
		include("mysql_connect.php");
?>

<body>
	<div data-role="page" data-theme="a">
    	<div data-role="content"   class="ui-field-content">
        	<center>
            <?php 
				echo "hi ".$_SESSION['username']."歡迎來到行雲愛點餐!<br/><br/>";
			?>
        		<img src="images/cache.41_19530536.jpg.w600_h449.jpg"/>
            </center>
        </div>
    </div>
</body>
</html>