<?php

function get_link()
{

	$mtd	=	$_GET['id'];
	if(OPTIONS_LST == 1) $mtd = "list";
	if(is_numeric($_GET['dir'])) 	$dir 	= $_GET['dir'];  	else $dir	=	0;
	if(is_numeric($_GET['page'])) 	$page 	= $_GET['page']/10; else $page 	=	0;
	
	
	/////////////////////////////////////////////////////////////////////
	
	if(file_exists(DB_DIR."/m$dir") && ($mtd == 'preview') && is_int($page))
	{
		$m_file 	=	file(DB_DIR."/m$dir");
		$m5 		=	trim($m_file[5]);
		
		if(trim($m_file[0]) == "dir" && $m5 > 0 && ($page*10) < $m5 && $page >= 0)
		{
			
			
			$all_links	=	$m5/10;
			
			$expm		=	explode(".",$all_links);
			$all_links	=	$expm[0];
			if(isset($expm[1]))  $all_links++;	///сколько линков выводить
			
			
			
			////////////////////////
			echo '<div id="footer_links_h"><span class="footer_links_b">Страницы</span>';
				if(($page-1) >= 0) echo '<a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.(($page-1)*10).'">&larr; Назад</a>';
				else echo '<span style="margin-right: 10px;">&larr; Назад</span>';
				
				if(($page+1) < $all_links) echo '<a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.(($page+1)*10).'">Вперед &rarr;</a>';
				else echo '<span>Вперед &rarr;</span>';
			echo '</div>';
			echo '<div id="footer_links_m">';
			
			
			/////////////////////
			if($page < $all_links)
			{
				if(OPTIONS_CPT_LINKS == 0)
				{
					if($mtd == "preview" && trim($m_file[0]) == "dir")
					{
						$e=0;
						for($i=0;$i<$all_links;$i++)
						{
							$e++;
							if($page == $i) echo ' <a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($i*10).'" class="footer_link_selected">'.$e.'</a> ';
							else echo ' <a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($i*10).'">'.$e.'</a> ';
						}
					}
				}
				else
				{
				
					$a=0; $b=1; $c=0;
					if($page < 5)
					{
					
						while(1)
						{
							if($a < 9 && $a < $all_links) 
							{
								if($page == $a) echo ' <a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($a*10).'" class="footer_link_selected">'.$b.'</a> ';
								else echo ' <a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($a*10).'">'.$b.'</a> ';
							} else break;
							$a++;
							$b++;
						}
					
						if($all_links > 9) echo '<span class="pnts">...</span> <a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.(($all_links*10)-10).'">'.$all_links.'</a>';
					}
					else
					{
						echo ' <a href="index.php?id=preview&amp;dir='.$dir.'&amp;page=0">1</a><span class="pnts">...</span>';
						
						$b=$page-4;
						$a=$page-4;
						for(;$a<$page;$a++)
						{
							$b++;
							echo '<a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($a*10).'">'.$b.'</a>';
							
						}
					
						$b++;
						echo '<a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($page*10).'" class="footer_link_selected">'.$b.'</a>';
					
					
						while(1)
						{
							$b++;
							$a++;
							if($c < 4 && $b <= $all_links) 
							{
								if($page == $a) echo '<a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($a*10).'" class="footer_link_selected">'.$b.'</a>';
								else echo '<a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.($a*10).'">'.$b.'</a>';
							} else break;
							$c++;
							
						}

						if($page <= ($all_links-6)) echo '<span class="pnts">...</span><a href="index.php?id=preview&amp;dir='.$dir.'&amp;page='.(($all_links*10)-10).'">'.$all_links.'</a>';
					}
				}
			}
			echo '</div>';
		}
	}
}
	
/////////////////////////////////////////////////
	
