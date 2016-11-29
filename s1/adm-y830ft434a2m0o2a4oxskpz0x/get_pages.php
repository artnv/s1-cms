<?php
error_reporting(E_ALL ^ E_NOTICE);
require "../includes/config.php";
require "adm_functions.php";


ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();

if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{

	$dir = $_GET['dir'];
	no_cache();
	header('Content-Type: text/html; charset=utf-8');
	//////////////////////
	if(file_exists("../".DB_DIR."/m$dir"))
	{
		$p =  file("../".DB_DIR."/m$dir");
		$p2 = explode('-',trim($p[1]));
		$pages = $p2[0]+trim($p[4]);
		$tcp=trim($p[5]);
		
		for(;$p2[0]<=$pages;$pages--)
		{
			if(file_exists("../".DB_DIR."/inf$pages"))
			{
				$t = file("../".DB_DIR."/inf$pages");
				
					if(trim($t[8]) > 0)
					{
						$newcmts = '<div class="newcmt" title="Новые комментарии">+'.trim($t[8]).'</div>';
					}
					else $newcmts = ' ';
					
				echo   $newcmts.'<li class="d-ls" id="page-'.$pages.'" onClick="get_page_info(this.id);get_text(this.id);s_page(this.id);"><span class="b">'.$tcp.'</span>.'.$t[5].'</li>';
				$tcp--;
			} 
			else continue;
		}
	}
}
?>
