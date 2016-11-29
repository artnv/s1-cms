<?php
function get_ndir($id) //new get_ndir
{
	if(is_numeric($id))
	{
		if(file_exists(DB_DIR."/menuinfo"))
		{
			$cnt = trim(file_get_contents(DB_DIR."/menuinfo"));
			for($i=1;$i<=$cnt;$i++)
			{
				if(file_exists(DB_DIR."/m$i"))
				{
					$tmpdir = file(DB_DIR."/m$i");
	
					if(trim($tmpdir[0]) == 'dir' || trim($tmpdir[0]) == 'main_dir')
					{
						$direxp = explode('-',$tmpdir[1]);
						if($id >= $direxp[0] && $id <= $direxp[1])
						{
							return $i;
				
						} else continue;
			
					} else continue;
		
				} else continue;
			}
		}
	} else return false;
}

function no_cache()
{
	header('Expires: Wed, 20 Dec 1980 00:30:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-control: no-cache, must-revalidate ');
	header('Pragma: no-cache');
}

function check_ban()
{

	if(file_exists(DB_DIR."/banlist"))
	{
		$bl = file(DB_DIR."/banlist");
		for($i=0;$i<count($bl);$i++)
		{
			if(trim($bl[$i]) == $_SERVER["REMOTE_ADDR"]) return false;
		}
		return true;
	}
}
function get_date_time($arg)
{
	$arg2 	= explode(".",trim($arg));

	switch(trim($arg2[1]))
	{
		case "01":
		$dt = "Января";
		break;
		case "02":
		$dt = "Февраля";
		break;
		case "03":
		$dt = "Марта";
		break;
		case "04":
		$dt = "Апреля";
		break;
		case "05":
		$dt = "Мая";
		break;
		case "06":
		$dt = "Июня";
		break;
		case "07":
		$dt = "Июля";
		break;
		case "08":
		$dt = "Августа";
		break;
		case "09":
		$dt = "Сентября";
		break;
		case "10":
		$dt = "Октября";
		break;
		case "11":
		$dt = "Ноября";
		break;
		case "12":
		$dt = "Декабря";
		break;
	}

	return ($arg2[0]." $dt ".$arg2[2]."г. ".$arg2[3]);
}
function install()
{
	header('Content-Type: text/html; charset=utf-8');
	if(ADM_DIR == "adm" && DB_DIR == "database" && file_exists("adm") && file_exists("database"))
	{
		$t_adm	=	'adm-';
		$t_db	=	'database-';
		
		$str = "qwe01r2ty3u4io5p6mn7b8v9c0xza0sdf0ghjkl";
		
		for($i=1;$i<=25;$i++)
		{
			$t_adm 	.= $str[mt_rand(0,38)];
			$t_db 	.= $str[mt_rand(0,38)];	
		}
		
		rename('adm', $t_adm);
		rename('database', $t_db); 
		
		$adm_pass	=	get_hash("admin", $t_db, $t_adm, "admin");
			
			
$save = '<?php

//имя
define("NAME","'.NAME.'");

//пароль
define("PASSWORD","'.$adm_pass.'");

//логин
define("LOGIN","admin");

//название (по умолчанию)
define("TITLE","'.TITLE.'");

//ключевые слова (по умолчанию)
define("KEYWORDS","'.KEYWORDS.'");

//описание (по умолчанию)
define("DESCRIPTION","'.DESCRIPTION.'");

//ссылка на директорию скрипта
define("SITELINK","'.SITELINK.'");

//название сайта
define("SITENAME","'.SITENAME.'");

//название сессии
define("SESSION_NAME","'.SESSION_NAME.'");

//слоган сайта
define("SITESLOGAN","'.SITESLOGAN.'");

//выбранный стиль
define("STYLE","'.STYLE.'");

//стиль панели управления
define("ADMSTYLE","'.ADMSTYLE.'");

//разрешить комментарии
define("OPTIONS_CMT","'.OPTIONS_CMT.'");

//Информация о странице (дата, комменты и тд)
define("OPTIONS_PINFO","'.OPTIONS_PINFO.'");

//Добавлять rel="nofollow" к ссылкам, в комментариях
define("OPTIONS_NOFOLLOW","'.OPTIONS_NOFOLLOW.'");

//Отображать страницы списком
define("OPTIONS_LST","'.OPTIONS_LST.'");

//Отключить сайт
define("OPTIONS_SITE","'.OPTIONS_SITE.'");

//Карта сайта для людей
define("OPTIONS_SITEMAP","'.OPTIONS_SITEMAP.'");

//директория админки
define("ADM_DIR","'.$t_adm.'");

//часовой пояс
define("TIME_ZONE","'.TIME_ZONE.'");

//директория бд
define("DB_DIR","'.$t_db.'");

//Карта сайта для поисковых машин (XML)
define("OPTIONS_XML_SITEMAP","'.OPTIONS_XML_SITEMAP.'");

//Отключить ссылки, под страницами
define("OPTIONS_PLINKS","'.OPTIONS_PLINKS.'");

//Использовать карту сайта, как главнуюю страницу
define("OPTIONS_INDEX_SITEMAP","'.OPTIONS_INDEX_SITEMAP.'");

//Компактный вид ссылок
define("OPTIONS_CPT_LINKS","'.OPTIONS_CPT_LINKS.'");

//лимит страниц на каталог (не трогать!)
define("LIMIT_DIR","3");

//скрыть ip в комментариях
define("HIDE_IP_CMT","1");

?>';

	file_put_contents("includes/config.php",$save);
	
	
	////
	$s_file["banlist"] 		= "";
	$s_file["accesslog"] 	= "";
	$s_file["countdir"] 	= "xxxxx\n0";
	$s_file["error404"] 	= "<div style=\"font-size:30px;font-weight:bold;\">\n404\n</div>\n<span style=\"font-size:16px;\">Страница не найдена</span>";
	$s_file["freespace"] 	= "";
	$s_file["index.html"]	= "\n";
	$s_file["indexinfo"] 	= "0";
	$s_file["errorlog"] 	= "";
	$s_file["loginban"] 	= "";
	$s_file["menuinfo"] 	= "0";
	
	$s_file["uplinksinfo"]	= "4";
	$s_file["uplinks1"]		= "Панель управления\nindex.php?id=login";
	$s_file["uplinks2"]		= "(XML) Карта сайта\nindex.php?id=xmlsitemap";
	$s_file["uplinks3"]		= "Карта сайта\nindex.php?id=sitemap";
	$s_file["uplinks4"]		= "Главная страница\nindex.php";
	
	$s_file[".htaccess"] 	= "Options -Indexes\ndeny from all";

	foreach ($s_file as $key => $value) 
	{
		if(!file_exists($key))
		{
			file_put_contents("$t_db/$key", $value);
		}
	}
	
	
	echo '<html><head><meta http-equiv="refresh" content="2; url=index.php"></head><body>Настройка...</body></html>';
	return false;
	} 
	return true;
}
function set_login()
{
	$str	=	date('j.m.Y').' - '.gmdate("H:i",time()+((TIME_ZONE)*3600)).' - '.$_SERVER['REMOTE_ADDR'].' - '.$_SERVER['HTTP_USER_AGENT']."\n";
	$login_file = fopen(DB_DIR."/accesslog", "a");
	fputs($login_file,$str);
	fclose($login_file);
}
function get_hash($pass, $db_s, $adm_s, $login) ///pass, DB_DIR, ADM_DIR, login
{
	$pass_cnt	=	strlen($pass);
	$dbs_cnt	=	strlen($db_s);
	$adms_cnt	=	strlen($adm_s);
	
	$a			=	$dbs_cnt;
	$b			=	$adms_cnt;
	$c			=	"";
	$rstr		=	"";
	
	if($pass_cnt > 0 && $pass_cnt < 100 && $dbs_cnt > 0 && $dbs_cnt < 100 && $adms_cnt > 0 && $adms_cnt < 100)
	{
		for($i=0;$i<$pass_cnt;$i++)
		{
			$a--; $b--;
			if(isset($db_s[$a])) 	$rstr .= $db_s[$a];
			if(isset($pass[$i])) 	$rstr .= $pass[$i];
			if(isset($adm_s[$b]))	$rstr .= $adm_s[$b];
		}
			
		if($a > 0)
		{
			for(;$a>0;$a--)
			{
				if(isset($db_s[$a])) 	$rstr .= $db_s[$a];
			}
		}
		
		if($b > 0)
		{
			for($i=0;$i<$b;$i++)
			{
				if(isset($adm_s[$b]))	$c .= $adm_s[$i];
			}
		}
	
		return (md5(md5($c).md5($rstr.$login)));
	} else return null;
}

