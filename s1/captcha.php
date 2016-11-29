<?php
require "includes/config.php";
session_name(SESSION_NAME);
session_start();



if(empty($_SESSION['lcs'])) $_SESSION['lcs'] = false;	
if($_SESSION['lcs'] == true)

{
	if(!extension_loaded('gd'))
	{
		
		$a = mt_rand(50,100);
		$b = mt_rand(1,40);
		$c = mt_rand(1,2);
		$d = "+";
		
		switch($c)
		{
		case 1:
			$e = $a - $b;
			$d = "-";
		break;
		case 2:
			$e = $a + $b;
			$d = "+";
		break;
		}
		
		$_SESSION['cpt']= $e;	
		echo '<div id="cmed_captcha">'.$a.$d.$b.'</div>';

	} 
	else {
	$width  = 80;
	$height = 20;
	$sign   = mt_rand(3,4);
	$code   = "";
	$letters = array (
	'a','b','c','d','e','f','g','h',
	'j','k','m','n','p','q','r','s',
	't','u','v','w','x','y','z','2',
	'3','4','5','6','7','8','9');
	$figures = array ('0','0','0','0','0','0','0','0','0');
	$img = imagecreatetruecolor($width,$height);
	$fon = imagecolorallocate($img,255,255,255);
	imagefill($img, 0, 0, $fon);

	for ($j=0;$j<$width;$j++)
	{
		for ($i=0;$i<($height*$width)/1000;$i++)
		{
			$color = imagecolorallocatealpha ($img,$figures[rand(0,count($figures)-1)],$figures[rand(0,count($figures)-1)],$figures[rand(0,count($figures)-1)],
			rand(10,30));
			imagesetpixel($img,rand(0,$width),rand(0,$height),$color);
		}
	}

	for($i=0;$i<$sign;$i++)
	{
		$h=1;
		$color = imagecolorallocatealpha ($img,$figures[rand(0,count($figures)-1)],$figures[rand(0,count($figures)-1)],$figures[rand(0,count($figures)-1)],rand(10,30));
		$letter = $letters [rand(0,sizeof($letters)-1)];
		
		if(empty($x)) $x = $width*0.08;	
		else $x = $x + ($width*0.8)/$sign+rand(0,$width*0.01);
		if($h == rand(1,2)) $y = (($height*1)/4) + rand(0,$height*0.1); 
		else $y = (($height*1)/4) - rand(0,$height*0.1);
		$code .= $letter;
		if($h == rand(0,1)) $letter = strtoupper($letter);
		imagestring($img,6,$x,$y,$letter,$color);
	}
	$_SESSION['cpt']=$code;
	header ("Content-type: image/jpeg");
	imagejpeg($img);
	} 
}
?>