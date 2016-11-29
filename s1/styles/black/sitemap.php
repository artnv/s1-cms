<?php 
if(empty($lc)) $lc = false;	
if($lc == true)
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php get_meta(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if lte IE 8]>
<link href="styles/<?php echo STYLE;?>/scripts/ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="icon" href="styles/<?php echo STYLE;?>/img/favicon.ico" type="image/x-icon" />
<link href="styles/<?php echo STYLE;?>/scripts/main.css" rel="stylesheet" type="text/css" />
<link href="styles/<?php echo STYLE;?>/scripts/sitemap.css" rel="stylesheet" type="text/css" />
<?php get_adm_cssjs();?>
</head>
<body>
<?php get_adm_header(); ?>
<div id="main">


<div id="header">
	<div id="logo"><a href="index.php"><?php echo SITENAME;?></a></div>
	
	<div id="upmenu">
	<?php require "includes/get_links_block.php";?>
	</div><!--upmenu-->
	
<div class="clear-r"></div>
</div><!--header-->



<div id="content">

<div id="left">
	<div id="menu">
	<?php require "includes/get_menu.php";?>
	</div>
</div><!--left-->

<div id="center">



<div id="page">

<div id="sitemap">
<?php get_contents();?>
</div><!--sitemap-->

</div><!--page-->


</div><!--center-->
<div class="clear-l"></div>
</div><!--content-->
</div><!--main-->
</body>
</html>
<?php } ?>