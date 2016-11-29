<?php
error_reporting(E_ALL ^ E_NOTICE);
require "../includes/config.php";

ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();
if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{

	$d = $_GET['dir'];
	$d = explode("-",$d);
	$dir = trim($d[1]);
	
	if(is_numeric($dir) && file_exists("../".DB_DIR."/m$dir"))
	{

		$dbtmp = file("../".DB_DIR."/m$dir");

		if(trim($dbtmp[0]) == 'dir' || trim($dbtmp[0]) == 'main_dir')
		{
			include "adm_functions.php";
			no_cache();
			
			header('Content-Type: text/xml; charset=utf-8');
			echo '<?xml version="1.0" encoding="utf-8" standalone="yes"?>
			<response>';

				$tdb = explode("-",trim($dbtmp[1]));
				$tc = $tdb[0]+trim($dbtmp[4]);
				$f = 0;
				$i = $tdb[0];
				
				for(;$i<=$tc;$i++)
				{
					if(file_exists("../".DB_DIR."/p$i") && file_exists("../".DB_DIR."/inf$i"))
					{
						$f+=filesize("../".DB_DIR."/p$i");
						$f+=filesize("../".DB_DIR."/inf$i");
					} else continue;
					
				}
				
				
				if($f < 1024)
				{
					$f .= " Б";
				}
				if($f > 1024 && $f < 1048576)
				{
					$f /= 1024; 
					$f2 = explode('.',$f);
					$f = $f2[0].'.'.$f2[1][0]; 
					$f .= " Кб";
				}
				if($f > 1048576 && $f < 1073741824)
				{
					$f = $f /1024/1024;
					$f2 = explode('.',$f);
					$f = $f2[0].'.'.$f2[1][0];
					$f .= " Мб";
				}
				if($f > 1073741824)
				{
					$f = $f /1024/1024/1024;
					$f2 = explode('.',$f);
					$f = $f2[0].'.'.$f2[1][0]; 
					$f .= " Гб";
				}
			
				$cp = file("../".DB_DIR."/m$dir");
				
		$md = 0;
		if(trim($dbtmp[0]) == 'main_dir') $md=1; else $md=0;
				
		echo '<cmt>'.$cp[3].'</cmt>';
		echo '<pages>'.$cp[5].'</pages>';
		echo '<dirsize>'.$f.'</dirsize>';
		echo '<maindir>'.$md.'</maindir>';
		echo '</response>';
		} 

	}
}
?>
