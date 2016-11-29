<?php 
if(empty($lc)) $lc = false;	
if($lc == true)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Вход, в панель управления</title>
<style type="text/css">
body {
	color:#333;
	margin: 0px;
	padding: 0px;
}
#login {
	background: #eff1f1;
	width: 280px;
	padding: 20px 15px 20px 15px;
	border: 1px solid white;
	border-radius: 6px;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	margin: 20% 0 0 40%;
}
.inptxt {
	width: 150px;
	color:#636363;
}
#header {
	background-color: #EFF1F1;
	margin-bottom: 30px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CDCFCF;
	width:100%;
	height:30px;
	z-index:100;
}
#clear-r {clear:right;}
#left-block {
	margin-left: 20px;
	font-size: 16px;
	padding-top: 5px;
	padding-bottom: 5px;
}
#left-block a {color:#1a59b0;}
#cpt4 {
	text-align: center;
	width: 60px;
	height:20px;
	color: #333;
	background: url(styles/<?php echo STYLE;?>/img/cpt2.png);
}
#cmed_captcha {cursor:pointer;}
</style>
<script type="text/javascript">
var firefox=1;
function upd_cpt() {
	firefox++;
	document.getElementById("cmed_captcha").src="captcha.php?ff="+firefox;
}
</script>
</head>
<body>

<div id="header">
<div id="left-block"><a href="index.php">&larr; На главную</a></div> 
</div><!--HEADER-->



<div id="login">
<form method="post" action="login.php">
  <table  border="0" cellpadding="2">
    <tr>
      <td style="width: 40%;" align="left" valign="top">Логин:</td>
      <td style="width: 60%;" align="left" valign="top">
	  <input type="text" class="inptxt" name="login"/></td>
    </tr>
    <tr>
      <td align="left" valign="top">Пароль:</td>
      <td align="left" valign="top"><input type="password" class="inptxt" name="pass"/></td>
    </tr>
    <tr>
      <td align="left" valign="top">
		<?php 
			if(!extension_loaded('gd'))
			{
				include "captcha.php";
			}
			else
			{
				echo '<img src="captcha.php" id="cmed_captcha" alt="captcha" onclick="upd_cpt();"/>';
			}
		?>
		</td>
      <td align="left" valign="top"><input type="text" class="inptxt" name="cpt"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center" valign="top"><input type="submit" value="Вход"/></td>
    </tr>
  </table>
  </form>
</div>
    
    


</body>
</html>
<?php } ?>