<?php
error_reporting(E_ALL ^ E_NOTICE);

if(file_exists("includes/config.php"))
{
	///////
	require "includes/config.php";
	require "includes/functions.php";
	
	if(install())
	{
		include ADM_DIR."/adm_includes_ctrl.php";

		session_name(SESSION_NAME);
		session_start();
		
		////
		$lc = true;
		$_SESSION['lcs'] = true;  
		
		if(empty($_GET['id'])) 	$_GET['id'] 	= null;
		if(empty($_GET['dir'])) $_GET['dir'] 	= null;

		if($_SESSION['admmod'] != true) $_SESSION['admmod'] = false;
		if(empty($_SESSION['ip']))	$_SESSION['ip']	= $_SERVER['REMOTE_ADDR'];
		$_SESSION['id'] = $_GET['id'];

		if($_GET['id'] == 'xmlsitemap' && OPTIONS_XML_SITEMAP == 1) header('Content-Type: text/xml');
		else header('Content-Type: text/html; charset=utf-8');

		if(($_GET['id'] == 'sitemap' && OPTIONS_SITEMAP == 0) or ($_GET['id'] == 'xmlsitemap' && OPTIONS_XML_SITEMAP == 0)) header('location: index.php');
		
		if(file_exists("styles/".STYLE."/index.php")) include "styles/".STYLE."/index.php";
		else echo "Стиль, не найден";
	}
} else echo "Файл: <b>\"config.php\"</b>, не найден. ";

?>
