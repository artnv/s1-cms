<?php
function get_ndir($id)
{
	if(file_exists("../".DB_DIR."/menuinfo"))
	{
		$cnt = trim(file_get_contents("../".DB_DIR."/menuinfo"));
		
		for($i=1;$i<=$cnt;$i++)
		{
			if(file_exists("../".DB_DIR."/m$i"))
			{
				$tmpdir = file("../".DB_DIR."/m$i");
	
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
}
function get_inform()
{
	//add_error('тест функйии add_error');
	if(!is_dir("../".DB_DIR)) echo "<span style=\"color:red;\">Директория: &nbsp; \"".DB_DIR."\" &nbsp; не найдена!</span> ";
	else
	{
		if(!is_writable("../".DB_DIR."/indexinfo") or !is_writable("../".DB_DIR."/uplinksinfo") or !is_writable("../".DB_DIR."/menuinfo")) echo "'Установите права доступа: \"755\" или \"644\" на директорию: \"".DB_DIR."\"'";
	}
}
function no_cache()
{
	header('Expires: Wed, 20 Dec 1980 00:30:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-control: no-cache, must-revalidate ');
	header('Pragma: no-cache');
}
function add_sessn_to_js()
{
	echo session_name(SESSION_NAME)."=". session_id();
}


//////editor
function get_login()
{
	if(file_exists("../".DB_DIR."/accesslog"))
	{
		$login_file	=	file("../".DB_DIR."/accesslog");
		$cnt		=	count($login_file);
		
		if($cnt >= 300)
		{
			$lf = fopen("../".DB_DIR."/accesslog", "w");
			for($i=149;$i<=300;$i++)
			{		
				fputs($lf,$login_file[$i]);	
			}
			fclose($lf);
		}
		
		echo '<div id="login_list">';
		if($cnt >= 2)
		{
			$exp	=	explode("-",$login_file[$cnt-2]);
			$exp1	=	explode("-",$login_file[$cnt-1]);
			
			//////////////////
			for($i=0;$cnt>=$i;$cnt--)
			{
				$exp	=	explode("-",$login_file[$cnt]);
				$exp1	=	explode("-",$login_file[$cnt+1]);
				
				if($exp[0] != $exp1[0])
				{
					if(date('j.m.Y') == trim($exp[0])) echo '<div class="ll_date">'.get_date_time(trim($exp[0])).' <span style="color:red;">(Сегодня)</span></div>';
					else echo '<div class="ll_date">'.get_date_time(trim($exp[0])).'</div>';
				}
		
				if(strlen(trim($exp[1])) > 1) echo '<div class="ll_info"><span class="ll_dip">'.trim($exp[1]).'</span><span class="ll_ip">'.trim($exp[2]).'</span><span class="ll_ua">'.trim($exp[3]).'</span></div>';

			}
		
		}
		echo '</div>';
	}
}

function add_error($arg)
{
	if(file_exists("../".DB_DIR."/errorlog"))
	{
		$str	=	date('j.m.Y').' - '.gmdate("H:i",time()+((TIME_ZONE)*3600)).' - '.$arg."\n";
		$login_file = fopen("../".DB_DIR."/errorlog", "a");
		fputs($login_file,$str);
		fclose($login_file);
	}
}

function get_error_log()
{
	if(file_exists("../".DB_DIR."/errorlog"))
	{

		$login_file	=	file("../".DB_DIR."/errorlog");
		$cnt		=	count($login_file);
		
		if($cnt >= 300)
		{
			$lf = fopen("../".DB_DIR."/errorlog", "w");
			for($i=149;$i<=300;$i++)
			{		
				fputs($lf,$login_file[$i]);	
			}
			fclose($lf);
		}
		
		echo '<div id="error_list">';
		if($cnt >= 2)
		{
			$exp	=	explode("-",$login_file[$cnt-2]);
			$exp1	=	explode("-",$login_file[$cnt-1]);
			
			//////////////////

			for($i=0;$cnt>=$i;$cnt--)
			{
				$exp	=	explode("-",$login_file[$cnt]);
				$exp1	=	explode("-",$login_file[$cnt+1]);
				
				if($exp[0] != $exp1[0])
				{
					if(date('j.m.Y') == trim($exp[0])) echo '<div class="ll_date">'.get_date_time(trim($exp[0])).' <span style="color:red;">(Сегодня)</span></div>';
					else echo '<div class="ll_date">'.get_date_time(trim($exp[0])).'</div>';
				}
		
				if(strlen(trim($exp[1])) > 1) echo '<div class="ll_info"><span class="ll_dip">'.trim($exp[1]).'</span><span class="ll_ip">'.trim($exp[2]).'</span></div>';

			}

		}
		echo '</div>';
	}
}

/////settings
function add_checked($arg)
{
	if($arg == 1) echo ' checked="checked" ';
}
function get_style()
{
	$dir = scandir("../styles");
	$s = "";
	
	for($i=2;$i<count($dir);$i++)
	{
		if(is_dir("../styles/".$dir[$i]))
		{
			if(STYLE == $dir[$i]) $s = ' selected="selected" '; else $s = "";
			echo '<option '.$s.'>'.$dir[$i].'</option>';
		}
		else continue;
	}
}
function def_tz()
{
	$s = "";
	if($i>=0) $s = "+";
	echo "[".gmdate("H:i:s",time()+((TIME_ZONE)*3600))."] [UTC$s".TIME_ZONE."]";
}
function tz()
{
	$s = "";
	$s2 = "";
	for($i=-12;$i<=14;$i++)
	{
		if($i>=0) $s = "+";
		if($i == TIME_ZONE) $s2 = ' selected="selected" '; else $s2 = "";
		echo "<option value=\"$i\" $s2 > [".gmdate("H:i:s",time()+(($i)*3600))."] [UTC$s$i]</option>";
	}
}
function get_limit_dir()
{
	if(file_exists("../".DB_DIR."/countdir"))
	{
		$cd = file("../".DB_DIR."/countdir");
		
		
		if(trim($cd[1]) > 0)
		{
			echo '<div class="stg-h">Чтобы выбрать лимит, необходимо удалить все каталоги!</div>
			<select class="so" name="limit_dir" disabled="disabled">';
		}
		else
		{
			echo '<div class="stg-h"></div>
			<select class="so" name="limit_dir">';
		}
		
		$ch = array(" ", " ", " ", " ", " ", " ");
		$ch[trim(LIMIT_DIR)-1] = 'selected="selected"';
		
			echo'<option value="1" '.$ch[0].'>*00 - *99 (до 99)</option>
			<option value="2" '.$ch[1].'>*000 - *999 (до 999)</option>
			<option value="3" '.$ch[2].'>*0000 - *9999 (до 9,999)</option>
			<option value="4" '.$ch[3].'>*00000 - *99999 (до 99,999)</option>
			<option value="5" '.$ch[4].'>*000000 - *999999 (до 999,999)</option>
			<option value="6" '.$ch[5].'>*0000000 - *9999999 (до 9,999,999)</option>
			</select>';
	}
}
function get_bl()
{
	if(file_exists("../".DB_DIR."/banlist"))
	{
		$bl = file("../".DB_DIR."/banlist");
		echo '<option selected="selected" value="none"></option>';
		for($i=0;$i<count($bl);$i++)
		{
			echo '<option value="'.$i.'">'.trim($bl[$i]).'</option>';
		}
	}
}
function get_date_time($arg)
{
	$arg2 	= explode(".",trim($arg));
	$dt 	= "";
	
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
function get_hic()
{
	$s	=	array("","","");
	switch(HIDE_IP_CMT)
	{
		case "1":
			$s[0] = 'selected="selected"';
		break;
		case "2":
			$s[1] = 'selected="selected"';
		break;
		case "3":
			$s[2] = 'selected="selected"';
		break;
	}
	echo '<option value="1" '.$s[0].' >Скрыть</option><option value="2" '.$s[1].' >Скрыть частично</option><option value="3" '.$s[2].' >Не скрывать</option>';
}
?>
