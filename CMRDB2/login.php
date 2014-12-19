<!doctype html>
<html>
<head>
 <meta charset="utf-8">
 		
		<meta name="viewport" content="width=device-width, initial-scale=1" >
		<link rel="stylesheet" href="themes/style.min.css" />
		<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
        
<title>愛點餐!</title>
<script>
function SetFrameHeight(iframeID)
{
parent.document.getElementById(iframeID).height = (document.body.scrollHeight+10)+'px';
}

</script>
<style>
		/* Adjust the width of the left reveal menu. */
#demo-page #left-panel.ui-panel {
    width: 15em;
}
#demo-page #left-panel.ui-panel-closed {
    width: 0;
}
#demo-page .ui-panel-page-content-position-left,
.ui-panel-dismiss-open.ui-panel-dismiss-position-left {
    left: 15em;
    right: -15em;
}
#demo-page .ui-panel-animate.ui-panel-page-content-position-left.ui-panel-page-content-display-reveal {
    left: 0;
    right: 0;
    -webkit-transform: translate3d(15em,0,0);
    -moz-transform: translate3d(15em,0,0);
    transform: translate3d(15em,0,0);
}
/* Listview with collapsible list items. */
.ui-listview > li .ui-collapsible-heading {
  margin: 0;
}
.ui-collapsible.ui-li-static {
  padding: 0;
  border: none !important;
}
.ui-collapsible + .ui-collapsible > .ui-collapsible-heading > .ui-btn {
  border-top: none !important;
}
/* Nested list button colors */
.ui-listview .ui-listview .ui-btn {
    background: #fff;
}
.ui-listview .ui-listview .ui-btn:hover {
    background: #f5f5f5;
}
.ui-listview .ui-listview .ui-btn:active {
    background: #f1f1f1;
}
/* Reveal panel shadow on top of the listview menu (only to be used if you don't use fixed toolbars) */
#demo-page .ui-panel-display-reveal {
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
}
#demo-page .ui-panel-page-content-position-left {
    -webkit-box-shadow: -5px 0px 5px rgba(0,0,0,.15);
    -moz-box-shadow: -5px 0px 5px rgba(0,0,0,.15);
    box-shadow: -5px 0px 5px rgba(0,0,0,.15);
}
/* Setting a custom background image. */
#demo-page.ui-page-theme-a,
#demo-page .ui-panel-wrapper {
    background-color: #fff;
    background-image: url("../_assets/img/bg-pattern.png");
    background-repeat: repeat-x;
    background-position: left bottom;
}
/* Styling of the page contents */
.article p {
    margin: 0 0 1em;
    line-height: 1.5;
}
.article p img {
    max-width: 100%;
}
.article p:first-child {
    text-align: center;
}
.article small {
    display: block;
    font-size: 75%;
    color: #c0c0c0;
}
.article p:last-child {
    text-align: right;
}
.article a.ui-btn {
    margin-right: 2em;
}
@media all and (min-width:769px) {
    .article {
        max-width: 994px;
        margin: 0 auto;
        padding-top: 4em;
        -webkit-column-count: 2;
        -moz-column-count: 2;
        column-count: 2;
        -webkit-column-gap: 2em;
        -moz-column-gap: 2em;
        column-gap: 2em;
    }    /* Fix for issue with buttons and form elements
    if CSS columns are used on a page with a panel. */
    .article a.ui-btn {
        -webkit-transform: translate3d(0,0,0);
    }
}
	</style>


</head>
<?php 
	session_start(); 
	if($_SESSION['username']==null)
		header("Location : index.php");
		include("mysql_connect.php");
?>
<body >
<div data-role="page" data-theme="a">
			<!-------------------------- header---------------------------------------------->
            <div data-role="header" data-position="inline">
			
				<a href="#panel" data-icon="gear" data-iconpos="notext">Add</a><!--右方選單連結-->		
			
                <center><img src="images/cmrdb.png" width="126" height="36"  /></cneter>  
			</div><!-- end header-->
			<div data-role="content" data-theme="a" align="center" >
				
				
              <!---------------------------------- 連結內文 --------------------------------------> 
             <iframe id='ifm' name="ifm" src='main.php' width='100%'  frameborder='0' onload='this.height=(ifm.document.body.scrollHeight)' > </iframe> 
 
			</div>
            <!------------------------------------ /footer --------------------------------------->
   			<div data-role="footer" data-position="fixed" data-tap-toggle="true" class="footer"  >
					<center><p>行雲者研發基地,2014</p></center>
			</div><!-- /footer --> 
         
     <div data-role="panel" id="panel"><!--右方選單 panel-->
        <ul data-role="listview">
			<!-------------------------- 使用者管理者共用功能列表 ------------------->
            <li data-role="collapsible" data-inset="false" data-iconpos="right">
              <h3>使用者功能區</h3>
              <ul data-role="listview">
                <li><a href="today_order_user.php" target="ifm">當日訂單</a></li>
                <li><a href="today_order_check.php" target="ifm">訂單確認</a></li>
              </ul>
            </li><!-- /collapsible -->
            
            <!-------------------------- 以下為管理者功能 ------------------------->
            <?php if($_SESSION['level']=='SuperUser'){ ?>
				<li data-role="collapsible" data-inset="false" data-iconpos="right">
				  <h3>訂單管理</h3>
				  <ul data-role="listview">
					<li><a href="today_order_superuser.php" target="ifm">當日菜單</a></li>
					<li><a href="today_order_manage.php" target="ifm">訂單管理</a></li>
				  </ul>
				</li><!-- /collapsible -->
				
				<li data-role="collapsible" data-inset="false" data-iconpos="right">
				  <h3>廠商資料管理</h3>
				  <ul data-role="listview">
					<li><a href="ven_type.php" target="ifm">類別管理</a></li>
					<li><a href="vendor.php" target="ifm">店家資料修改</a></li>
                    <li><a href="menu.php" target="ifm">菜單管理</a></li>
				  </ul>
				</li><!-- /collapsible -->
				
				<li data-role="collapsible" data-inset="false" data-iconpos="right">
				  <h3>成員管理</h3>
				  <ul data-role="listview">
					<li><a href="register.php" target="ifm">成員註冊</a></li>
					<li><a href="alter.php" target="ifm">密碼權限管理</a></li>
				  </ul>
				</li><!-- /collapsible -->
			<?php }?>
            <!-----------------------------共同功能區----------------------------->
            <li data-role="list-divider"></li>
            <li data-icon="back"><a href="main.php" target="ifm" >回首頁</a></li>
            <li data-icon="back"><a href="index.php" target="_self">登出</a></li>
        </ul>
    </div><!-- /panel -->
   
		</div>
        
      
 		
</body>
</html>