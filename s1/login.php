<?php
error_reporting(E_ALL ^ E_NOTICE);
require "includes/config.php";
require "includes/functions.php";
session_name(SESSION_NAME);
session_start();

////////////////////////////
if(strtolower($_POST['cpt']) == $_SESSION['cpt']) 
{
	if(get_loginban())
	{
		if($_SERVER['REMOTE_ADDR'] == $_SESSION['ip'] && LOGIN == $_POST['login'] && PASSWORD == get_hash($_POST['pass'],DB_DIR,ADM_DIR,LOGIN))
		{
			$_SESSION['admmod'] = true;
			$_SESSION['cpt'] = mt_rand(1,1000);
			set_login();
			header("Location: ".ADM_DIR);
		}
		else
		{
			$_SESSION['admmod'] = false;
			$_SESSION['cpt'] = mt_rand(1,1000);
			set_loginban();
			header("Location: index.php?id=login");
		}
		
	} else echo '<html><head><meta http-equiv="refresh" content="5; url=index.php"></head><body>Отказано в доступе.<br/>Вы в списке, заблокированных!</body></html>';

}
else 
{
	$_SESSION['admmod'] = false;
	$_SESSION['cpt'] = mt_rand(1,1000);
	header("Location: index.php?id=login");
}
?>