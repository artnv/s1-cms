<?php
error_reporting(E_ALL ^ E_NOTICE);
require "../includes/config.php";
//////////////

ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();
if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{


	if(isset($_POST['id']))
	{
		$idtmp = explode("-",$_POST['id']);
		$id = trim($idtmp[1]);
	} else $id = false;

	if(isset($_POST['name']))
	{
		$name = strip_tags(htmlspecialchars($_POST['name']));
	} else $name = false;

	if(isset($_POST['url']))
	{
		$url = strip_tags(htmlspecialchars($_POST['url']));

	} else $url = false;
	////////////////////////////////////////////////////////


	if($_POST['umch'] == 1)
	{
		switch($_POST['m'])
		{
		case "edit":
			if($_POST['p'] == "link")
			{
				if($url && $name && $id && file_exists("../".DB_DIR."/uplinks$id"))
				{
					$f = file("../".DB_DIR."/uplinks$id");
					$str = "$name\n$url";
					file_put_contents("../".DB_DIR."/uplinks$id",$str);
				}
			}
		break;
		case "new":
			if($_POST['p'] == "link")
			{
				if($url && $name && file_exists("../".DB_DIR."/uplinksinfo"))
				{
					$menu = trim(file_get_contents("../".DB_DIR."/uplinksinfo"));
					$menu++;
					file_put_contents("../".DB_DIR."/uplinksinfo",$menu);
					$str = "$name\n$url";
					file_put_contents("../".DB_DIR."/uplinks$menu",$str);
				}
			}
		break;
		}
	}
	else
	{
		switch($_POST['m'])
		{
		case "edit":
			switch($_POST['p'])
			{
				case "dir":
					if($name && $id && file_exists("../".DB_DIR."/m$id"))
					{
						$f = file("../".DB_DIR."/m$id");
						if(trim($f[0]) == "dir" || trim($f[0]) == "main_dir")
						{
							$str = "dir\n".trim($f[1])."\n$name\n".trim($f[3])."\n".trim($f[4])."\n".trim($f[5])."\n".trim($f[6]);
							file_put_contents("../".DB_DIR."/m$id",$str);
						}
					}
				break;
				case "link":
					if($url && $name && $id && file_exists("../".DB_DIR."/m$id"))
					{
						$f = file("../".DB_DIR."/m$id");
						if(trim($f[0]) == "link")
						{
							$str = "link\n$name\n$url";
							file_put_contents("../".DB_DIR."/m$id",$str);
						}
					}
				break;
				case "section":
					if($name && $id && file_exists("../".DB_DIR."/m$id"))
					{
						$f = file("../".DB_DIR."/m$id");
						if(trim($f[0]) == "section")
						{
							$str = "section\n$name";
							file_put_contents("../".DB_DIR."/m$id",$str);
						}
					}
				break;
			}
		break;
		case "new":
			switch($_POST['p'])
			{
				case "dir":
			
					if($name && file_exists("../".DB_DIR."/freespace") && file_exists("../".DB_DIR."/menuinfo") && file_exists("../".DB_DIR."/countdir"))
					{
						$fs = file("../".DB_DIR."/freespace");

						if(count($fs) != 0) //создание лимита
						{

							$limit = trim($fs[0]); //100000-199999
							$strfs = "";

							for($i=1;$i<count($fs);$i++)
							{
								$strfs .= trim($fs[$i]);
								$strfs .= "\n";
							}

						file_put_contents("../".DB_DIR."/freespace",$strfs);
						}
						else
						{
						
							$cd = file("../".DB_DIR."/countdir");
							$mask  = trim($cd[0]);
							$count = trim($cd[1])+1;
							
							$start = $count;
							$end   = $count;

							for($i=1;$i<strlen($mask);$i++)
							{
								$start.="0";
							}
		
							for($i=1;$i<strlen($mask);$i++)
							{
								$end.="9";
							}

							$limit =  $start."-".$end; //300000-399999
							
						}
					
						//////
						$countdir = file("../".DB_DIR."/countdir");
						$d = trim($countdir[1])+1;
						$cd_str = trim($countdir[0])."\n".$d;
						file_put_contents("../".DB_DIR."/countdir",$cd_str);

						$menu = trim(file_get_contents("../".DB_DIR."/menuinfo"));
						$menu++;
						file_put_contents("../".DB_DIR."/menuinfo",$menu);
			
						$mf = "dir\n".$limit."\n".$name."\n1\n0\n0\n0";
						file_put_contents("../".DB_DIR."/m$menu",$mf);

					}

				break;
				case "link":
					if($url && $name && file_exists("../".DB_DIR."/menuinfo"))
					{
						$menu = trim(file_get_contents("../".DB_DIR."/menuinfo"));
						$menu++;
						file_put_contents("../".DB_DIR."/menuinfo",$menu);

						$str = "link\n$name\n$url";
						file_put_contents("../".DB_DIR."/m$menu",$str);
					}
				break;
				case "section":
					if($name && file_exists("../".DB_DIR."/menuinfo"))
					{
						$menu = trim(file_get_contents("../".DB_DIR."/menuinfo"));
						$menu++;
						file_put_contents("../".DB_DIR."/menuinfo",$menu);
						$str = "section\n$name";
						file_put_contents("../".DB_DIR."/m$menu",$str);
					}
				break;
			}
		break;
		}
	}
}
?>