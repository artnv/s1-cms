<?php 
if(empty($lc)) $lc = false;	
if($lc == true)
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель управления</title>
<link href="<?php echo "adm-styles/".ADMSTYLE."/";?>scripts/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="<?php echo "adm-styles/".ADMSTYLE."/";?>img/favicon.ico" type="image/x-icon" />
<script type="text/javascript">
function get_sessn()
{
	return "<?php add_sessn_to_js(); ?>";
}
function load()
{
	get_menu();
	get_index_page();
	offsl();
	tb1();
	edtbtn(1);
	report_msg(<?php get_inform(); ?>);
}
</script>
<script src="<?php echo "adm-styles/".ADMSTYLE."/";?>scripts/main.js" type="text/javascript"></script>
</head>

<body onload="load();">
<div id="main">




<div id="header">

<div id="link-block">
<ul>
  <li style="margin-right:40px;"><a href="../index.php">&larr; На главную</a></li>
  <li>Редактор</li>
  <li><a href="index.php?act=settings">Настройки</a></li>
  <li><a href="index.php?act=logout">Выход</a></li>
</ul> 
</div><!--LINK-BLOCK-->

<div id="left-block">Панель управления 
<img id="loading1" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading2" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading3" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading4" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading5" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading6" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading7" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading8" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading9" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
<img id="loading10" class="loading" src="<?php echo "adm-styles/".ADMSTYLE."/img/";?>loading.gif" alt="loading" />
</div> 

<div id="clear-r"></div>
</div><!--HEADER-->





<div id="content">

<div id="dir_block">
      <table style="width:100%;" border="0">
	  
        <tr>
          <td style="width:24%;" align="left" valign="top"><div id="loading_1"></div>     <div class="um" style="background:#f6f8f8;" id="umch1" onclick="umch('l');">Боковое меню</div>  <div class="um" style="margin-left:110px;" id="umch2" onclick="umch('u');">Верхнее меню</div>  </td>
          <td style="width:36%;" align="left" valign="top"><div id="loading_2"></div>Страницы каталога:</td>
          <td style="width:20%;" align="left" valign="top"><div id="loading_3"></div>Главная страница:</td>
        </tr>
		
        <tr>
		
		<td align="left" valign="top" class="dir_block_tdp">
		
		<div id="newmn">
		<div class="btnup" title="Переместить вверх" onclick="set_opt('up','dir');"></div>
		<div class="btndown" title="Переместить вниз" onclick="set_opt('down','dir');"></div>
		<div class="btndel" title="Удалить" onclick="set_opt('del','dir');"></div>
		</div>

        <div id="chblock">
		</div><!--CHBLOCK-->
		</td>
		
        <td align="left" valign="top" class="dir_block_tdp">
          <div id="newmn2">
			<div class="btndel" title="Удалить страницу" onclick="set_opt('del','page');"></div>
		  </div>
          <div id="chblock2">                                     
    	  </div><!--CHBLOCK2-->
        </td>
		
        <td align="left" valign="top" style="padding-right:6px;">
		
		<div id="newmn3">
		<div class="btndel" title="Убрать с главной страницы" onclick="set_opt('del','index');"></div>
		</div>
		
          <div id="chblock3">
    	  </div><!--CHBLOCK3-->
        </td>
		
        </tr>
      </table>
	  
<div class="addlsc" id="als">
<table style="width:100%;height:45px;"  border="0">
  <tr>
    <td style="width:38%;background-color:#f6f6f6;" align="center" valign="middle">
	
	<span id="sl1" onclick="onsl();">Изменить </span>/<span id="sl2" onclick="offsl();"> Добавить </span>:
	
	<div id="bgw">
   <span id="tb1" onclick="tb1();">Ссылку </span>
   <span id="tb2" onclick="tb2();">Каталог </span>
   <span id="tb3" onclick="tb3();">Раздел </span>
    </div>
    </td>
    <td style="width:50%;background-color:#f6f6f6;" align="center" valign="middle">
	
	<div id="tab1">
    Название ссылки: <input type="text" style="margin-right:10px;width:120px;"  id="tab1-ln" />
    URL:  <input type="text"  style="width:120px;" id="tab1-url" />
    </div> 
	
	<div id="tab2">
    Название каталога: <input type="text" style="margin-right:10px;width:120px;" id="tab2-nd" />
    </div> 
	
	<div id="tab3">
    Название раздела: <input type="text" style="margin-right:10px;width:120px;"  id="tab3-ns" />
    </div> 

    </td>
    <td style="width:12%;background-color:#f6f6f6;" align="center" valign="middle"><input type="submit" id="sbb" value="Добавить" onclick="newedit();" /></td>
  </tr>
