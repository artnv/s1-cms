<?php
function get_meta()
{
	if($_GET['id'] == "sitemap") echo "<title>Карта Сайта | Site map</title>\n"; 
	else echo "<title>".SITENAME."</title>\n";
}

function get_contents()
{
	if(file_exists(DB_DIR."/menuinfo"))
	{
	
		$smid	=	$_GET['id'];
		if($_GET['id'] == "sitemap") echo '<h2>Карта сайта</h2>';
		if(OPTIONS_INDEX_SITEMAP == 1 && $smid != 'xmlsitemap') $smid = 'sitemap';

		switch($smid)
		{
		case 'sitemap':
			if(OPTIONS_SITEMAP == 1)
			{
				$menu_info	=	trim(file_get_contents(DB_DIR."/menuinfo"));
				
		
				
				
				echo '<table width="100%" border="0">';
				for($i=1;$i<=$menu_info;$i++)
				{
					echo '<tr>';
					
					
					echo '<td align="left" valign="top" style="width:50%;">';
					while(1)
					{
						if($i<=$menu_info)
						{
							if(file_exists(DB_DIR."/m$i"))
							{
								$menu_file	=	file(DB_DIR."/m$i");		
								if(trim($menu_file[0]) == 'dir' || trim($menu_file[0]) == 'main_dir')
								{
									$limit	=	explode("-",trim($menu_file[1]));
									$start	= 	$limit[0];
									$end	=	$limit[0]+trim($menu_file[4]);
									$count	=	0;
									
									if(trim($menu_file[5]) > 0)
									{
									
										if(trim($menu_file[0]) != "main_dir")
										{
											if(OPTIONS_LST == 0) echo '<div class="sitemap_dir"><a href="index.php?id=preview&amp;dir='.$i.'&amp;page=0">'.trim($menu_file[2]).'</a></div>'; else echo '<div class="sitemap_dir"><a href="index.php?id=list&amp;dir='.$i.'&amp;page=0">'.trim($menu_file[2]).'</a></div>';
										} else echo '<div class="sm_main_dir">'.trim($menu_file[2]).'</div>';
										
										echo '<table width="100%" border="0" class="sitemap_table_dir">';
										for(;$start<=$end;$start++)
										{
											if(file_exists(DB_DIR."/p$start") && file_exists(DB_DIR."/inf$start"))
											{
												
												$count++;									
												$inf_file	=	file(DB_DIR."/inf$start");
												if(strlen(trim($inf_file[5])) < 1)
												{
													$inf_file[5] = $inf_file[3];
													if(strlen(trim($inf_file[3])) < 1)
													{
														$inf_file[5] = $start;
													}
												}
												echo '<tr>';
												echo '<td align="left" valign="top" style="width: 1%;">'.$count.'. </td>';
												echo '<td align="left" valign="top" style="width: 99%;"><a href="index.php?id='.$start.'">'.trim($inf_file[5]).'</a></td>';
												echo '</tr>';
											}
										
										
										}
										echo '</table>';
									}
									break;
								}
								else 
								{
									$i++;
								}
							} else break;
						} else break;
					}
					echo '</td>';
					
					
					
					$i++;
					
					
					
					echo '<td align="left" valign="top" style="width:50%;">';
					while(1)
					{
						if($i<=$menu_info)
						{
							if(file_exists(DB_DIR."/m$i"))
							{
								$menu_file	=	file(DB_DIR."/m$i");		
								if(trim($menu_file[0]) == 'dir' || trim($menu_file[0]) == 'main_dir')
								{
									$limit	=	explode("-",trim($menu_file[1]));
									$start	= 	$limit[0];
									$end	=	$limit[0]+trim($menu_file[4]);
									$count	=	0;
									
									if(trim($menu_file[5]) > 0)
									{
										if(trim($menu_file[0]) != "main_dir")
										{
											if(OPTIONS_LST == 0) echo '<div class="sitemap_dir"><a href="index.php?id=preview&amp;dir='.$i.'&amp;page=0">'.trim($menu_file[2]).'</a></div>'; else echo '<div class="sitemap_dir"><a href="index.php?id=list&amp;dir='.$i.'&amp;page=0">'.trim($menu_file[2]).'</a></div>';
										} else echo '<div class="sm_main_dir">'.trim($menu_file[2]).'</div>';
										
										echo '<table width="100%" border="0" class="sitemap_table_dir">';
										for(;$start<=$end;$start++)
										{
											if(file_exists(DB_DIR."/p$start") && file_exists(DB_DIR."/inf$start"))
											{
												
												$count++;									
												$inf_file	=	file(DB_DIR."/inf$start");
												if(strlen(trim($inf_file[5])) < 1)
												{
													$inf_file[5] = $inf_file[3];
													if(strlen(trim($inf_file[3])) < 1)
													{
														$inf_file[5] = $start;
													}
												}
												echo '<tr>';
												echo '<td align="left" valign="top" style="width: 1%;">'.$count.'. </td>';
												echo '<td align="left" valign="top" style="width: 99%;"><a href="index.php?id='.$start.'">'.trim($inf_file[5]).'</a></td>';
												echo '</tr>';
											}
										
										}
										echo '</table>';
									}
									break;
								}
								else 
								{
									$i++;
								}
							} else break;
						} else break;
					}
					echo '</td>';
					
					
					
					echo '</tr>';	
				}
				echo '</table>';
				
	
			}
		break;
		case 'xmlsitemap':
			if(OPTIONS_XML_SITEMAP == 1)
			{
				$a = trim(file_get_contents(DB_DIR."/menuinfo"));
				echo '<?xml version="1.0" encoding="UTF-8"?>';
				echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
					for($i=1;$i<=$a;$i++)
					{
						$d = file(DB_DIR."/m$i");	
						if(trim($d[0]) == "dir" || trim($d[0]) == "main_dir")
						{
							
							$tmps 	= explode("-",trim($d[1]));
							$et1 	= $tmps[0];
							$et2 	= $tmps[0]+trim($d[4]);
							
							for(;$et1<=$et2;$et1++)
							{
								if(file_exists(DB_DIR."/inf$et1") && file_exists(DB_DIR."/p$et1"))
								{
									echo '<url>';
									echo '<loc>http://'.SITELINK.'/index.php?id='.$et1.'</loc>';
									echo '</url>';
								} else continue;
							}
						
						} else continue;
					}	
				echo '</urlset>';
			}
		break;
		}
	}
}
?>