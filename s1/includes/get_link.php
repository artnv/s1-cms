<?php
function get_pn_link($id, $start, $end)	///<- Назад Вперед ->
{
	$a	=	$id-1;
	$b	=	$id+1;
	$start++;
	$l1	=	false;
	$l2	=	false;
	
	echo '<div id="footer_links_h">';
	echo '<span class="footer_links_b">Страницы</span>';
	
	while(1)
	{
		
		if($start <= $a)
		{
			if(file_exists(DB_DIR."/p$a") && file_exists(DB_DIR."/inf$a"))
			{
				$l1	=	true;
				break;
			}
			else 
			{
				$a--;
			}
		} else break;
		
	}
	
	while(1)
	{
		
		
		if($b <= $end)
		{
			if(file_exists(DB_DIR."/p$b") && file_exists(DB_DIR."/inf$b"))
			{
				$l2	=	true;
				break;
			} 
			else
			{
			$b++;
			}
		} else break;
		
	}
	
	if($l1)
	{
		echo '<a href="index.php?id='.$a.'">&larr; Назад</a>';	
	}
	else
	{
		echo '<span style="margin-right: 10px;">&larr; Назад</span>';
	}
	
	
	if($l2)
	{
		echo '<a href="index.php?id='.$b.'">Вперед &rarr;</a>';	
	}
	else
	{
		echo '<span>Вперед &rarr;</span>';
	}
	
	echo '</div>';
}



function nopt_id($start, $id) ///определяем количество страниц до индификатора 1 2 3 4  [5] 6 7 8 9;       4 цифры до ID 
{	
	$i	= 0;
	for(;$start < $id;$start++)
	{
		if(file_exists(DB_DIR."/p$start") && file_exists(DB_DIR."/inf$start"))
		{
			$i++;
		}
	}
	return $i;
}


function get_start_id($start, $id) ///начало отсчета id-4
{
	$i	=	0;
	while(1)
	{
		if($i <= 4 && $id > $start)
		{
			if(file_exists(DB_DIR."/p$id") && file_exists(DB_DIR."/inf$id"))
			{
				$i++;
			}
		} else return $id.'-'.$i;	
		$id--;
	}
}

function get_end_link($start, $end) ///возвращает последний линк
{
	while(1)
	{
		if($end >= $start)
		{
			if(file_exists(DB_DIR."/p$end") && file_exists(DB_DIR."/inf$end"))
			{
				return $end;
			}
			$end--;
		} else break;
	}
}

function get_start_link($start,$end) ///возвращает первый линк
{
	while(1)
	{
		if($start <= $end)
		{
			if(file_exists(DB_DIR."/p$start") && file_exists(DB_DIR."/inf$start"))
			{
				return $start;
			}
			$start++;
		} else break;
	}
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$id = $_GET['id'];
if(file_exists(DB_DIR."/p$id") && file_exists(DB_DIR."/inf$id") && file_exists(DB_DIR."/menuinfo"))
{
	if(OPTIONS_PLINKS == 0)
	{

		$gl_dir 	=	get_ndir($id);
		$tmpl 		=	file(DB_DIR."/m$gl_dir");
		$tmpe 		=	explode('-',trim($tmpl[1]));	
		
		
		$start 		=	$tmpe[0];						///10000
		$end 		=	$tmpe[0] + trim($tmpl[4]);		///10099
		$real_end 	=	$tmpe[0] + trim($tmpl[5]);		///10025
		
		
		if(OPTIONS_CPT_LINKS == 0)
		{
			get_pn_link($id, $start, $end);
			echo '<div id="footer_links_m">';
			
			$e=0;
			for(;$start<=$end;$start++)
			{
				if(file_exists(DB_DIR."/p$start") && file_exists(DB_DIR."/inf$start"))
				{
					$e++;
					if($start == $id) echo ' <a href="index.php?id='.$start.'" class="footer_link_selected">'.$e.'</a> ';
					else echo ' <a href="index.php?id='.$start.'">'.$e.'</a> ';
				}
			}
			
			echo '</div>';
		}
		else
		{
			$gsi		=	explode('-',get_start_id($start, $id));		///индификатор 		10000
			$cid		=	$gsi[0];
			$link_num	=	nopt_id($start, $id)-($gsi[1]-1);			///определяем количество страниц до индификатора 1 2 3 4  [5] 6 7 8 9;       4 цифры до ID 
			$link_num2	=	$link_num+($gsi[1]);
			
			$limit		=	9;
			$counter	=	1;
			

			////////////////////////////////////////////////////////////////////////////////
			get_pn_link($id, $start, $end);
			echo '<div id="footer_links_m">';
			
			if($link_num2 >= 6)
			{
				echo '<a href="index.php?id='.get_start_link($start, $end).'">1</a>';
				echo '<span class="pnts">...</span>';
			}
			
			while(1)
			{
				if($counter <= $limit && $cid <= $end && $cid >= $start)
				{
					$cid++;
					if(file_exists(DB_DIR."/p$cid") && file_exists(DB_DIR."/inf$cid"))
					{	
						$counter++;
						$link_num++;
						if($id == $cid) echo '<a href="index.php?id='.$cid.'" class="footer_link_selected">'.$link_num.'</a>';
						else echo '<a href="index.php?id='.$cid.'">'.$link_num.'</a>';					
					}		
				} else break;
			}
			
			
			if((($real_end-$start)-4) > $link_num2 && ($real_end-$start) > 9)
			{
				echo '<span class="pnts">...</span>';
				echo '<a href="index.php?id='.get_end_link($start, $end).'">'.($real_end-$start).'</a>';
			}
			
			echo '</div>';
		}
	}
}
?>