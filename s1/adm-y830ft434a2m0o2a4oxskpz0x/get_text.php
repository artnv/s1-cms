<?php
error_reporting(E_ALL ^ E_NOTICE);
require "../includes/config.php";
require "adm_functions.php";


ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();
if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{
	no_cache();
	$p = $_GET['page'];
	$p = explode("-",$p);
	$id = $p[1];

	if(file_exists("../".DB_DIR."/p$id"))
	{
	header('Content-Type: text/html; charset=utf-8');
	echo file_get_contents("../".DB_DIR."/p$id");
	}
}
?>