</table>
</div>

<div id="info">
<table width="100%" border="0">
  <tr>
    <td style="width:30%;" class="info_trbg cb" align="center" valign="top">Выбранный каталог</td>
    <td style="width:20%;" class="info_trbg cb" align="center" valign="top">Размер каталога</td>
    <td style="width:20%;" class="info_trbg cb" align="center" valign="top">Страницы</td>
    <td style="width:20%;" class="info_trbg cb" align="center" valign="top">Комментарии к каталогу</td>
	<td style="width:10%;" class="info_trbg cb" align="center" valign="top">Главный каталог</td>
    </tr>
  <tr>
    <td align="center" valign="top" id="j-sldir"></td>
    <td align="center" valign="top" id="j-sizedir"></td>
    <td align="center" valign="top" id="j-pages"></td>
    <td align="center" valign="top" id="j-cmt"></td>
	<td align="center" valign="top" id="j-maindir"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<br/>
<table style="width:100%;" border="0">
  <tr>
    <td style="width:40%;" class="info_trbg cb" align="center" valign="top"><div id="pvb" title="Переместить страницу в выбранный каталог" onclick="set_opt('move','move');"></div> Выбранная страница</td>
	<td style="width:20%;" class="info_trbg cb" align="center" valign="top">Размер страницы</td>
    <td style="width:20%;" class="info_trbg cb" align="center" valign="top">Комментарии</td>
	<td style="width:20%;" class="info_trbg cb" align="center" valign="top">Дата создания</td>
    </tr>
  <tr>
    <td align="center" valign="top" id="p-h"></td>
    <td align="center" valign="top" id="p-size"></td>
	<td align="center" valign="top" id="p-count"></td>
	<td align="center" valign="top" id="p-date"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</div><!--INFO-->

</div><!--DIR-BLOCK-->


 <div id="editor_h">
	<div id="ehb1" class="editor_hbtn_t" onclick="edtbtn(1);">Редактор</div>
	<div id="ehb2" class="editor_hbtn_t" onclick="edtbtn(2);">История посещений</div>
	<div id="ehb3" class="editor_hbtn_t" onclick="edtbtn(3);">Информация системы</div>
</div>	

<div id="editor">
<div id="edt">

  <table style="width:100%;" border="0">
    <tr>
      <td align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td style="width:50%;" align="left" valign="top">Заголовок</td>
      <td style="width:50%;" align="left" valign="top">(META) Title</td>
    </tr>
    <tr>
      <td align="left" valign="top"><input type="text" class="inptxt" id="e-h" /></td>
      <td align="left" valign="top"><input type="text" class="inptxt" id="e-title" /></td>
    </tr>
    <tr>
      <td align="left" valign="top">Редактор (html форматирование отключено)</td>
      <td align="left" valign="top">(META) Keywords</td>
    </tr>
    <tr>
      <td rowspan="10" align="left" valign="top"><textarea class="textarea" id="txtar" rows="0" cols="0"></textarea></td>
      <td align="left" valign="top"><input type="text" class="inptxt" id="e-keywords"/></td>
    </tr>
    <tr>
      <td align="left" valign="top">(META) Description</td>
    </tr>
    <tr>
      <td align="left" valign="top"><input type="text" class="inptxt" id="e-description"/></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top" id="e-meta"><label><input type="checkbox" id="ef-newmeta" checked="checked" /> Использовать новую Meta — информацию</label></td>
    </tr>
    <tr>
      <td align="left" valign="top" id="e-cmt"><label><input type="checkbox" id="ef-cmt" checked="checked" /> Разрешить комментарии, к странице</label></td>
    </tr>
    <tr>
      <td align="left" valign="top" id="e-indexpage"><label><input type="checkbox" id="ef-indexpage" /> Вывести на главную</label></td>
    </tr>
    <tr>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top"></td>
    </tr>
    <tr>
      <td align="left" valign="top"></td>
    </tr>
    <tr>
      <td><input type="button" value="Очистить" onclick="clr();" /> <input id="savebtn" type="submit" value="Добавить, новую страницу" onclick="set_newpage();" />
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>

</div><!--EDT-->
<div id="login_log"><?php get_login(); ?></div><!--login_log-->
<div id="error_log"><?php get_error_log(); ?></div><!--error_log-->
</div><!--EDITOR-->
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
