<?php
error_reporting(E_ALL ^ E_NOTICE);
require "../includes/config.php";
require "adm_functions.php";
/////

ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();
if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{

	if(empty($_GET['id'])) $_GET['id'] = null;
	/////

	$ti 	= explode("-",$_GET['id']);
	$id 	= trim($ti[1]);
	$dir 	= get_ndir($id);


	if(is_numeric($dir) && file_exists("../".DB_DIR."/m$dir"))
	{
	$dm = file("../".DB_DIR."/m$dir");
		if(trim($dm[0]) == "dir" || trim($dm[0]) == "main_dir" && file_exists("../".DB_DIR."/p$id") && file_exists("../".DB_DIR."/inf$id"))
		{
			no_cache();
			/////////////////////////////
			header('Content-Type: text/xml; charset=utf-8');

			echo '<?xml version="1.0" encoding="utf-8" standalone="yes"?>
	<response>';

			$f = filesize("../".DB_DIR."/p$id");
			$f += filesize("../".DB_DIR."/inf$id");
			
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
				$f = $f2[0].'.'.$f2[1][0];; 
				$f .= " Мб";
			}
			if($f > 1073741824)
			{
				$f = $f /1024/1024/1024;
				$f2 = explode('.',$f);
				$f = $f2[0].'.'.$f2[1][0];; 
				$f .= " Гб";
			}
		
		$fileinf = file("../".DB_DIR."/inf$id");
		
		///////
		$index = 0;

		if(file_exists("../".DB_DIR."/indexinfo"))
		{
			$ic = trim(file_get_contents("../".DB_DIR."/indexinfo"));
			
			for($i=1;$i<=$ic;$i++)
			{
				if(file_exists("../".DB_DIR."/index$i"))
				{
					$ii = trim(file_get_contents("../".DB_DIR."/index$i"));
					if($ii == $id)
					{
						$index = 1;
						break;
					} 
					else 
					{
						$index = 0;
					}
				} else continue;
			}
		}

		
	echo '<keywords>'.trim($fileinf[1]).'</keywords>';
	echo '<description>'.trim($fileinf[2]).'</description>';
	echo '<title>'.trim($fileinf[3]).'</title>';
	echo '<date>'.get_date_time($fileinf[4]).'</date>';
	echo '<h>'.trim($fileinf[5]).'</h>';
	echo '<countcmt>'.trim($fileinf[9]).'</countcmt>';
	echo '<pagesize>'.trim($f).'</pagesize>';
	echo '<meta>'.trim($fileinf[0]).'</meta>';
	echo '<cmt>'.trim($fileinf[7]).'</cmt>';
	echo '<index>'.trim($index).'</index>';
	echo '</response>';
	}
	}
}
?>
