<?php
function get_adm_cssjs()
{

	if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
	{
		echo '<link href="'.ADM_DIR.'/adm-styles/'.ADMSTYLE.'/scripts/adm_includes_ctrl.css" rel="stylesheet" type="text/css" />'."\n";
		echo '<script src="'.ADM_DIR.'/adm-styles/'.ADMSTYLE.'/scripts/main.js" type="text/javascript"></script>'."\n";
		
		
		
		echo '<style type="text/css">
		
		.btn-del {
			width: 21px;
			height: 19px;
			background: red;
			position: absolute;
			cursor:pointer;
			width: 21px;
			height: 19px;
			background: url('.ADM_DIR.'/adm-styles/'.ADMSTYLE.'/img/btndb.png) -4px -3px no-repeat;
		}
		
		.btn-del:hover {
			background: url('.ADM_DIR.'/adm-styles/'.ADMSTYLE.'/img/btndb.png) -4px -25px no-repeat;
		}
		
		.btn-ban {
			width: 21px;
			height: 19px;
			background: red;
			position: absolute;
			cursor:pointer;
			width: 21px;
			height: 19px;
			background: url('.ADM_DIR.'/adm-styles/'.ADMSTYLE.'/img/btndb.png) -29px -3px no-repeat;
		}
		
		.btn-ban:hover {
			background: url('.ADM_DIR.'/adm-styles/'.ADMSTYLE.'/img/btndb.png) -29px -25px no-repeat;
		}
		
		</style>';
		
		
		
		
		echo '	
		<script type="text/javascript">
		
			
			function ban_del_ctrl(arg,arg2)
			{
				if(xmlhttp_bandel_cmt && lck11==1)
				{
					try
					{

						xmlhttp_bandel_cmt.open("GET","'.ADM_DIR.'/set_bandel_cmt.php?id='.$_GET['id'].'&cmt="+arg+"&mtd="+arg2,true);
						xmlhttp_bandel_cmt.onreadystatechange = function HRSC()
						{
						
							if(xmlhttp_bandel_cmt.readyState == 4)
							{
								document.getElementById(\'ncmt\'+arg).style.display = "none";
								document.getElementById(\'ctrlb\'+arg).style.display = "none";
								
							
								loading_show(0,11);
								lck11=1;
								if(xmlhttp_bandel_cmt.status != 200)
								{
									alert("ban_del_ctrl::error: 1");
								}
							}
						}
						lck11=0;
						loading_show(1,11);
						xmlhttp_bandel_cmt.send(null);
					}
					catch(e)
					{
						alert("ban_del_ctrl::error: 2\n"+e);
					}
				}
			}

		</script>
		';
	}
}


function get_adm_header()
{
	if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
	{
		echo '

		<div id="adm-header">
			<div id="adm-link-block">
			<ul>
			  <li><a href="'.ADM_DIR.'/index.php?act=editor">Редактор</a></li>
			  <li><a href="'.ADM_DIR.'/index.php?act=settings">Настройки</a></li>
			  <li><a href="'.ADM_DIR.'/index.php?act=logout">Выход</a></li>
			</ul> 
			</div><!--LINK-BLOCK-->
			
		<div id="adm-left-block">Режим управления 
			<img id="loading11" class="loading" src="'.ADM_DIR.'/adm-styles/'.ADMSTYLE.'/img/loading.gif" alt="loading" />
		</div> 
		
		 <div class="clear-r"></div>
		</div><!--ADMHEADER-->
					
		';
	}
}


function zeroing_new_cmt()
{
	if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
	{
		$id 	= $_GET['id'];
		$mid 	= get_ndir($id);
		
		if(file_exists(DB_DIR."/inf$id") && file_exists(DB_DIR."/m$mid"))
		{
			$inf 	= file(DB_DIR."/inf$id");
			$m 		= file(DB_DIR."/m$mid");
			
			if(OPTIONS_CMT == 1 && trim($inf[7]) == 1 && trim($m[3]) == 1)
			{
				$str 	= "$inf[0]$inf[1]$inf[2]$inf[3]$inf[4]$inf[5]$inf[6]$inf[7]0\n$inf[9]";
				$m6 = trim($m[6])-trim($inf[8]);
				$str2 	= "$m[0]$m[1]$m[2]$m[3]$m[4]$m[5]$m6";
				
				file_put_contents(DB_DIR."/m$mid",$str2);
				file_put_contents(DB_DIR."/inf$id",$str);
			}	
		}
	}
}

?>