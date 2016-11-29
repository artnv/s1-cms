<?php

function get_meta()
{
	$id = $_GET['id'];
	if(file_exists(DB_DIR."/inf$id") && file_exists(DB_DIR."/p$id"))
	{
		$opt = file(DB_DIR."/inf$id");
		if(trim($opt[0]) != 0) 
		{
			if(strlen($opt[3]) > 1) 
			{
				echo "<title>".trim($opt[3])."</title>\n";
			} 
			else
			{
				if(strlen($opt[5]) > 1) echo "<title>".trim($opt[5])."</title>\n"; 
				else echo "<title></title>\n";
			}
			
			if(strlen($opt[1]) > 3) echo "<meta name=\"keywords\" content=\"".trim($opt[1])."\" />\n";
			if(strlen($opt[2]) > 3) echo "<meta name=\"description\" content=\"".trim($opt[2])."\" />\n";
		}
		else 
		{
			if(strlen(TITLE) > 1) echo "<title>".trim(TITLE)."</title>\n"; else echo "<title></title>\n";
			if(strlen(KEYWORDS) > 1) echo "<meta name=\"keywords\" content=\"".trim(KEYWORDS)."\" />\n";
			if(strlen(DESCRIPTION) > 1) echo "<meta name=\"description\" content=\"".trim(DESCRIPTION)."\" />\n";
		}
	}
	else
	{
		echo "<title>404</title>\n";
	}

}

function get_contents()
{	
	$id = $_GET['id'];
	if(is_numeric($id) && file_exists(DB_DIR."/p$id") && file_exists(DB_DIR."/inf$id"))
	{
		$f = file(DB_DIR."/inf$id");
		echo '<h1>'.trim($f[5]).'</h1>';
		echo nl2br(file_get_contents(DB_DIR."/p$id"));		
	} 
	else 
	{
		if(file_exists(DB_DIR."/error404")) echo file_get_contents(DB_DIR."/error404");
	}
}
function get_date()
{
	$id = $_GET['id'];
	
	if(is_numeric($id) && file_exists(DB_DIR."/inf$id"))
	{
		$f = file(DB_DIR."/inf$id");
		if(OPTIONS_PINFO == 1)	echo get_date_time($f[4]);
	} 
}
?>