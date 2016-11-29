<?php
error_reporting(E_ALL ^ E_NOTICE);
include "../includes/config.php";
////////////


ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();

header('Content-Type: text/html; charset=utf-8');

if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{


	if(isset($_POST['h']))
	{
		$header = $_POST['h'];
		$header = htmlspecialchars(strip_tags($header));
		
	} else $header = false;

	if(isset($_POST['editor']))
	{
		$txt = $_POST['editor'];
		$txt = htmlspecialchars(strip_tags($txt,'<img><a><span><p><br>'));
	
	} else $txt = false;

	if(isset($_POST['title']))
	{
		$title = $_POST['title'];
		$title = htmlspecialchars(strip_tags($title));
		
	} else $title = false;

	if(isset($_POST['keywords']))
	{
		$keywords = $_POST['keywords'];
		$keywords = htmlspecialchars(strip_tags($keywords));
		
	} else $keywords = false;

	if(isset($_POST['description']))
	{
		$description = $_POST['description'];
		$description = htmlspecialchars(strip_tags($description));
		
	} else $description = false;

	//////////////
	if(isset($_POST['newmeta']) && $_POST['newmeta'] == "true")
	{
		$newmeta	=	1;
	} else $newmeta = 0; 

	if(isset($_POST['cmt']) && $_POST['cmt'] == "true")
	{
		$cmt = 1;
	} else $cmt = 0;

	if(isset($_POST['indexpage']) && $_POST['indexpage'] == "true")
	{
		$indexpage = 1;
	} else $indexpage = 0;

	if(isset($_POST['selected']))
	{

		$sl = explode("-",$_POST['selected']);
		if(trim($sl[0]) == "dir") $selected_dir = true; else $selected_dir = false;
		
		if(is_numeric(trim($sl[1]))) $selected_num = trim($sl[1]); else $selected_num = false;

	} else $selected_dir = false;
	///////////////////////////////////////////////////////////////////////////////////////



	if($selected_dir && file_exists("../".DB_DIR."/m$selected_num")) //новая страница
	{
		$m1 = file("../".DB_DIR."/m$selected_num");
		$pn = explode("-",trim($m1[1]));
		$pnum = $pn[0]+(trim($m1[4])+1);
		
		if(($pnum-1) < $pn[1])
		{
			$m1_str = trim($m1[0])."\n".trim($m1[1])."\n".trim($m1[2])."\n".trim($m1[3])."\n".(trim($m1[4])+1)."\n".(trim($m1[5])+1)."\n".trim($m1[6]);
			$info_str = $newmeta."\n".$keywords."\n".$description."\n".$title."\n".date('j.m.Y').".".gmdate("H:i",time()+((TIME_ZONE)*3600))."\n".$header."\n"."0"."\n".$cmt."\n0\n0";
			
			////
			if(!file_exists("../".DB_DIR."/p$pnum") && !file_exists("../".DB_DIR."/inf$pnum"))
			{
				if($indexpage == 1 && file_exists("../".DB_DIR."/indexinfo"))
				{
					$ix = trim(file_get_contents("../".DB_DIR."/indexinfo"))+1;
					file_put_contents("../".DB_DIR."/indexinfo",$ix);
					file_put_contents("../".DB_DIR."/index$ix",$pnum);
				}
				file_put_contents("../".DB_DIR."/inf$pnum",$info_str);
				file_put_contents("../".DB_DIR."/p$pnum",$txt);
				file_put_contents("../".DB_DIR."/m$selected_num",$m1_str);
			}
		}
	}
	else //обновление страницы
	{
		if(file_exists("../".DB_DIR."/p$selected_num") && file_exists("../".DB_DIR."/inf$selected_num"))
		{

			
			
			/////index
			if($indexpage == 1)
			{
				$lck = 1;
				$tmpix = trim(file_get_contents("../".DB_DIR."/indexinfo"));
				
				for($i=1;$i<=$tmpix;$i++)
				{
					$tmpix2 = trim(file_get_contents("../".DB_DIR."/index$i"));
					
					if($tmpix2 == $selected_num)
					{
						$lck = 0;
						break;
					}
					
				}
			
				if($lck == 1)
				{
					$ix = trim(file_get_contents("../".DB_DIR."/indexinfo"))+1;
					file_put_contents("../".DB_DIR."/indexinfo",$ix);
					file_put_contents("../".DB_DIR."/index$ix",$selected_num);
				}
				
			}
			else
			{
			
				$cnt = trim(file_get_contents("../".DB_DIR."/indexinfo"));
					
				for($i=1;$i<=$cnt;$i++)
				{
					if(file_exists("../".DB_DIR."/index$i"))
					{
						$f = trim(file_get_contents("../".DB_DIR."/index$i"));
						if($f == $selected_num)
						{
							unlink("../".DB_DIR."/index$i");
							
							if($i != $cnt)
							{
								$e = $i;
								$j = $i+1;
								for(;$e<$cnt;$e++)
								{
									rename("../".DB_DIR."/index$j","../".DB_DIR."/index$e");	
									$j++;
								}
							
							}

							$cnt--;
							file_put_contents("../".DB_DIR."/indexinfo",$cnt);
								
							break;
						}
					}
				}
			
			}
			$ftm = file("../".DB_DIR."/inf$selected_num");
			$info_str = $newmeta."\n".$keywords."\n".$description."\n".$title."\n".date('j.m.Y').".".gmdate("H:i",time()+((TIME_ZONE)*3600))."\n".$header."\n".trim($ftm[6])."\n".$cmt."\n".trim($ftm[8])."\n".trim($ftm[9]);
				
			////
			file_put_contents("../".DB_DIR."/inf$selected_num",$info_str);
			file_put_contents("../".DB_DIR."/p$selected_num",$txt);
		}
	}

}
?>