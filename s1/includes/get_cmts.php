<?php
$id=$_GET['id'];
if(file_exists(DB_DIR."/menuinfo"))
{
$f1 = trim(file_get_contents(DB_DIR."/menuinfo"));
//определение каталога по индексу
for($i=1;$i<=$f1;$i++)
{
	if(file_exists(DB_DIR."/m$i"))
	{
		$tmpdir = file(DB_DIR."/m$i");
	
		if(trim($tmpdir[0]) == 'dir' || trim($tmpdir[0]) == 'main_dir')
		{
			$direxp = explode('-',$tmpdir[1]);
			if($id >= $direxp[0] && $id <= $direxp[1])
			{
				$dircmt = trim($tmpdir[3]);
				break;
			} else continue;
			
		} else continue;
		
	} else continue;
}
//////////////////////////////////////

if(file_exists(DB_DIR."/inf$id"))
{
	$f2 = file(DB_DIR."/inf$id");
}

if(OPTIONS_CMT==1 && $dircmt==1 && trim($f2[7]==1) && isset($_GET['id']))
{
	$admname = 'Гость';
	if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
	{
		$admname = NAME;
	}

?>

<div id="cmt-editor">
<div id="cmed_top">
<div id="cmed_button" class="cmed_button_2" onclick="press_b();"></div> <span class="cmed_header">Добавить комментарий</span>
</div>
<div id="cmed_main">
<form action="addcmt.php" method="post">
<table width="100%" border="0">
<tr>
	<td style="width:14%;">&nbsp;</td>
    <td style="width:72%;">&nbsp;</td>
	<td style="width:14%;">&nbsp;</td>
</tr>
<tr>
	<td align="left" valign="top" class="cmed_stfont">Ваше имя:</td>
	<td align="left" valign="top"><?php echo '<input id="cmed_input" class="cmed_input" type="text" onkeyup="word_count();" maxlength="50" name="name" value="'.$admname.'" />'; ?></td>
	<td align="left" valign="top">&nbsp;</td>
</tr>
<tr>
	<td align="left" valign="top">&nbsp;</td>
	<td align="left" valign="top">
	<div id="cmed_tools">
	<div  class="cmed_tool"	onclick="b();"><span class="cmed_bold">B</span></div>
	<div  class="cmed_tool"	onclick="em();"><span class="cmed_italic">K</span></div>
	<div  class="cmed_tool"	onclick="strike();"><span class="cmed_strike">abc</span></div>
	<div  class="cmed_tool" onclick="quote();">Цитата</div>
	<div  class="cmed_tool" onclick="url();">Ссылка</div>
	<div  id="cmed_count" class="cmed_tool">0/3000</div>
	</div>
	</td>
	<td align="left" valign="top">&nbsp;</td>
</tr>
<tr>
	<td align="left" valign="top" class="cmed_stfont">Сообщение:</td>
	<td align="left" valign="top"><textarea id="cmed_textarea" rows="10" cols="1" class="cmed_textarea" onkeyup="word_count();" name="text"></textarea></td>
	<td align="left" valign="top"></td>
</tr>
<tr>
	<td align="left" valign="top">&nbsp;</td>
	<td align="left" valign="top">

<?php   
	if(!extension_loaded('gd'))
   {
		include "captcha.php";
   }
   else
   {
		echo '<img src="captcha.php" id="cmed_captcha" alt="captcha" onclick="upd_cpt();"/>';
   }

echo '<img src="styles/'.STYLE.'/img/pnt.png" class="cmed_pnt" alt="" />';
?>
	<input id="cmed_cpt_input" type="text" class="cmed_cpt_input" maxlength="10" name="cpt" onkeyup="word_count();" />
	<input type="submit" value="Добавить" disabled="disabled" id="cmed_submit" />
	
	</td>
	<td align="left" valign="top">&nbsp;</td>
	</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>
</form>
</div><!--cmed_main-->
</div><!--cmt-editor-->

<?php

if(isset($id)) 
{
	$countcmt = file(DB_DIR."/inf$id");
	$tmpcmt = 0;
	for($i=1;$i<=$countcmt[6];$i++)
	{
	$e=$i;
		if(file_exists(DB_DIR."/cmt$id-$i") && file_exists(DB_DIR."/inf$id"))
		{
			$tmpfile =  file(DB_DIR."/cmt$id-$i");
			$ipp = explode('.',$tmpfile[0]);
			$classname = '';
			$admb = '';
			
				if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
				{
				
					$admb = '
					<div class="ctrlb" id="ctrlb'.$i.'">
					<div class="btn-del" onclick="ban_del_ctrl('.$i.',\'del\');" title="Удалить этот комментарий"></div>
					<div class="btn-ban" onclick="ban_del_ctrl('.$i.',\'ban\');" title="Удалить этот комментарий и забанить пользователя" style="margin-left:26px;"></div>
					</div>';
					
					if($ipp[0] == "adm")
					{		
						
						$classname = "ncmt_adm";
						$ipp = "$ipp[1].$ipp[2].$ipp[3].$ipp[4]";
					}
					else
					{
						$ipp = "$ipp[0].$ipp[1].$ipp[2].$ipp[3]";
					}
				}
				else
				{
				
					if($ipp[0] == "adm")
					{		
						
						$classname = "ncmt_adm";
						$ipp = null;
					}
					else
					{
						switch(HIDE_IP_CMT)
						{
							case "1":
								$ipp = null;
							break;
							case "2":
								$ipp[0][0] = "*"; $ipp[0][1] = "*"; $ipp[0][2] = "*";
								$ipp = "$ipp[0].$ipp[1].$ipp[2].$ipp[3]";
							break;
							case "3":
								$ipp = "$ipp[0].$ipp[1].$ipp[2].$ipp[3]";
							break;
						}
	
					}
				
				}
			
			$e-=$tmpcmt;
			
		
				
				
				
				
				
			echo '<div class="ncmt" id="ncmt'.$i.'">
				<table width="100%" border="0">
				  <tr>
					<td style="width:10%;" rowspan="3" align="center" valign="middle" class="ncmt_num">'.$e.'</td>
					<td style="width:90%;" align="left" valign="top"><a href="javascript:quote('.$i.');" id="ncmt_name_'.$i.'" class="ncmt_name '.$classname.'">'.$tmpfile[1].'</a></td>
				  </tr>
				  <tr>
					<td align="left" valign="top">'.$admb.'<span class="ncmt_br">'.get_date_time($tmpfile[2]).'</span>';
					if($ipp) echo '<span class="ncmt_br">'.$ipp.'</span>';
					echo '<a href="#ncmt'.$i.'" class="ncmt_permalink">#</a></td>
				  </tr>
				  <tr>
					<td align="left" valign="top" class="ncmt_cmt" id="ncmt_cmt_'.$i.'">';
					
				for($e=3;$e<=count($tmpfile);$e++)
				{
					echo nl2br($tmpfile[$e]);
				}
					
			echo '</td>
				  </tr>
				</table>
				</div><!--ncmt-->';
		
				
		}
		else
			{
				$tmpcmt++;
				continue;	
			}
	}
}

}
}
?>