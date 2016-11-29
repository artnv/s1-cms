<?php
error_reporting(E_ALL ^ E_NOTICE);
require "../includes/config.php";	

ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();
if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{
	$id		=	$_GET['id'];
	$cmt	=	$_GET['cmt'];
	$mtd	=	$_GET['mtd'];
	
	switch($mtd)
	{
	case "ban":
		if(file_exists("../".DB_DIR."/cmt$id-$cmt") && file_exists("../".DB_DIR."/inf$id"))
		{
			$inf = file("../".DB_DIR."/inf$id");
			$inf9 = trim($inf[9])-1;
			$inf6 = trim($inf[6]);
			
			if($inf9 <= 0)
			{
				$inf6 = 0;
			}
			
			$str = "$inf[0]$inf[1]$inf[2]$inf[3]$inf[4]$inf[5]$inf6\n$inf[7]$inf[8]$inf9";
			
			
			$str2 = file("../".DB_DIR."/cmt$id-$cmt");
			
			if(trim($str2[0]) != "adm.".$_SERVER['REMOTE_ADDR'] && trim($str2[0]) != $_SERVER['REMOTE_ADDR'])
			{
				$bl = fopen("../".DB_DIR."/banlist", "a");
				fputs($bl,trim($str2[0])."\n");
				fclose($bl);
			}
			
			file_put_contents("../".DB_DIR."/inf$id",$str);
			unlink("../".DB_DIR."/cmt$id-$cmt");
		}
	break;
	case "del":
		if(file_exists("../".DB_DIR."/cmt$id-$cmt") && file_exists("../".DB_DIR."/inf$id"))
		{
			$inf = file("../".DB_DIR."/inf$id");
			$inf9 = trim($inf[9])-1;
			$inf6 = trim($inf[6]);
			
			if($inf9 <= 0)
			{
				$inf6 = 0;
			}
			
			$str = "$inf[0]$inf[1]$inf[2]$inf[3]$inf[4]$inf[5]$inf6\n$inf[7]$inf[8]$inf9";
			
			file_put_contents("../".DB_DIR."/inf$id",$str);
			unlink("../".DB_DIR."/cmt$id-$cmt");
		}
	break;
	}
}
?>