<?php

function get_link()
{
	if(is_numeric($_GET['page'])) 	$page 	= $_GET['page']/10; else $page 	=	0;
	
	if(file_exists(DB_DIR."/indexinfo") && is_int($page))
	{
		$indexinfo 	=	trim(file_get_contents(DB_DIR."/indexinfo"));
		if($indexinfo > 0 && ($page*10) < $indexinfo && $page >= 0)
		{
		
			$all_links	=	$indexinfo/10;
			$expm		=	explode(".",$all_links);
			$all_links	=	$expm[0];
			if(isset($expm[1]))  $all_links++;	///сколько линков выводить
			
			
			
			////////////////////////
			echo '<div id="footer_links_h"><span class="footer_links_b">Страницы</span>';
				if(($page-1) >= 0) echo '<a href="index.php?page='.(($page-1)*10).'">&larr; Назад</a>';
				else echo '<span style="margin-right: 10px;">&larr; Назад</span>';
				
				if(($page+1) < $all_links) echo '<a href="index.php?page='.(($page+1)*10).'">Вперед &rarr;</a>';
				else echo '<span>Вперед &rarr;</span>';
			echo '</div>';
			echo '<div id="footer_links_m">';
			
			
			/////////////////////
			if($page < $all_links)
			{
				if(OPTIONS_CPT_LINKS == 0)
				{

					$e=0;
					for($i=0;$i<$all_links;$i++)
					{
						$e++;
						if($page == $i) echo ' <a href="index.php?page='.($i*10).'" class="footer_link_selected">'.$e.'</a> ';
						else echo ' <a href="index.php?page='.($i*10).'">'.$e.'</a> ';
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
								if($page == $a) echo ' <a href="index.php?page='.($a*10).'" class="footer_link_selected">'.$b.'</a> ';
								else echo ' <a href="index.php?page='.($a*10).'">'.$b.'</a> ';
							} else break;
							$a++;
							$b++;
						}
					
						if($all_links > 9) echo '<span class="pnts">...</span> <a href="index.php?page='.(($all_links*10)-10).'">'.$all_links.'</a>';
					}
					else
					{
						echo ' <a href="index.php?page=0">1</a><span class="pnts">...</span>';
						
						$b=$page-4;
						$a=$page-4;
						for(;$a<$page;$a++)
						{
							$b++;
							echo '<a href="index.php?page='.($a*10).'">'.$b.'</a>';
							
						}
					
						$b++;
						echo '<a href="index.php?page='.($page*10).'" class="footer_link_selected">'.$b.'</a>';
					
					
						while(1)
						{
							$b++;
							$a++;
							if($c < 4 && $b <= $all_links) 
							{
								if($page == $a) echo '<a href="index.php?id=page='.($a*10).'" class="footer_link_selected">'.$b.'</a>';
								else echo '<a href="index.php?page='.($a*10).'">'.$b.'</a>';
							} else break;
							$c++;
							
						}

						if($page <= ($all_links-6)) echo '<span class="pnts">...</span><a href="index.php?page='.(($all_links*10)-10).'">'.$all_links.'</a>';
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
	if(!empty($_GET['page'])) 	$page = $_GET['page']; else $page = 0;

	if(file_exists(DB_DIR."/indexinfo") && is_int($page/10))
	{
		$indexinfo = trim(file_get_contents(DB_DIR."/indexinfo"));
		if($indexinfo <= 0 or ($page/10) > $indexinfo) return;

		
		$f = $indexinfo - $page;
		$s = ($indexinfo - ($page + 10));
		
		for(;$f>$s;$f--)
		{
			if(file_exists(DB_DIR."/index$f"))
			{
				$id = trim(file_get_contents(DB_DIR."/index$f"));
				if(file_exists(DB_DIR."/p$id") && file_exists(DB_DIR."/inf$id"))
				{	
					$info = file(DB_DIR."/inf$id");
				
					$fileb = fopen(DB_DIR."/p$id","r"); 
					$str = fread($fileb,300);
					
					if(strlen(trim($info[5])) < 2) $info[5] = $id;
						
					echo '<div class="preview"><h1><a href="index.php?id='.$id.'" class="cmed_tool">'.trim($info[5]).'</a></h1>';	
						
					echo nl2br($str);
					echo "...";
			
					if(OPTIONS_PINFO == 1)	
					{	
						echo '<div class="preview_info"><span class="preview_date">'.get_date_time($info[4]).'</span> | <span class="preview_cnt_cmt">'.trim($info[9]).' коммент.</span> | <span class="preview_autor">'.NAME.'</span></div>';
					}
					echo '</div><!--preview-->';
				
					fclose($fileb);
				
				} else continue;
			} else continue;
		}
	}
}
?>