function get_contents()
{

	if(is_numeric($_GET['dir'])) 	$dir 	= $_GET['dir'];  else $dir	=	0;	
	if(is_numeric($_GET['page'])) 	$page 	= $_GET['page']; else $page =	0;
	$id = $_GET['id'];
	if(OPTIONS_LST == 1) $id = "list";

	if(file_exists(DB_DIR."/m$dir") && is_file(DB_DIR."/m$dir") && is_int($page/10))
	{
		$m_file 		= 	file(DB_DIR."/m$dir");
		$m_limit_arr  	=   explode('-',trim($m_file[1]));
		$end			=	trim($m_file[4])+trim($m_limit_arr[0]);
		$real_end		=	trim($m_file[5]);
		$start			=	trim($m_limit_arr[0]);
		
		if(trim($m_file[0]) == "dir")
		{
		
			switch($id)
			{
			case "preview":
			
			$exit_cnt=0;
			$exit_cnt2=0;
			$exit_end=10;
			

				if($real_end > 0 && $page < $real_end && $page >= 0)
				{
					echo '<div id="pnt"><span>Предварительный просмотр</span> | <a href="index.php?id=list&amp;dir='.$dir.'">Одним списком</a></div>';
					
					while(1)
					{
				
						if($exit_cnt < $page && $end > $start)
						{
							
							if(file_exists(DB_DIR."/inf$end") && file_exists(DB_DIR."/p$end"))
							{
								$exit_cnt++;
							} 
							$end--;
							
						}
						else
						{	
							
							if($exit_cnt2 < $exit_end && $end > $start)
							{
								if(file_exists(DB_DIR."/inf$end") && is_file(DB_DIR."/p$end"))
								{
									$exit_cnt2++;
									
									///вывод
									
									
									$inf_file = file(DB_DIR."/inf$end");
									if(strlen(trim($inf_file[5])) < 1) $inf_file[5] = $end;								
									$txt_file = fopen(DB_DIR."/p$end","r"); 
										echo '<div class="preview"><h1><a href="index.php?id='.$end.'" class="cmed_tool">'.$inf_file[5].'</a></h1>';
										echo nl2br(fread($txt_file,300)).' ...';
										
										if(OPTIONS_PINFO == 1)	
										{	
											echo '<div class="preview_info">';
											echo '<span class="preview_date">'.get_date_time($inf_file[4]).'</span> | <span class="preview_cnt_cmt">'.trim($inf_file[9]).' коммент.</span> | <span class="preview_autor">'.NAME.'</span>';
											echo '</div>';
										}
										
										echo '</div><!--preview-->';
									fclose($txt_file);
									
									
								} 
								
							} else break;
							$end--;
						}
					}
					
				}	
					
		
			break;
					
					//////////////////////////////
					
			case "list":
					
					
					if(OPTIONS_LST != 1) echo '<div id="pnt"><a href="index.php?id=preview&amp;dir='.$dir.'&amp;page=0">Предварительный просмотр</a> | <span>Одним списком</span></div>';
					
					echo '<div id="preview">';
					echo '<ul class="preview_ul">';
					
					$a = trim($m_file[4]) + trim($m_limit_arr[0]);
					$e = trim($m_file[5]);
					
					for(;$a>=$m_limit_arr[0];$a--)
					{
					
						if(file_exists(DB_DIR."/p$a") && file_exists(DB_DIR."/inf$a"))
						{
							$inf = file(DB_DIR."/inf$a");
							if(strlen(trim($inf[5])) < 2) $inf[5] = $a;
							echo '<li class="preview_ul_li">'.$e.'. <a href="index.php?id='.$a.'">'.trim($inf[5]).'</a></li>';
							$e--;
						} else continue;
					}
					
					echo '</ul>';
					echo '</div>';
			break;
			}
		} else if(file_exists(DB_DIR."/error404")) echo file_get_contents(DB_DIR."/error404");
	} else if(file_exists(DB_DIR."/error404")) echo file_get_contents(DB_DIR."/error404");
}

function get_title_dir()
{
	if(is_numeric($_GET['dir'])) 	$dir 	= $_GET['dir'];  else $dir	=	null;
	if(file_exists(DB_DIR."/m$dir") && is_file(DB_DIR."/m$dir"))
	{
		$m_file	=	file(DB_DIR."/m$dir");
		if(trim($m_file[0]) == "dir") echo trim($m_file[2]);
	}
}
?>