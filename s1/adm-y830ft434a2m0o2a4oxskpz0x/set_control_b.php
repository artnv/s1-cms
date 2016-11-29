<?php
error_reporting(E_ALL ^ E_NOTICE);
require "../includes/config.php";
require "adm_functions.php";


ini_set("session.use_trans_sid","1");
session_name(SESSION_NAME);
session_start();
if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{

	$action 	= $_GET['action'];
	$what 		= $_GET['what'];
	$selected 	= $_GET['selected'];

	$what = explode("-",$what);



	if($_GET['umch'] == "1")
	{
		if(file_exists("../".DB_DIR."/uplinksinfo")) $uplinksinfo = trim(file_get_contents("../".DB_DIR."/uplinksinfo"));
		
		//////
		if($what[0] == "dir")
		{
			switch($action)
			{
			case "up":
				if(file_exists("../".DB_DIR."/uplinks".trim($what[1])) && trim($what[1]) != 1)
				{
					$a = $what[1];
					$b = $what[1]-1;
					rename("../".DB_DIR."/uplinks".$a, "../".DB_DIR."/uplinkstmp1".$a);
					rename("../".DB_DIR."/uplinks".$b, "../".DB_DIR."/uplinkstmp2".$b);
					rename("../".DB_DIR."/uplinkstmp1".$a, "../".DB_DIR."/uplinks".$b);
					rename("../".DB_DIR."/uplinkstmp2".$b, "../".DB_DIR."/uplinks".$a);
				}
			break;
			case "down":
				if(file_exists("../".DB_DIR."/uplinks".trim($what[1])) && trim($what[1]) != $uplinksinfo)
				{
					$a = $what[1];
					$b = $what[1]+1;
					rename("../".DB_DIR."/uplinks".$a, "../".DB_DIR."/uplinkstmp1".$a);
					rename("../".DB_DIR."/uplinks".$b, "../".DB_DIR."/uplinkstmp2".$b);
					rename("../".DB_DIR."/uplinkstmp1".$a, "../".DB_DIR."/uplinks".$b);
					rename("../".DB_DIR."/uplinkstmp2".$b, "../".DB_DIR."/uplinks".$a);
				}
			break;
			case "del":
			
				$i = trim($what[1]);
				
				if(file_exists("../".DB_DIR."/uplinks$i"))
				{
					$cnt = trim(file_get_contents("../".DB_DIR."/uplinksinfo"));

					unlink("../".DB_DIR."/uplinks$i");
					
					if($i != $cnt)
					{
						$e = $i;
						$j = $i+1;
						for(;$e<$cnt;$e++)
						{
							rename("../".DB_DIR."/uplinks$j","../".DB_DIR."/uplinks$e");	
							$j++;
						}
					
					}

					$cnt--;
					file_put_contents("../".DB_DIR."/uplinksinfo",$cnt);
						
					break;
					
				}
			break;
			}
		}
	}
	else 
	{
		if(file_exists("../".DB_DIR."/menuinfo")) $info = trim(file_get_contents("../".DB_DIR."/menuinfo"));	
		
		//////
		switch($what[0])
		{
		case "dir":
			switch($action)
			{
			case "up":
				if(file_exists("../".DB_DIR."/m".trim($what[1])) && trim($what[1]) != 1)
				{
					$a = $what[1];
					$b = $what[1]-1;
					rename("../".DB_DIR."/m".$a, "../".DB_DIR."/mtmp1".$a);
					rename("../".DB_DIR."/m".$b, "../".DB_DIR."/mtmp2".$b);
					rename("../".DB_DIR."/mtmp1".$a, "../".DB_DIR."/m".$b);
					rename("../".DB_DIR."/mtmp2".$b, "../".DB_DIR."/m".$a);
				}
			break;
			case "down":
				if(file_exists("../".DB_DIR."/m".trim($what[1])) && trim($what[1]) != $info)
				{
					$a = $what[1];
					$b = $what[1]+1;
					rename("../".DB_DIR."/m".$a, "../".DB_DIR."/mtmp1".$a);
					rename("../".DB_DIR."/m".$b, "../".DB_DIR."/mtmp2".$b);
					rename("../".DB_DIR."/mtmp1".$a, "../".DB_DIR."/m".$b);
					rename("../".DB_DIR."/mtmp2".$b, "../".DB_DIR."/m".$a);
				}		
			break;
			case "del":
				if(file_exists("../".DB_DIR."/m".$what[1]))
				{
					$tmpf = file("../".DB_DIR."/m".$what[1]);
					if(trim($tmpf[0]) == "dir" || trim($tmpf[0]) == "main_dir")
					{
					
					/////////////////////////
						$tmpf2 = explode("-",trim($tmpf[1]));
						$a = trim($tmpf2[0]);
						$b = trim($tmpf2[0]) + trim($tmpf[4]);
					

						for(;$a<=$b;$a++) //удаляет страницы и комменты
						{
							if(file_exists("../".DB_DIR."/inf$a") && file_exists("../".DB_DIR."/p$a"))
							{



								//индекс
								if(file_exists("../".DB_DIR."/indexinfo"))
								{
									$ii = trim(file_get_contents("../".DB_DIR."/indexinfo"));

									if($ii != 0)
									{
										for($i=1;$i<=$ii;$i++)
										{
											if(file_exists("../".DB_DIR."/index$i"))
											{
												$idx = trim(file_get_contents("../".DB_DIR."/index$i"));

												if($idx == $a)
												{

													unlink("../".DB_DIR."/index$i");
													

													if($i != $ii)
													{
														$e = $i;
														$j = $i+1;
														for(;$e<$ii;$e++)
														{
															rename("../".DB_DIR."/index$j","../".DB_DIR."/index$e");	
															$j++;
														}
													}	
													

													$ii--;
													file_put_contents("../".DB_DIR."/indexinfo",$ii);
													break;
												}
											}
										}
									}
								}





								//коменты
								$tmpf3 = file("../".DB_DIR."/inf$a");
								for($e=1;$e<=trim($tmpf3[6]);$e++) //комменты
								{
									if(file_exists("../".DB_DIR."/cmt$a-$e"))
									{
										unlink("../".DB_DIR."/cmt$a-$e");
									} else continue;
								}


								//страницы
								unlink("../".DB_DIR."/inf$a");
								unlink("../".DB_DIR."/p$a");
							} else continue;
						}
						
					
					///////////////////////////удаляет меню-файл
					$k = -1;	
					for($j=1;$j<=$info;$j++)
					{
					$k++;

						if($what[1] == $j)
						{
							unlink("../".DB_DIR."/m".$what[1]); 
						}
						else
						{
							if($what[1] <= $j)
							{
								rename("../".DB_DIR."/m$j","../".DB_DIR."/m$k");	
							} else continue;
						}
						
					}
		
					$info--;
					file_put_contents("../".DB_DIR."/menuinfo",$info);

					////////
					$countdir = file("../".DB_DIR."/countdir");
					$cdt = trim($countdir[1]);
					$cdt--;
					file_put_contents("../".DB_DIR."/countdir",trim($countdir[0])."\n".$cdt);
					
						////////
						if($cdt == 0)
						{
							file_put_contents("../".DB_DIR."/freespace","");
						}
						else
						{
							$fs = fopen("../".DB_DIR."/freespace", "a");
							fputs($fs,trim($tmpf[1])."\n");
							fclose($fs);
						}
						
					}
					else
					{
						$k = -1;	
						for($j=1;$j<=$info;$j++)
						{
							$k++;

							if($what[1] == $j)
							{
								unlink("../".DB_DIR."/m".$what[1]); 
							}
							else
							{
								if($what[1] <= $j)
								{
									rename("../".DB_DIR."/m$j","../".DB_DIR."/m$k");	
								} else continue;
							}
						
						}
		
						$info--;
						file_put_contents("../".DB_DIR."/menuinfo",$info);

					}
					
				}
			break;
			}
		break; /////////////////////////////////////////////////////////////////////////////////////////////////
		case "page":
			if($action == "del" && file_exists("../".DB_DIR."/p".$what[1]) && file_exists("../".DB_DIR."/inf".$what[1]))
			{
				///удаление из индекса
				if(file_exists("../".DB_DIR."/indexinfo"))
				{
					$ii = trim(file_get_contents("../".DB_DIR."/indexinfo"));

					if($ii != 0)
					{
						for($i=1;$i<=$ii;$i++)
						{
							if(file_exists("../".DB_DIR."/index$i"))
							{
								$idx = trim(file_get_contents("../".DB_DIR."/index$i"));

								if($idx == $what[1])
								{

									unlink("../".DB_DIR."/index$i");
									

									if($i != $ii)
									{
										$e = $i;
										$j = $i+1;
										for(;$e<$ii;$e++)
										{
											rename("../".DB_DIR."/index$j","../".DB_DIR."/index$e");	
											$j++;
										}
									}	
									

									$ii--;
									file_put_contents("../".DB_DIR."/indexinfo",$ii);
									break;
								}
							}
						}
					}
				}


				$tmp_f = file("../".DB_DIR."/inf".$what[1]);
				
				if(trim($tmp_f[6]) > 0)
				{
					for($e=1;$e<=trim($tmp_f[6]);$e++)
					{
						if(file_exists("../".DB_DIR."/cmt".$what[1]."-".$e))
						{
							unlink("../".DB_DIR."/cmt".$what[1]."-".$e);	
						} else continue;
					}
				}

				unlink("../".DB_DIR."/p".$what[1]);
				unlink("../".DB_DIR."/inf".$what[1]);

				for($i=1;$i<=$info;$i++)
				{
					if(file_exists("../".DB_DIR."/m$i"))
					{
						$tmpdir = file("../".DB_DIR."/m$i");
						if(trim($tmpdir[0]) == 'dir' || trim($tmpdir[0]) == "main_dir")
						{
							$direxp = explode('-',$tmpdir[1]);
							if($what[1] >= $direxp[0] && $what[1] <= $direxp[1])
							{
							
								if(trim($tmpdir[6]) > 0 && trim($tmp_f[8]) > 0) 
								{
									$tmpdir6 = trim($tmpdir[6])-trim($tmp_f[8]);
								} else $tmpdir6 = trim($tmpdir[6]);
			
								/////
								$tmpdir5 = trim($tmpdir[5]);
								$tmpdir5--;
								$tmpdir4 = trim($tmpdir[4]);
								if($tmpdir5 <= 0) $tmpdir4 = 0;
								$tmp_str = $tmpdir[0].$tmpdir[1].$tmpdir[2].$tmpdir[3].$tmpdir4."\n".$tmpdir5."\n".$tmpdir6;
								file_put_contents("../".DB_DIR."/m$i",$tmp_str);
								break;
							} else continue;
						} else continue;		
					} else continue;
				}	
			}
		break; /////////////////////////////////////////////////////////////////////////////////////////////////
		case "index":
			switch($action)
			{
			case "del":
				
				$sld = explode("-",$selected);
				
				if(file_exists("../".DB_DIR."/indexinfo"))
				{
					$cnt = trim(file_get_contents("../".DB_DIR."/indexinfo"));
					
					for($i=1;$i<=$cnt;$i++)
					{
						if(file_exists("../".DB_DIR."/index$i"))
						{
							$f = trim(file_get_contents("../".DB_DIR."/index$i"));
							if($f == trim($sld[1]))
							{
								unlink("../".DB_DIR."/index$i");
								
								if($i != $cnt)
								{
									$e = $i;
									$j = $i+1;
									for(;$e<$cnt;$e++)
									{
										rename("../".DB_DIR."/index$j","../".DB_DIR."/index$e");	
										$j++;
									}
								
								}

								$cnt--;
								file_put_contents("../".DB_DIR."/indexinfo",$cnt);
									
								break;
							}
						}
					}
					
				}
				
			break;
			}
		
		break;
		case "move":

			/*
				action		=	page-100019
				selected	=	dir-2
				what		=	move
			*/
			
			$page_t 		= 	explode("-",$action);	  //страница
			$indir_t		= 	explode("-",$selected);   //каталог	
			$page 			= 	trim($page_t[1]);     //200019
			$in_dir 		= 	trim($indir_t[1]);    //сюда сохранить страницу
			$out_dir		= 	get_ndir($page);	  //старый каталог страницы
		
		
		
		if(file_exists("../".DB_DIR."/p$page") && file_exists("../".DB_DIR."/inf$page") && file_exists("../".DB_DIR."/m$in_dir") && $in_dir != $out_dir)
		{
		
			/////////
			$indir 		= file("../".DB_DIR."/m$in_dir");
			$indirexp 	= explode("-",trim($indir[1])); // 200000-299999
			$indir_id 	= trim($indirexp[0])+trim($indir[4])+1; //200000 + 25 + 1
			$indir4 	= trim($indir[4])+1;
			$indir5 	= trim($indir[5])+1;
		
		
			////////////////////////////////Переименовываем комментарии
			$fcmtc = file("../".DB_DIR."/inf$page");
			if(trim($fcmtc[6]) > 0)
			{
				for($i=1;$i<=trim($fcmtc[6]);$i++)
				{
					if(file_exists("../".DB_DIR."/cmt$page-$i"))
					{
						$tmpcmt = "cmt$indir_id-$i";
						rename("../".DB_DIR."/cmt$page-$i","../".DB_DIR."/$tmpcmt");
					}
				}
			
			}
		
			
			$tmpinf = file("../".DB_DIR."/inf$page");
			
			///////////
			rename("../".DB_DIR."/p$page","../".DB_DIR."/p$indir_id");
			rename("../".DB_DIR."/inf$page","../".DB_DIR."/inf$indir_id");
			
			
			$indir6 = trim($indir[6])+trim($tmpinf[8]);
			
			$str = trim($indir[0])."\n".trim($indir[1])."\n".trim($indir[2])."\n".trim($indir[3])."\n".$indir4."\n".$indir5."\n".$indir6;
			file_put_contents("../".DB_DIR."/m$in_dir",$str);
		
			//////////
			$outdir 	= file("../".DB_DIR."/m$out_dir");
			$outdir5	= trim($outdir[5])-1;
			$outdir6    = trim($outdir[6])-trim($tmpinf[8]);  
			$outdir4	= trim($outdir[4]);
			if($outdir5 <= 0) $outdir4 =0;
			$str2 		= trim($outdir[0])."\n".trim($outdir[1])."\n".trim($outdir[2])."\n".trim($outdir[3])."\n".$outdir4."\n".$outdir5."\n".$outdir6;
			file_put_contents("../".DB_DIR."/m$out_dir",$str2);
			
			/////////////////////////////////удаление с главной 
			if(file_exists("../".DB_DIR."/indexinfo"))
			{
				$findex = trim(file_get_contents("../".DB_DIR."/indexinfo"));
				
				for($i=1;$i<=$findex;$i++)
				{
					if(file_exists("../".DB_DIR."/index$i"))
					{
						$ft = trim(file_get_contents("../".DB_DIR."/index$i"));
						if($page == $ft)
						{
							unlink("../".DB_DIR."/index$i");
							
							if($i != $findex)
							{
								$e = $i;
								$j = $i+1;
								for(;$e<$findex;$e++)
								{
									rename("../".DB_DIR."/index$j","../".DB_DIR."/index$e");	
									$j++;
								}
							}	
							
							$findex--;
							file_put_contents("../".DB_DIR."/indexinfo",$findex);						
							break;
							
							
						}
					}
				}
			}
			
			
		} 	
		break;
		case "cmt":
		
			$sld = explode("-",$selected);
			$s = trim($sld[1]);
			
			switch($action)
			{
			case "deny":
				if(file_exists("../".DB_DIR."/m$s"))
				{
					$dir 	= 	file("../".DB_DIR."/m$s");
					$dir3	=	0;
					$str 	= 	trim($dir[0])."\n".trim($dir[1])."\n".trim($dir[2])."\n".$dir3."\n".trim($dir[4])."\n".trim($dir[5])."\n".trim($dir[6]);
					file_put_contents("../".DB_DIR."/m$s",$str);
				}
			break;
			case "allow":
				if(file_exists("../".DB_DIR."/m$s"))
				{
					$dir 	= 	file("../".DB_DIR."/m$s");
					$dir3	=	1;
					$str 	= 	trim($dir[0])."\n".trim($dir[1])."\n".trim($dir[2])."\n".$dir3."\n".trim($dir[4])."\n".trim($dir[5])."\n".trim($dir[6]);
					file_put_contents("../".DB_DIR."/m$s",$str);
				}
			break;
			}
		break;
		case "maindir":
			switch($action)
			{
			case "deny":
				$sld 	= 	explode("-",$selected);
				$s 		= 	trim($sld[1]);
				$dir 	= 	file("../".DB_DIR."/m$s");
				$str 	= 	"dir"."\n".trim($dir[1])."\n".trim($dir[2])."\n".trim($dir[3])."\n".trim($dir[4])."\n".trim($dir[5])."\n".trim($dir[6]);
				file_put_contents("../".DB_DIR."/m$s",$str);
			break;
			case "allow":
			
				$fmc	=	trim(file_get_contents("../".DB_DIR."/menuinfo"));	
				
				$sld 	= 	explode("-",$selected);
				$s 		= 	trim($sld[1]);
				$dir2 	= 	file("../".DB_DIR."/m$s");
				
				if(trim($dir2[4]) == 0)
				{
					for($i=1;$i<=$fmc;$i++)
					{
						$dir 	= 	file("../".DB_DIR."/m$i");
						if(trim($dir[0]) == "main_dir")
						{
							$str 	= 	"dir"."\n".trim($dir[1])."\n".trim($dir[2])."\n".trim($dir[3])."\n".trim($dir[4])."\n".trim($dir[5])."\n".trim($dir[6]);
							file_put_contents("../".DB_DIR."/m$i",$str);
						}
					}	
					
					
					///
					$str 	= 	"main_dir"."\n".trim($dir2[1])."\n".trim($dir2[2])."\n".trim($dir2[3])."\n".trim($dir2[4])."\n".trim($dir2[5])."\n".trim($dir2[6]);
					file_put_contents("../".DB_DIR."/m$s",$str);
				}
				else
				{
					header('Content-Type: text/xml');
					echo '<?xml version="1.0" encoding="utf-8" standalone="yes"?><response><notnull>1</notnull></response>';
				}
			break;
			}
		break;
		}
	}
}
?>