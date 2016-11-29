<?php

if(file_exists(DB_DIR."/uplinksinfo"))
{
	$countlb=trim(file_get_contents(DB_DIR."/uplinksinfo"));
	for($i=1;$i<=$countlb;$i++)
	{
		if (file_exists(DB_DIR."/uplinks$i"))
		{
			$lt = file(DB_DIR."/uplinks$i");	
			echo '<div class="upm"><a href="'.trim($lt[1]).'">'.trim($lt[0]).'</a></div>';
		}
	}
}
?>