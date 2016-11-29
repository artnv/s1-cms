<?php
error_reporting(E_ALL ^ E_NOTICE);

require "includes/config.php";
require "includes/functions.php";

session_name(SESSION_NAME);
session_start();

$ip		=	$_SESSION['ip'];
$id		=	$_SESSION['id'];
$dir 	=	get_ndir($id);


//////////////////////////

if(check_ban())
{
	if(strlen($_POST['cpt']) < 11 && $ip == $_SERVER['REMOTE_ADDR'] && $_SESSION['cpt'] == strtolower($_POST['cpt']) && strlen($_POST['name']) < 21 && strlen($_POST['text']) < 3001 && is_numeric($id))
	{
		$name 	= strip_tags($_POST['name']);
		$name 	= htmlspecialchars($_POST['name']);
		$text 	= strip_tags($_POST['text']);
		$text 	= htmlspecialchars($_POST['text']);

		if(file_exists(DB_DIR."/inf$id") && file_exists(DB_DIR."/p$id"))
		{
			$f1 = file(DB_DIR."/m$dir");
			$inf = file(DB_DIR."/inf$id");
			
			if(OPTIONS_CMT==1 && trim($f1[3])==1 && trim($inf[7])==1 )
			{
				$idcmt = trim($inf[6]);
				$idcmt++;

				$d = date('j.m.Y');
				$t = gmdate("H:i",time()+((TIME_ZONE)*3600));
					
				$text = preg_replace("#\[quote\](.+)\[\/quote\]#isU",'<span class="bb_cmt_quote">\\1</span>',$text);	
				$text = preg_replace("#\[b\](.+)\[\/b\]#isU",'<span class="bb_cmt_b">\\1</span>',$text);	
				$text = preg_replace("#\[em\](.+)\[\/em\]#isU",'<span class="bb_cmt_em">\\1</span>',$text);		
				$text = preg_replace("#\[s\](.+)\[\/s\]#isU",'<span class="bb_cmt_s">\\1</span>',$text);
				
				if(OPTIONS_NOFOLLOW == 1)	
				{
					$text = preg_replace("#\[url[\s]*=[\s]*([\S]+)[\s]*\][\s]*([^\[]*)\[/url\]#isU",'<a href="\\1" rel="nofollow" class="bb_cmt_url">\\2</a>',$text);
				}
				else
				{
					$text = preg_replace("#\[url[\s]*=[\s]*([\S]+)[\s]*\][\s]*([^\[]*)\[/url\]#isU",'<a href="\\1" class="bb_cmt_url">\\2</a>',$text);
				}
				
				if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) 
				{
					$text = "adm.$ip\n$name\n$d.$t\n$text";
					file_put_contents(DB_DIR."/cmt$id-$idcmt",$text);
				}
				else
				{
					$text = "$ip\n$name\n$d.$t\n$text";
					file_put_contents(DB_DIR."/cmt$id-$idcmt",$text);
				}
				
				//////////////
				$inf8 = trim($inf[8])+1;
				$inf9 = trim($inf[9])+1;
				$inf2 = "$inf[0]$inf[1]$inf[2]$inf[3]$inf[4]$inf[5]$idcmt\n$inf[7]$inf8\n$inf9";
				file_put_contents(DB_DIR."/inf$id",$inf2);
				
				//////////////
				$m1_str = trim($f1[0])."\n".trim($f1[1])."\n".trim($f1[2])."\n".trim($f1[3])."\n".trim($f1[4])."\n".trim($f1[5])."\n".(trim($f1[6])+1);
				file_put_contents(DB_DIR."/m$dir",$m1_str);
				
				/////
				$_SESSION['cpt'] = mt_rand(1,1000);
				header("Location: index.php?id=$id#cmt$idcmt");
				
				
			} else echo '<html><head><meta http-equiv="refresh" content="2; url=index.php?id='.$id.'"></head><body>comments disabled</body></html>';
			
		} else echo "<h1>Error</h1>";
	} else echo '<html><head><meta http-equiv="refresh" content="2; url=index.php?id='.$id.'"></head><body>Fail</body></html>';
} else echo '<html><head><meta http-equiv="refresh" content="2; url=index.php?id='.$id.'"></head><body>You are banned</body></html>';

$_SESSION['cpt'] = mt_rand(1,1000);
?>