function add_error($arg)
{
	if(file_exists(DB_DIR."/errorlog"))
	{
		$str	=	date('j.m.Y').' - '.gmdate("H:i",time()+((TIME_ZONE)*3600)).' - '.$arg."\n";
		$login_file = fopen(DB_DIR."/errorlog", "a");
		fputs($login_file,$str);
		fclose($login_file);
	}
}

function get_loginban()
{
	$result = true;
	$d 		= date('j.m.Y');
	
	if(file_exists(DB_DIR."/loginban"))
	{
		$lb		=	file(DB_DIR."/loginban");
		$lb_cnt	=	count($lb);
		
		$nlb = fopen(DB_DIR."/loginban", "wa");
		for($i=0;$i<$lb_cnt;$i++)
		{
			$ex	=	explode("-", $lb[$i]);
			
			if($d == trim($ex[1]))
			{
				if($_SERVER['REMOTE_ADDR'] == trim($ex[2])) 
				{
					if(trim($ex[0]) == "b" or trim($ex[0]) > 5)
					{
						$result = false;
					}
				}
				fputs($nlb,$lb[$i]);
			} else add_error("Из списка заблокированных, удален: ".trim($ex[2]).", в связи с истечением времени.");
		}
		fclose($nlb);
	}
	return $result;
}

function set_loginban()
{
	if(file_exists(DB_DIR."/loginban"))
	{
		$lb		=	file(DB_DIR."/loginban");
		$lb_cnt	=	count($lb);
		$t 		= 	"";
		$l		=	false;
		
		$nlb = fopen(DB_DIR."/loginban", "wa");
		for($i=0;$i<$lb_cnt;$i++)
		{
			$ex	=	explode("-", $lb[$i]);
			if($_SERVER['REMOTE_ADDR'] == trim($ex[2]))
			{
				$l	=	true;
				$t = trim($ex[0]);
				if($t != "b")
				{
					if($t != 5) $t++; else $t = "b";
				}	
				fputs($nlb,($t."-".trim($ex[1])."-".trim($ex[2])."\n"));
			}
			else fputs($nlb,$lb[$i]);
		}
		fclose($nlb);
		
		if($l == false)
		{
			$nlb = fopen(DB_DIR."/loginban", "a");
			fputs($nlb,("1-".date('j.m.Y')."-".$_SERVER['REMOTE_ADDR']."\n"));
			fclose($nlb);
			add_error("В список заблокированных, добавлен: ".$_SERVER['REMOTE_ADDR'].", за неоднократные попытки входа, в панель управления.");
		}
	}
}
?>