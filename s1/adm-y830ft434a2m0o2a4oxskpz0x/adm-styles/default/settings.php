<?php 
if(empty($lc)) $lc = false;
if($lc == true)
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель управления: настройки</title>
<link href="<?php echo "adm-styles/".ADMSTYLE."/";?>scripts/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?php echo "adm-styles/".ADMSTYLE."/";?>img/favicon.ico" type="image/x-icon" />
<script src="<?php echo "adm-styles/".ADMSTYLE."/";?>scripts/main.js" type="text/javascript"></script>
<script type="text/javascript">
function load()
{
	report_msg(<?php get_inform(); ?>);
}
</script>
</head>

<body onload="load();">
<div id="main">

<div id="header">
<div id="link-block">
<ul>  
  <li style="margin-right:40px;"><a href="../index.php">&larr; На главную</a></li>
  <li><a href="index.php?act=editor">Редактор</a></li>
  <li>Настройки</li>
  <li><a href="index.php?act=logout">Выход</a></li>
</ul>
</div><!--LINK-BLOCK-->
<div id="left-block">Панель управления</div>
 <div id="clear-r"></div>
</div><!--HEADER-->

<div id="content">

<div id="stng">
<form method="post" action="set_opt.php">
<table width="100%" border="0">
  <tr>
    <td style="width:45%;" align="left" valign="top">
       
	<div class="stgb">
        <div class="stgbh">Сайт</div>
         <div class="stg-h">Название сайта</div>
		 
        <input type="text" class="inptext" name="sitename" value="<?php echo SITENAME;?>" />
		
		<div class="stg-h">Слоган</div>
        <input type="text" class="inptext" name="siteslogan" value="<?php echo SITESLOGAN;?>" />
		        
		<div class="stg-h">Адрес сайта</div>
        <input type="text" class="inptext" name="sitelink" value="<?php echo 'http://'.SITELINK;?>" /> 
		
		<div class="stg-h">Название сессии в cookies</div>
        <input type="text" class="inptext" name="session_name" value="<?php echo SESSION_NAME;?>" /> 
		
		<div class="stg-h"><label>Отображать страницы списком
		<input type="checkbox" class="checkbox" name="options_lst" <?php add_checked(OPTIONS_LST);?> /></label></div>

		<div class="stg-h"><label>Отключить ссылки, под страницами
		<input type="checkbox" class="checkbox" name="options_plinks" <?php add_checked(OPTIONS_PLINKS);?> /></label></div> 

		<div class="stg-h"><label>Компактный вид ссылок
		<input type="checkbox" class="checkbox" name="options_cpt_links" <?php add_checked(OPTIONS_CPT_LINKS);?> /></label></div>

		<div class="stg-h"><label>Информация о странице (дата, комментарии и тд)<input type="checkbox" class="checkbox" name="options_pinfo" <?php add_checked(OPTIONS_PINFO);?> /></label></div>
		
		<div class="stg-h"><label>Отключить сайт
        <input type="checkbox" class="checkbox" name="options_site" <?php add_checked(OPTIONS_SITE);?> /></label></div>
		  
    </div><!--stgb-->
	
	
    <div class="stgb">
        <div class="stgbh">META - информация, по умолчанию</div>
        
        <div class="stg-h">Title</div>
        <input type="text" class="inptext" name="meta_title" value="<?php echo TITLE;?>" />
        
        <div class="stg-h">Keywords</div>
        <input type="text" class="inptext" name="meta_keywords" value="<?php echo KEYWORDS;?>" />
        
        <div class="stg-h">Description</div>
        <input type="text" class="inptext" name="meta_description" value="<?php echo DESCRIPTION;?>" />        
                
    </div><!--stgb-->

	<div class="stgb">
		<div class="stgbh">Комментарии</div>
		<div class="stg-h"><label>Возможность комментировать
		<input type="checkbox" class="checkbox" name="options_cmt" <?php add_checked(OPTIONS_CMT);?> /></label></div>

		<div class="stg-h"><label>Добавлять (rel="nofollow") к ссылкам, в комментариях
		<input type="checkbox" class="checkbox" name="options_nofollow" <?php add_checked(OPTIONS_NOFOLLOW);?> /></label></div>
		
		<div class="stg-h">ip - адрес, в комментариях</div>
		<select class="so" name="hide_ip_cmt">
			<?php get_hic(); ?>
		</select>
		
		<div class="stg-h">Добавьте IP, который хотите забанить</div>
        <input type="text" class="inptext" name="ban" /> 

        <div class="stg-h">Выберите IP, который хотите разбанить</div>
		<select class="so" name="unban" style="height:23px;">
		<?php get_bl(); ?>
		</select>   
	</div><!--stgb--> 
	
    </td>
    <td width="10%" align="left" valign="top">&nbsp;</td>
    <td width="45%" align="left" valign="top">
    
	
	<div class="stgb">
        <div class="stgbh">Настройка времени</div>   
		
		<div class="stg-h">Выбранное время</div>
        <input type="text" class="inptext" value="<?php def_tz(); ?>" disabled="disabled" />
		
        <div class="stg-h">Выберите ваше время</div>
        <select class="so" name="tz">
		<?php tz(); ?>
        </select>
    </div><!--stgb-->  
	
	
     <div class="stgb">
        <div class="stgbh">Стилизация</div>   
		
		<div class="stg-h">Текущий стиль</div>
        <input type="text" class="inptext" value="<?php echo STYLE;?>" disabled="disabled" />
		
        <div class="stg-h">Использовать стиль</div>
        <select class="so" name="selected_style">
		<?php get_style();?>
        </select>
    </div><!--stgb-->   

	<div class="stgb">
	<div class="stgbh">Карта сайта</div>
		<div class="stg-h"><label>Карта сайта для людей
		<input type="checkbox" class="checkbox" name="options_sitemap" <?php add_checked(OPTIONS_SITEMAP);?> /></label></div>  

		<div class="stg-h"><label>Карта сайта для ПМ (XML) 
		<input type="checkbox" class="checkbox" name="options_xml_sitemap" <?php add_checked(OPTIONS_XML_SITEMAP);?> /></label></div>

		<div class="stg-h"><label>Использовать карту сайта, как главнуюю страницу
		<input type="checkbox" class="checkbox" name="options_index_sitemap" <?php add_checked(OPTIONS_INDEX_SITEMAP);?> /></label></div>	
	</div><!--stgb--> 	
	
	<div class="stgb">
        <div class="stgbh">Лимит страниц, на каталог</div>
        <?php get_limit_dir(); ?>
    </div><!--stgb-->
	
	<div class="stgb">
        <div class="stgbh" style="background-color: #f7bc75;">Переустановка</div>  
		<div class="stg-h"><label>Удалить всю базу данных и изменить название директорий
		<input type="checkbox" class="checkbox" name="drop_all"/></label></div>
    </div><!--stgb-->
	
    <div class="stgb">
        <div class="stgbh" style="background-color: #f7bc75;">Настройка доступа</div>
        
        <div class="stg-h">Имя</div>
        <input type="text" class="inptext" name="name" value="<?php echo NAME;?>" /> 

        <div class="stg-h">Логин</div>
        <input type="text" class="inptext" name="login" value="<?php echo LOGIN;?>" />
        
        <div class="stg-h">Новый пароль</div>
        <input type="password" class="inptext" name="newpass" />                
    </div><!--stgb-->

    </td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">
	
    <div class="oldp">
        <div class="stg-h">Введите старый пароль</div>
        <input type="password" class="inptext" name="oldpass" /> 
		<br/>  
		<input type="submit" value="Изменить настройки" style="margin-bottom:10px;" />
    </div>
    
    </td>
    </tr>
</table>
</form>
</div><!--stng-->

</div><!--CONTENT-->
<div id="footer">
<div id="copyright">© Art. 2010-2011<br/> v0.1.0</div>
</div><!--FOOTER-->
</div><!--MAIN-->
</body>
</html>
<?php 
}
?>