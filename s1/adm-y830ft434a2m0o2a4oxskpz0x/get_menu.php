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
	if($_GET['a'] == 'u')
	{
		if(file_exists("../".DB_DIR."/uplinksinfo"))
		{
			$ix = trim(file_get_contents("../".DB_DIR."/uplinksinfo"));
			
			if($ix > 0)
			{
				for($i=1;$i<=$ix;$i++)
				{
					$f = file("../".DB_DIR."/uplinks$i");
					
					echo '<li class="d-link" id="dir-'.$i.'" onClick="onsl();s_menu(this.id);tb1(this.id);">'.$f[0].'-'.$f[1].'</li>';
					
				}
			}
		}
	}
	else
	{
		if(file_exists("../".DB_DIR."/menuinfo"))
		{
			$db = trim(file_get_contents("../".DB_DIR."/menuinfo"));

			for($i=1;$i<=$db;$i++)
			{
				$arrf = file("../".DB_DIR."/m$i");

				if(trim($arrf[0]) == 'dir' || trim($arrf[0]) == 'main_dir')
				{		
					if(trim($arrf[6]) > 0)
					{
						$newcmts = '<div class="newcmt" title="Новые комментарии">+'.trim($arrf[6]).'</div>';
					}
					else $newcmts = ' ';

					if(trim($arrf[0]) == 'main_dir') echo $newcmts.'<li class="m-dir" id="dir-'.$i.'"onClick="get_pages(this.id);onsl();tb2(this.id);get_dir_info(this.id);s_menu(this.id);">'.$arrf[2].'</li>';
					else echo $newcmts.'<li class="d-dir" id="dir-'.$i.'"onClick="get_pages(this.id);onsl();tb2(this.id);get_dir_info(this.id);s_menu(this.id);">'.$arrf[2].'</li>';
				}
				else
				{	
					if(trim($arrf[0]) == "section") echo '<li class="d-section" id="dir-'.$i.'" onClick="onsl();s_menu(this.id);tb3(this.id);">'.$arrf[1].'</li>';		
					if(trim($arrf[0]) == "link") echo '<li class="d-link" id="dir-'.$i.'" onClick="onsl();s_menu(this.id);tb1(this.id);">'.$arrf[1].'-'.$arrf[2].'</li>';
				}
			}
		}
	}
}
?>
