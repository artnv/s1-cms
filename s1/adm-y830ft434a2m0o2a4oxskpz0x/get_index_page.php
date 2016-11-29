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
	header('Content-Type: text/html; charset=utf-8');

	if(file_exists("../".DB_DIR."/indexinfo"))
	{
		$db = trim(file_get_contents("../".DB_DIR."/indexinfo"));
		$tcp = $db;
			
		for($i=1;$db>=$i;$db--)
		{
			if(file_exists("../".DB_DIR."/index$db"))
			{
			
				$a = trim(file_get_contents("../".DB_DIR."/index$db"));
				
				if(file_exists("../".DB_DIR."/inf$a"))
				{
					$c = file("../".DB_DIR."/inf$a");
					
					
					if(trim($c[8]) > 0)
					{
						$newcmts = '<div class="newcmt" title="Новые комментарии">+'.trim($c[8]).'</div>';
					}
					else $newcmts = '';

					echo $newcmts.'<li class="d-ls" id="index-'.$a.'" onClick="s_index(this.id);get_page_info(this.id);get_text(this.id);"><span class="b">'.$tcp.'</span>.'.$c[5].'</li>';
					$tcp--;
					
				} else continue;
				
			} else continue;
		}
	}
}
?>
