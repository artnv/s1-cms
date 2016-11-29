<?php 
 
if(empty($lc)) $lc = false;	
if($lc == true)
{

	if(OPTIONS_SITE == 1)
	{
		if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
		{
			header("Location: ".ADM_DIR);
		} else include "styles/".STYLE."/login.php";
	}
	else
	{
		if(is_numeric($_GET['id']))
		{
			include "includes/page.php";
			include "styles/".STYLE."/page.php";
		}
		else
		{
			switch($_GET['id'])
			{
			case 'sitemap':
				include "includes/sitemap.php";
				include "styles/".STYLE."/sitemap.php";
			break;
			case 'xmlsitemap':
				include "includes/sitemap.php";
				include "styles/".STYLE."/xmlsitemap.php";
			break;
			case 'list':
			case 'preview':
				include "includes/preview.php";
				include "styles/".STYLE."/preview.php";
			break;
			case 'login':
				if($_SESSION['admmod'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
				{
					header("Location: ".ADM_DIR);
				} else include "styles/".STYLE."/login.php";
			break;
			default:
				if(OPTIONS_INDEX_SITEMAP == 1)
				{
					include "includes/sitemap.php";
					include "styles/".STYLE."/sitemap.php";
				}
				else
				{
					include "includes/start.php";
					include "styles/".STYLE."/start.php";
				}	
			break;
			}
		}
	}
}
?>
