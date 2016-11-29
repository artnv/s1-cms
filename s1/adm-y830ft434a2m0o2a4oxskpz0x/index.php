<?php
error_reporting(E_ALL ^ E_NOTICE);

if(file_exists("../includes/config.php")) 
{

	require "../includes/config.php";
	require "adm_functions.php";
	
	if(empty($_GET['act'])) $_GET['act'] = null;
	
	/////////
	$lc = true;
	
	session_name(SESSION_NAME);
	session_start();
	header('Content-Type: text/html; charset=utf-8');


	if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
	{
		if(file_exists("adm-styles/".ADMSTYLE."/index.php")) include "adm-styles/".ADMSTYLE."/index.php";
		else echo "Не найден - стиль";	
	} else header('Location: ../index.php?id=login');
	
} else echo "Файл: <b>\"config.php\"</b>, не найден! ";

?>