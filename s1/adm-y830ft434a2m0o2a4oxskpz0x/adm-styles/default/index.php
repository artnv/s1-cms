<?php 

if(empty($lc)) $lc = false;
if($lc == true)
{

	$act=$_GET['act'];
	switch ($act)
	{
		case "editor" :
		$load = "editor";//в просмотр статей в каталоге
		break;
		
		case "settings" :
		$load = "settings";//новости
		break;
		
		case "logout" :
		$_SESSION['admmod'] = false;
		header("location: ../index.php");
		break;
		
		default:
		$load = "editor";//стартовая страница с последними статьями
		break;
	}	
	include "adm-styles/".ADMSTYLE."/$load.php";	
}	
?>