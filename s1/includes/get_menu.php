<?php

if(OPTIONS_LST == 1) $mtdi = 'list'; else $mtdi = 'preview';	
/////////////////////////////////////////////////	


if(file_exists(DB_DIR."/menuinfo"))
{
	$dl= trim(file_get_contents(DB_DIR."/menuinfo"));
	$dir = get_ndir($_GET['id']);
	if($dir == false) $dir = $_GET['dir'];

	if($dl > 0)
	{
		echo '<ul>';
		for($i=1;$i<=$dl;$i++)
		{
			$dc=file(DB_DIR."/m$i");
			$dc[0] = trim($dc[0]);
			
			
			if($dc[0] == "dir")
			{
				if($i == $dir) 
				{
					echo '<li class="l menu_selected"><a href="index.php?id='.$mtdi.'&amp;dir='.$i.'&amp;page=0">'.$dc[2].'</a></li>';
				}
				else
				{
					echo '<li class="l"><a href="index.php?id='.$mtdi.'&amp;dir='.$i.'&amp;page=0">'.$dc[2].'</a></li>';
				}
			}
			else
			{			
				if($dc[0] == "link") echo '<li class="l"><a href="'.trim($dc[2]).'">'.trim($dc[1]).'</a></li>';
				if($dc[0] == "section") echo '<li class="s">'.trim($dc[1]).'</li>';
			}
			
		}
		echo '</ul>';
	}
}

?>