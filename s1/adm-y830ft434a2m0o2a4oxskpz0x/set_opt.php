<?php
error_reporting(E_ALL ^ E_NOTICE);

///////
require "../includes/config.php";
require "../includes/functions.php";

///////удаляет все в каталоге
function drop_db($arg) //$arg = "dir/"
{
	if(is_dir($arg))
	{
		$fdir = scandir($arg);
		for($i=2;$i<count($fdir);$i++)
		{
			if($fdir[$i] != '.htaccess' && file_exists($arg.$fdir[$i])) unlink($arg.$fdir[$i]);
		}
	}
}

///////////////////
ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();

if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{
	//главная страница
	$sitename				= strip_tags(htmlspecialchars($_POST['sitename']));
	$siteslogan				= strip_tags(htmlspecialchars($_POST['siteslogan']));

	//Мета
	$meta_title 			= strip_tags(htmlspecialchars($_POST['meta_title'])); //Title
	$meta_keywords 			= strip_tags(htmlspecialchars($_POST['meta_keywords'])); //Keywords
	$meta_description 		= strip_tags(htmlspecialchars($_POST['meta_description'])); //Description

	//Стили
	$selected_style			= strip_tags(htmlspecialchars($_POST['selected_style'])); //Использовать стиль

	//Время
	$tz						= strip_tags(htmlspecialchars($_POST['tz'])); //Использовать стиль

	//Прочие настройки
	$options_cmt 			=	$_POST['options_cmt']; //Комментарии
	$options_pinfo			=	$_POST['options_pinfo']; // информация внизу странице
	$options_nofollow 		=	$_POST['options_nofollow']; //делает не индексируемые линки
	$options_lst 		    =	$_POST['options_lst']; //Отображать страницы списком
	$options_site 			=	$_POST['options_site']; //Сайт отключен
	$options_sitemap		=	$_POST['options_sitemap']; //Отключить sitemap
	$options_plinks			=	$_POST['options_plinks']; //Отключить sitemap
	$options_xml_sitemap	=	$_POST['options_xml_sitemap']; //Отключить sitemap
	$limit_dir				=	$_POST['limit_dir']; //лимит каталога
	$sitelink				=	strip_tags(htmlspecialchars($_POST['sitelink'])); //Адрес сайта
	$session_name			=	strip_tags(htmlspecialchars($_POST['session_name'])); //имя сессии	
	$options_index_sitemap	=	$_POST['options_index_sitemap']; //использовать карту сайта, в качестве главной страницы
	$options_cpt_links		=	$_POST['options_cpt_links']; ///компактрый вид ссылок
	$hide_ip_cmt			=	$_POST['hide_ip_cmt']; //скрыть ip в комментариях
	$drop_db				=	$_POST['drop_all']; //Удалить всю базу данных и изменить название директорий
	
	//Настройки доступа
	$name					= strip_tags(htmlspecialchars(trim($_POST['name']))); //Имя
	$login					= strip_tags(htmlspecialchars(trim($_POST['login']))); //Логин
	$newpass				= trim($_POST['newpass']); //Новый пароль (если хотите изменить старый)

	//Пароль подтверждения
	$oldpass				= trim($_POST['oldpass']); //старый пароль
	$ban					= strip_tags(htmlspecialchars($_POST['ban']));
	$unban					= strip_tags(htmlspecialchars($_POST['unban']));
	
	/////////////////////////////////////////////////////////////////////////////////////////////


	$oldpass = get_hash($oldpass, DB_DIR, ADM_DIR, LOGIN);
	
	if(PASSWORD == $oldpass)
	{

		if(!empty($options_cmt)) 			$options_cmt=1; 			else $options_cmt=0;
		if(!empty($options_pinfo)) 			$options_pinfo=1; 			else $options_pinfo=0;
		if(!empty($options_nofollow)) 		$options_nofollow=1;		else $options_nofollow=0;
		if(!empty($options_lst)) 			$options_lst=1;				else $options_lst=0;
		if(!empty($options_site)) 			$options_site=1;			else $options_site=0;
		if(!empty($options_sitemap))		$options_sitemap=1;			else $options_sitemap=0;
		if(!empty($options_xml_sitemap))	$options_xml_sitemap=1;		else $options_xml_sitemap=0;
		if(!empty($options_plinks))			$options_plinks=1;			else $options_plinks=0;
		if(!empty($options_index_sitemap))	$options_index_sitemap=1;	else $options_index_sitemap=0;
		if(!empty($options_cpt_links))		$options_cpt_links=1;		else $options_cpt_links=0;
		if(!empty($drop_db))				$drop_db=1;					else $drop_db=0;
		if($hide_ip_cmt > 3 || $hide_ip_cmt <= 0) $hide_ip_cmt = 1;
		
		////////////
		$adm_dir = ADM_DIR;
		$db_dir  = DB_DIR;
	
		//замена http в адресе
		$sitelink = str_replace("http://","",$sitelink);
		
		//изменение пароля
		if(!empty($newpass))
		{
			$oldpass = get_hash($newpass, DB_DIR, ADM_DIR, LOGIN);
			$_SESSION['admmod'] = false;
		}
		
		//изменение пароля, если новый логин
		if($login != LOGIN)
		{
			$oldpass = get_hash($newpass, DB_DIR, ADM_DIR, $login);
			$_SESSION['admmod'] = false;
		}

		//добавляет ip, в бан
		if(!empty($ban))
		{
			$fb = fopen("../".DB_DIR."/banlist", "a+");
			fputs($fb,($ban."\n"));
			fclose($fb);
		}
		
		//удаляет ip, из бана
		if($unban != "none" && is_numeric($unban))
		{
			$ub = file("../".DB_DIR."/banlist");
			$fub = fopen("../".DB_DIR."/banlist", "w+");
			for($i=0;$i<count($ub);$i++)
			{
				if($i != $unban)
				{
					fputs($fub,(trim($ub[$i])."\n"));	
				} else continue;
			}
			fclose($fub);
		}
		
		//создание лимита, каталога
		if($limit_dir > 0 && $limit_dir < 7 && file_exists("../".DB_DIR."/countdir"))
		{
			$cd = file("../".DB_DIR."/countdir");	
			
			if(trim($cd[1]) == 0)
			{
				$ch = array("xxx", "xxxx", "xxxxx", "xxxxxx", "xxxxxxx", "xxxxxxxx");
				$s = $ch[$limit_dir-1]."\n0";
				file_put_contents("../".DB_DIR."/countdir",$s);
			}
		}
		else 
		{
			$limit_dir = LIMIT_DIR;
		}


		//переустановка
		if($drop_db == 1)
		{
			drop_db("../".DB_DIR."/");
			
			$adm_dir = "adm";
			$db_dir  = "database"; 
			
			rename("../".DB_DIR, "../".$db_dir);
			rename("../".ADM_DIR, "../".$adm_dir);
		}
	
	

$save = '<?php

//имя
define("NAME","'.$name.'");

//пароль
define("PASSWORD","'.$oldpass.'");

//логин
define("LOGIN","'.$login.'");

//название (по умолчанию)
define("TITLE","'.$meta_title.'");

//ключевые слова (по умолчанию)
define("KEYWORDS","'.$meta_keywords.'");

//описание (по умолчанию)
define("DESCRIPTION","'.$meta_description.'");

//ссылка на директорию скрипта
define("SITELINK","'.$sitelink.'");

//название сайта
define("SITENAME","'.$sitename.'");

//название сессии
define("SESSION_NAME","'.$session_name.'");

//слоган сайта
define("SITESLOGAN","'.$siteslogan.'");

//выбранный стиль
define("STYLE","'.$selected_style.'");

//стиль панели управления
define("ADMSTYLE","'.ADMSTYLE.'");

//разрешить комментарии
define("OPTIONS_CMT","'.$options_cmt.'");

//Информация о странице (дата, комменты и тд)
define("OPTIONS_PINFO","'.$options_pinfo.'");

//Добавлять rel="nofollow" к ссылкам, в комментариях
define("OPTIONS_NOFOLLOW","'.$options_nofollow.'");

//Отображать страницы списком
define("OPTIONS_LST","'.$options_lst.'");

//Отключить сайт
define("OPTIONS_SITE","'.$options_site.'");

//Карта сайта для людей
define("OPTIONS_SITEMAP","'.$options_sitemap.'");

//директория админки
define("ADM_DIR","'.$adm_dir.'");

//часовой пояс
define("TIME_ZONE","'.$tz.'");

//директория бд
define("DB_DIR","'.$db_dir.'");

//Карта сайта для поисковых машин (XML)
define("OPTIONS_XML_SITEMAP","'.$options_xml_sitemap.'");

//Отключить ссылки, под страницами
define("OPTIONS_PLINKS","'.$options_plinks.'");

//Использовать карту сайта, как главнуюю страницу
define("OPTIONS_INDEX_SITEMAP","'.$options_index_sitemap.'");

//Компактный вид ссылок
define("OPTIONS_CPT_LINKS","'.$options_cpt_links.'");

//лимит страниц на каталог (не трогать!)
define("LIMIT_DIR","'.$limit_dir.'");

//скрыть ip в комментариях
define("HIDE_IP_CMT","'.$hide_ip_cmt.'");

?>';

		file_put_contents("../includes/config.php",$save);
	
		//после переустановки
		if($drop_db == 1) header('Location: http://'.SITELINK); else header('Location: index.php?act=settings');
	
	} else echo '<html><head><meta http-equiv="refresh" content="1; url=index.php?act=settings"></head><body>Fail!</body></html>'; 
}
?>