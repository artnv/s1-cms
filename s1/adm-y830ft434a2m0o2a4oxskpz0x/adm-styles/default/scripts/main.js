var onoffsl 		= 0;
var setopt_umch 	= 0;
var login_list		= 0;
var selected_dir 	= "";
var selected_index 	= "";
var selected_dir2 	= "";
var selected_page 	= "";
var j_main_dir;

var menu_sd1 		= "";
var menu_sd3 		= "";
var menu_sd2 		= 0;

var page_sd1 		= "";
var page_sd3 		= "";
var page_sd2 		= 0;

var index_sd1	    = "";
var index_sd3 		= "";
var index_sd2 		= 0;

var newedit_m 		= "";
var newedit_p 		= "";
var newedit_name 	= "";
var newedit_url 	= "";

/////////////////////////////////ajax
var xmlhttp_menu		=	xp();
var xmlhttp_index_page	=	xp();
var xmlhttp_pages		=	xp();
var xmlhttp_dir_info	=	xp();
var xmlhttp_page_info	=	xp();
var xmlhttp_text		=	xp();
////set
var xmlhttp_setopt		=	xp();
var xmlhttp_cc_menu		=	xp();
var xmlhttp_newedit		=	xp();
var xmlhttp_newpage		=	xp();
////idm inc ctrl
var xmlhttp_bandel_cmt	=	xp();
/////
var lck1=1,lck2=1,lck3=1,lck4=1,lck5=1,lck6=1,lck7=1,lck8=1,lck9=1,lck10=1,lck11=1;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
function load()
{
	get_menu();
	get_index_page();
	offsl();
	tb1();
	edtbtn(1);
}
*/
function report_msg(arg)
{
	if(arg) alert(arg);
}
function edtbtn(arg)
{
	switch(arg)
	{
		case 1:
			document.getElementById("edt").style.display = "block";
			document.getElementById("login_log").style.display = "none";
			document.getElementById("error_log").style.display = "none";
			document.getElementById("ehb1").style.background = "#f6f8f8";
			document.getElementById("ehb2").style.background = "#ffffff";
			document.getElementById("ehb3").style.background = "#ffffff";
			
			document.getElementById("ehb1").style.color = "#000000";
			document.getElementById("ehb2").style.color = "#b2b2b2";
			document.getElementById("ehb3").style.color = "#b2b2b2";
			
		break;
		case 2:
			document.getElementById("edt").style.display = "none";
			document.getElementById("login_log").style.display = "block";
			document.getElementById("error_log").style.display = "none";
			document.getElementById("ehb2").style.background = "#f6f8f8";
			document.getElementById("ehb1").style.background = "#ffffff";
			document.getElementById("ehb3").style.background = "#ffffff";
			
			document.getElementById("ehb1").style.color = "#b2b2b2";
			document.getElementById("ehb2").style.color = "#000000";
			document.getElementById("ehb3").style.color = "#b2b2b2";
		break;
		case 3:
			document.getElementById("edt").style.display = "none";
			document.getElementById("login_log").style.display = "none";
			document.getElementById("error_log").style.display = "block";
			document.getElementById("ehb3").style.background = "#f6f8f8";
			document.getElementById("ehb1").style.background = "#ffffff";
			document.getElementById("ehb2").style.background = "#ffffff";
			
			document.getElementById("ehb1").style.color = "#b2b2b2";
			document.getElementById("ehb2").style.color = "#b2b2b2";
			document.getElementById("ehb3").style.color = "#000000";
		break;
	}
}

function login(arg)
{
	login_list = !login_list;
	
	if(login_list == 1)
	{
		document.getElementById("login_list").style.display = "block";
	}
	else
	{
		document.getElementById("login_list").style.display = "none";
	}
}

function s_menu(mdir)
{
	if(mdir)
	{
		selected_dir = mdir;
		if(page_sd1) document.getElementById(page_sd1).style.background = "none";
		if(page_sd3) document.getElementById(page_sd3).style.background = "none";
		page_sd1 = "";
		page_sd3 = "";
		page_sd2 = 0;

		if(menu_sd2 == 1) 
		{
			try
			{
			menu_sd3 = mdir;
			document.getElementById(menu_sd1).style.background = "none";
			document.getElementById(menu_sd3).style.background = "#ccc";
			menu_sd2 = 0;
			} catch(e) {}

		}
		else
		{
			document.getElementById(mdir).style.background = "#ccc";
			if(menu_sd3) document.getElementById(menu_sd3).style.background = "none";
			menu_sd1 = mdir;
			menu_sd2 =1;
		}

		document.getElementById("savebtn").value = "Добавить, новую страницу";
	}
}

function s_page(pdir)
{
	selected_page = pdir;
	if(page_sd2 == 1) 
	{
		page_sd3 = pdir;
		document.getElementById(page_sd1).style.background = "none";
		document.getElementById(page_sd3).style.background = "#ccc";
		page_sd2 = 0;
	}
	else
	{
		document.getElementById(pdir).style.background = "#ccc";
		if(page_sd3) document.getElementById(page_sd3).style.background = "none";
		page_sd1 = pdir;
		page_sd2 =1;
	}
	
	document.getElementById("savebtn").value = "Обновить, страницу";
}

function s_index(ddir)
{
selected_index = ddir;
var tmp = ddir.split("-");
selected_page = "page-"+tmp[1];

	if(index_sd2 == 1) 
	{
		index_sd3 = ddir;
		document.getElementById(index_sd1).style.background = "none";
		document.getElementById(index_sd3).style.background = "#ccc";
		index_sd2 = 0;
	}
	else
	{
		document.getElementById(ddir).style.background = "#ccc";
		if(index_sd3) document.getElementById(index_sd3).style.background = "none";
		index_sd1 = ddir;
		index_sd2 =1;
	}
	
	document.getElementById("savebtn").value = "Обновить, страницу";
}
function onsl()
{
newedit_m = "edit";
document.getElementById("sl2").className = "offsl";
document.getElementById("sl1").className = "onsl";
document.getElementById("sbb").value = "Изменить";

document.getElementById("tab1-ln").value="";
document.getElementById("tab1-url").value="";
document.getElementById("tab2-nd").value="";
document.getElementById("tab3-ns").value="";

onoffsl = 1;
}
function offsl()
{
newedit_m = "new";
document.getElementById("sl1").className = "offsl";
document.getElementById("sl2").className = "onsl";
document.getElementById("sbb").value = "Добавить";

document.getElementById("tab1-ln").value="";
document.getElementById("tab1-url").value="";
document.getElementById("tab2-nd").value="";
document.getElementById("tab3-ns").value="";

onoffsl = 0;
}
//////////////////
function tb1(arg)
{
newedit_p = "link";
	if(arg)
	{
		var arg = document.getElementById(arg).innerHTML;
		var tmparg = arg.split("-");
		document.getElementById("tab1-ln").value = tmparg[0];
		document.getElementById("tab1-url").value = tmparg[1];
			
		document.getElementById("tb1").className = "onsl";
		document.getElementById("tb2").className = "offsl";
		document.getElementById("tb3").className = "offsl";

		document.getElementById("tab1").style.display = "block";
		document.getElementById("tab2").style.display = "none";
		document.getElementById("tab3").style.display = "none";			
	}
	else
	{
	
		document.getElementById("tab1-ln").value="";
		document.getElementById("tab1-url").value="";
		document.getElementById("tab2-nd").value="";
		document.getElementById("tab3-ns").value="";
		
	
		document.getElementById("tb1").className = "onsl";
		document.getElementById("tb2").className = "offsl";
		document.getElementById("tb3").className = "offsl";

		document.getElementById("tab1").style.display = "block";
		document.getElementById("tab2").style.display = "none";
		document.getElementById("tab3").style.display = "none";
	}

}

function tb2(arg)
{
newedit_p = "dir";
	if(arg)
	{
		
		document.getElementById("tab2-nd").value = document.getElementById(arg).innerHTML;

		document.getElementById("tb1").className = "offsl";
		document.getElementById("tb2").className = "onsl";
		document.getElementById("tb3").className = "offsl";

		document.getElementById("tab1").style.display = "none";
		document.getElementById("tab2").style.display = "block";
		document.getElementById("tab3").style.display = "none";			
	}
	else
	{
	
		document.getElementById("tab1-ln").value="";
		document.getElementById("tab1-url").value="";
		document.getElementById("tab2-nd").value="";
		document.getElementById("tab3-ns").value="";
		
		
		document.getElementById("tb1").className = "offsl";
		document.getElementById("tb2").className = "onsl";
		document.getElementById("tb3").className = "offsl";

		document.getElementById("tab1").style.display = "none";
		document.getElementById("tab2").style.display = "block";
		document.getElementById("tab3").style.display = "none";
	}
}

function tb3(arg)
{
newedit_p = "section";
	if(arg)
	{
		document.getElementById("tab3-ns").value = document.getElementById(arg).innerHTML;
					
		document.getElementById("tb1").className = "offsl";
		document.getElementById("tb2").className = "offsl";
		document.getElementById("tb3").className = "onsl";

		document.getElementById("tab1").style.display = "none";
		document.getElementById("tab2").style.display = "none";
		document.getElementById("tab3").style.display = "block";
	}
	else
	{
	
		document.getElementById("tab1-ln").value="";
		document.getElementById("tab1-url").value="";
		document.getElementById("tab2-nd").value="";
		document.getElementById("tab3-ns").value="";
		
	
		document.getElementById("tb1").className = "offsl";
		document.getElementById("tb2").className = "offsl";
		document.getElementById("tb3").className = "onsl";

		document.getElementById("tab1").style.display = "none";
		document.getElementById("tab2").style.display = "none";
		document.getElementById("tab3").style.display = "block";
	}
}
///////////////
function clr()
{
	document.getElementById("txtar").value = "";
	document.getElementById("e-h").value = "";
	document.getElementById("e-title").value = "";
	document.getElementById("e-keywords").value = "";
	document.getElementById("e-description").value = "";
	document.getElementById("p-date").innerHTML = "";
	document.getElementById("p-count").innerHTML = "";
	document.getElementById("p-size").innerHTML = "";
	document.getElementById("p-h").innerHTML = "";
	///////
	document.getElementById("j-sldir").innerHTML = "";
	document.getElementById("j-sizedir").innerHTML = "";
	document.getElementById("j-pages").innerHTML = "";
	document.getElementById("j-cmt").innerHTML = "";
	
	///////
	try 
	{
		if(menu_sd1) document.getElementById(menu_sd1).style.background = "none";
		if(menu_sd3) document.getElementById(menu_sd3).style.background = "none";
		if(page_sd1) document.getElementById(page_sd1).style.background = "none";
		if(page_sd3) document.getElementById(page_sd3).style.background = "none";
		if(index_sd1) document.getElementById(index_sd1).style.background = "none";
		if(index_sd3) document.getElementById(index_sd3).style.background = "none";
	} catch(e) {}
	
	menu_sd1 = "";
	menu_sd3 = "";
	menu_sd2 = 0;
	page_sd1 = "";
	page_sd3 = "";
	page_sd2 = 0;
	index_sd1 = "";
	index_sd3 = "";
	index_sd2 = 0;
	
	selected_page="";
	////////
	document.getElementById("savebtn").value = "Добавить, новую страницу";
}
/////////
function umch(arg)
{
	switch(arg)
	{
	case 'l':
		
		offsl();
		get_menu();
		get_index_page();
		
		document.getElementById("umch2").style.background = "#ffffff";
		document.getElementById("umch1").style.background = "#f6f8f8";
		document.getElementById("umch1").style.color = "#000000";
		document.getElementById("umch2").style.color = "#b2b2b2";
		
		document.getElementById("tb2").style.display = "inline";
		document.getElementById("tb3").style.display = "inline";
		
		setopt_umch = 0;
	break;
	case 'u':
	
		////////
		clr();
		selected_dir = "";
		selected_index = "";
		selected_page = "";
		
		//////////
		document.getElementById("chblock").innerHTML = "";
		document.getElementById("chblock2").innerHTML = "";
		
		/////////
		offsl();
		get_menu('u');
		
		tb1();
		document.getElementById("umch1").style.background = "#ffffff";
		document.getElementById("umch2").style.background = "#f6f8f8";
		document.getElementById("umch1").style.color = "#b2b2b2";
		document.getElementById("umch2").style.color = "#000000";
		
		document.getElementById("tb2").style.display = "none";
		document.getElementById("tb3").style.display = "none";
		
		setopt_umch = 1;
	break;
	}

}
function loading_show(arg,id)
{
	if(arg == 1)
	{	
		document.getElementById("loading"+id).style.display = "inline";
	}
	else 
	{
		document.getElementById("loading"+id).style.display = "none";
	}
		
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////ajax

function xp()
{
	var xmlhttp;
	
	try
	{
		xmlhttp = new XMLHttpRequest();
	}
	catch(e)
	{
		var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0","MSXML2.XMLHTTP.5.0","MSXML2.XMLHTTP.4.0","MSXML2.XMLHTTP.3.0","MSXML2.XMLHTTP.2.0","MSXML2.XMLHTTP","Microsoft.XMLHTTP");
		for(var i=0;i<XmlHttpVersions.length && !xmlhttp; i++)
		{
			try
			{
				xmlhttp = new ActiveXObject(XmlHttpVersions[i]);
			}
			catch (e) {
				alert("xp::error: 1\n"+e);
			}
		}
	}
	
	if(!xmlhttp) alert("xp::error: 2");
	else return xmlhttp;
}

////////////////////////////

function get_menu(arg)
{
	if(xmlhttp_menu && lck1 == 1)
	{
		try
		{
			var url ='get_menu.php?'+get_sessn();
			if(arg == 'u') url = 'get_menu.php?a=u&'+get_sessn();
			
			xmlhttp_menu.open("GET",url,true);
			xmlhttp_menu.onreadystatechange = function HRSC()
			{
			
				if(xmlhttp_menu.readyState == 4)
				{
					loading_show(0,1);
					lck1=1;
					
					if(xmlhttp_menu.status == 200)
					{
						var response = xmlhttp_menu.responseText;
						document.getElementById("chblock").innerHTML=response;
					}
					else
					{
						alert("get_menu::error: 1");
					}
				}
			}
			lck1=0;
			loading_show(1,1);
			xmlhttp_menu.send(null);
				
		}
		catch(e)
		{
			alert("get_menu::error: 2\n"+e);
		}
	}
}

function get_index_page()
{
	if(xmlhttp_index_page && lck2 == 1)
	{
		try
		{
			xmlhttp_index_page.open("GET",'get_index_page.php?'+get_sessn(),true);
			xmlhttp_index_page.onreadystatechange = function HRSC()
			{

				if(xmlhttp_index_page.readyState == 4)
				{
				
					loading_show(0,2);
					lck2 = 1;
				
					if(xmlhttp_index_page.status == 200)
					{
						var response = xmlhttp_index_page.responseText;
						document.getElementById("chblock3").innerHTML=response;
					}
					else
					{
						alert("get_index_page::error: 1");
					}
				}
			}
			lck2 = 0;
			loading_show(1,2);
			xmlhttp_index_page.send(null);
		}
		catch(e)
		{
			alert("get_index_page::error: 2\n"+e);
		}
	}
}

function get_pages(dir)
{
	if(xmlhttp_pages && dir && lck3 == 1)
	{
		selected_dir2 = dir;
		try
		{
			var tmpdir = dir.split("-");
			dir = tmpdir[1];
			
			xmlhttp_pages.open("GET",'get_pages.php?dir='+dir+'&'+get_sessn(),true);
			xmlhttp_pages.onreadystatechange = function HRSC()
			{
				loading_show(0,3);
				lck3 = 1;
				if(xmlhttp_pages.readyState == 4)
				{
					if(xmlhttp_pages.status == 200)
					{
						var response = xmlhttp_pages.responseText;
						document.getElementById("chblock2").innerHTML=response;
					}
					else
					{
						alert("get_pages::error: 1");
					}
				}
			}
			lck3 = 0;
			loading_show(1,3);
			xmlhttp_pages.send(null);
		}
		catch(e)
		{
			alert("get_pages::error: 2\n"+e);
		}
	}
	
}


function get_dir_info(dir)
{
	if(xmlhttp_dir_info && lck4 == 1)
	{
		try
		{
			xmlhttp_dir_info.open("GET",'get_dir_info.php?dir='+dir+'&'+get_sessn(),true);
			xmlhttp_dir_info.onreadystatechange = function HRSC()
			{
			
				if(xmlhttp_dir_info.readyState == 4)
				{
					
					loading_show(0,4);
					lck4 = 1;
					if(xmlhttp_dir_info.status == 200)
					{
					
					
						var response = xmlhttp_dir_info.responseXML;
						
						
						
						try 
						{ 
							xmlDoc = response.documentElement;
							document.getElementById("j-sizedir").innerHTML = xmlDoc.getElementsByTagName("dirsize")[0].firstChild.data;
							document.getElementById("j-pages").innerHTML = xmlDoc.getElementsByTagName("pages")[0].firstChild.data;
						} 
						catch(e) 	{ }

					
						try
						{
						if(xmlDoc.getElementsByTagName("cmt")[0].firstChild.data == 0) 
						{	document.getElementById("j-cmt").innerHTML = '<span class="r">запрещено</span> / <a href="javascript:set_opt(\'allow\',\'cmt\');" class="blue">разрешить?</a>';	}
						else 
						{	document.getElementById("j-cmt").innerHTML = '<span class="g">разрешено</span> / <a href="javascript:set_opt(\'deny\',\'cmt\');" class="blue">запретить?</a>';	}
						} catch(e) 	{ }
						
						
						
						try
						{
						
						if(xmlDoc.getElementsByTagName("maindir")[0].firstChild.data == 0) 
						{	document.getElementById("j-maindir").innerHTML = '<span class="r">Нет</span> / <a href="javascript:set_opt(\'allow\',\'maindir\');" class="blue">Да</a>';	}
						else 
						{	document.getElementById("j-maindir").innerHTML = '<span class="g">Да</span> / <a href="javascript:set_opt(\'deny\',\'maindir\');" class="blue">Нет</a>';	}
						

						j_main_dir = xmlDoc.getElementsByTagName("maindir")[0].firstChild.data;
							if(j_main_dir == 1)
							{
								document.getElementById("e-indexpage").innerHTML = '<label><input type="checkbox" id="ef-indexpage" checked="checked" disabled="disabled" /> Вывести на главную</label>';
							}
							else
							{
								document.getElementById("e-indexpage").innerHTML = '<label><input type="checkbox" id="ef-indexpage" /> Вывести на главную</label>';
							
							}
						} catch(e) 	{ }
						
						try {
						dir = dir.split("-");
						document.getElementById("j-sldir").innerHTML = '<a href="../index.php?id=preview&dir='+dir[1]+'&page=0" target="_blank">'+document.getElementById(dir[0]+'-'+dir[1]).innerHTML+'</a>';
						} catch(e) 	{ }

					}
					else
					{
						alert("get_dir_info::error: 1");
					}
				}
			}
			lck4 = 0;
			loading_show(1,4);
			xmlhttp_dir_info.send(null);
		}
		catch(e)
		{
			alert("get_dir_info::error: 2\n"+e);
		}
	}
}



function get_page_info(page)
{
	if(xmlhttp_page_info && lck5 == 1)
	{
		try
		{
			xmlhttp_page_info.open("GET",'get_page_info.php?id='+page+'&'+get_sessn(),true);
			xmlhttp_page_info.onreadystatechange = function HRSC()
			{

				if(xmlhttp_page_info.readyState == 4)
				{
					loading_show(0,5);
					lck5 = 1;
					if(xmlhttp_page_info.status == 200)
					{
					
						try 
						{
							var response = xmlhttp_page_info.responseXML;
							var xmlDoc = response.documentElement;
						} catch(e) {}
						
						
						try {
							if(xmlDoc.getElementsByTagName("meta")[0].firstChild.data == 1) 
							{
								document.getElementById("e-meta").innerHTML = '<label><input type="checkbox" id="ef-newmeta" checked="checked" /> Использовать новую Meta — информацию</label>';
							}
							else 
							{
								document.getElementById("e-meta").innerHTML = '<label><input type="checkbox" id="ef-newmeta" /> Использовать новую Meta — информацию</label>';
							}
						} catch(e) {}
						
						
						
						try {	
							if(j_main_dir == 1)
							{
								document.getElementById("e-indexpage").innerHTML = '<label><input type="checkbox" id="ef-indexpage" checked="checked" disabled="disabled" /> Вывести на главную</label>';
							}
							else
							{
								if(xmlDoc.getElementsByTagName("index")[0].firstChild.data == 1) 
								{
									document.getElementById("e-indexpage").innerHTML = '<label><input type="checkbox" id="ef-indexpage" checked="checked" /> Вывести на главную</label>';
								}
								else 
								{
									document.getElementById("e-indexpage").innerHTML = '<label><input type="checkbox" id="ef-indexpage" /> Вывести на главную</label>';
								}
							}
						} catch(e) {}
						
						
						
						
						try {
							if(xmlDoc.getElementsByTagName("cmt")[0].firstChild.data == 1) 
							{
								document.getElementById("e-cmt").innerHTML = '<label><input type="checkbox" id="ef-cmt" checked="checked" /> Разрешить комментарии, к странице</label>';
							}
							else 
							{
								document.getElementById("e-cmt").innerHTML = '<label><input type="checkbox" id="ef-cmt" /> Разрешить комментарии, к странице</label>';
							}
						} catch(e) {}
							
		
						try {
							document.getElementById("e-keywords").value = xmlDoc.getElementsByTagName("keywords")[0].firstChild.data;
						} catch(e) {}
						
						try {
							document.getElementById("e-description").value = xmlDoc.getElementsByTagName("description")[0].firstChild.data;
						} catch(e) {}
						
						try {
							document.getElementById("e-title").value = xmlDoc.getElementsByTagName("title")[0].firstChild.data;
						} catch(e) {}
						
						try {
							document.getElementById("p-date").innerHTML = xmlDoc.getElementsByTagName("date")[0].firstChild.data;
						} catch(e) {}
		
							try {
							document.getElementById("e-h").value = xmlDoc.getElementsByTagName("h")[0].firstChild.data;
						} catch(e) {}
					
						try {
							document.getElementById("p-count").innerHTML = xmlDoc.getElementsByTagName("countcmt")[0].firstChild.data;
						} catch(e) {}

						try {
							document.getElementById("p-size").innerHTML = xmlDoc.getElementsByTagName("pagesize")[0].firstChild.data;		
						} catch(e) {}
		
		
		
						var pg = page.split('-');
		
						var plink = document.getElementById(page).innerHTML
						plink = '<a href="../index.php?id='+pg[1]+'" target="_blank">'+plink+'</a>';
						document.getElementById("p-h").innerHTML = plink;
		
		
					}
					else
					{
						alert("get_page_info::error: 1");
					}
				}
			}
			lck5 = 0;
			loading_show(1,5);
			xmlhttp_page_info.send(null);
		}
		catch(e)
		{
			alert("get_page_info::error: 2\n"+e);
		}
	}
}




function get_text(page)
{
	if(xmlhttp_text && lck6 == 1)
	{
		try
		{
			var tmppage = page.split("-");
		
			xmlhttp_text.open("GET",'get_text.php?page='+page+'&'+get_sessn(),true);
			xmlhttp_text.onreadystatechange = function HRSC()
			{
				if(xmlhttp_text.readyState == 4)
				{
					loading_show(0,6);
					lck6 = 1;
					if(xmlhttp_text.status == 200)
					{
						var response = xmlhttp_text.responseText;
						document.getElementById("txtar").value=response;
					}
					else
					{
						alert("get_text::error: 1");
					}

				}
			}
			lck6 = 0;
			loading_show(1,6);
			xmlhttp_text.send(null);
		}
		catch(e)
		{
			alert("get_text::error: 2\n"+e);
		}
	}
	
}

//////

function set_opt(action,arg2)
{
	if(xmlhttp_setopt && lck7 == 1)
	{
		try
		{

			var tmparg = '';
			var url = '';
	
			if(setopt_umch == 1 && arg2 == "dir")
			{
				if(selected_dir)
				{
					url = '?action='+action+'&what='+selected_dir+'&umch=1';
				} else return;
			}
			else
			{
				switch(arg2)
				{
				case "dir":
					if(selected_dir)
					{
						url = '?action='+action+'&what='+selected_dir;
					} else return;
				break;
				case "page":
					if(selected_dir)
					{
						url = '?action='+action+'&what='+selected_page;
					} else return;
				break;
				case "move":
					if(selected_dir && selected_page)
					{
						url = '?action='+selected_page+'&selected='+selected_dir+'&what='+arg2;
					} else 
					{
						alert("Выберите каталог и страницу!");
						return;
					}
				break;
				case "cmt":
					if(selected_dir) 
					{
						url = '?action='+action+'&selected='+selected_dir+'&what='+arg2;
					} else return;
				break;
				case "index":
					if(selected_index) 
					{
						url = '?action='+action+'&selected='+selected_index+'&what='+arg2;
					} else return;
				break;
				case "maindir":
					if(selected_dir) 
					{
						url = '?action='+action+'&selected='+selected_dir+'&what='+arg2;
					} else return;
				break;
				}
			}

			if(action == 'del')
			{
				if(!confirm("Удалить?")) return;
			}
			

			xmlhttp_setopt.open("GET",'set_control_b.php'+url+'&'+get_sessn(),true);
			xmlhttp_setopt.onreadystatechange = function HRSC()
			{
				if(xmlhttp_setopt.readyState == 4)
				{
					loading_show(0,7);
					lck7 = 1;
					if(xmlhttp_setopt.status == 200)
					{
						try
						{
							var response = xmlhttp_setopt.responseXML;
							var xmlDoc = response.documentElement;
							var notnull = xmlDoc.getElementsByTagName("notnull")[0].firstChild.data;
							
							if(notnull == 1) report_msg('Каталог должен быть пустым !');
							
						} catch (e) {}
						
						if(arg2 != "cmt")
						{
	
							clr();
							
							if(setopt_umch == 1)
							{
								get_menu('u');
							}
							else
							{
								get_menu();
							}
							
							
							if(selected_dir) 
							{
								get_pages(selected_dir);
								get_dir_info(selected_dir);
							}
							
							get_index_page();
							selected_page = "";
						} else 	get_dir_info(selected_dir);
					}
					else
					{
						alert("set_opt::error: 1");
					}
				}
			}
			lck7 = 0;
			loading_show(1,7);
			xmlhttp_setopt.send(null);
	
		}
		catch(e)
		{
			alert("set_opt::error: 2\n"+e);
		}
	}
}
////////////////////
function cc_menu(action,arg2)
{
	if(xmlhttp_setopt && lck8 == 1)
	{
		try
		{

		var tmparg = '';
		var url = '';
	
			switch(arg2)
			{
			case "dir":
				if(selected_dir)
				{
					url = '?action='+action+'&what='+selected_dir;
				} else return;
			break;
			case "page":
				if(selected_dir)
				{
					url = '?action='+action+'&what='+selected_page;
				} else return;
			break;
			case "move":
				if(selected_dir && selected_page)
				{
					url = '?action='+selected_page+'&selected='+selected_dir+'&what='+arg2;
				} else 
				{
					alert("Выберите каталог и страницу!");
				}
			break;
			case "cmt":
					url = '?action='+action+'&selected='+selected_dir+'&what='+arg2;
			break;
			case "index":
					url = '?action='+action+'&selected='+selected_index+'&what='+arg2;
			break;
			}
			

			if(action == 'del')
			{
				if(!confirm("Удалить?")) return;
			}
			

			xmlhttp_setopt.open("GET",'set_control_b.php'+url+'&'+get_sessn(),true);
			xmlhttp_setopt.onreadystatechange = function HRSC()
			{
				if(xmlhttp_setopt.readyState == 4)
				{
					loading_show(0,8);
					lck8=1;
					if(xmlhttp_setopt.status == 200)
					{
						var response = xmlhttp_setopt.responseText;
						
						
						clr();
						get_menu();
						
						if(selected_dir) 
						{
							get_pages(selected_dir);
						}
						
						get_index_page();
						selected_page = "";
					}
					else
					{
						alert("cc_menu::error: 1");
					}
				}
			}
			lck8=0;
			loading_show(1,8);
			xmlhttp_setopt.send(null);
	
		}
		catch(e)
		{
			alert("cc_menu::error: 2\n"+e);
		}
	}
}

function newedit()
{
	if(lck9==1 && newedit_m && newedit_p && ( document.getElementById("tab1-ln").value || document.getElementById("tab1-url").value || document.getElementById("tab2-nd").value || document.getElementById("tab3-ns").value) )
	{
		var url = "";
		switch(newedit_m)
		{
		
		case "edit":
			if(selected_dir)
			{
				if(setopt_umch == 1)
				{
					if(newedit_p == "link")
					{
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab1-ln").value+"&url="+document.getElementById("tab1-url").value+"&id="+selected_dir+"&umch=1";
					}
					
				}
				else
				{
					switch(newedit_p)
					{
					case "link":
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab1-ln").value+"&url="+document.getElementById("tab1-url").value+"&id="+selected_dir;
					break;
					case "section":
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab3-ns").value+"&id="+selected_dir;
					break;
					case "dir":
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab2-nd").value+"&id="+selected_dir;
					break;
					}
				}	
			} 
			else  
			{
				alert("Выберите в меню, то, что хотите изменить");
				return;
			}
		break;
		case "new":
				if(setopt_umch == 1)
				{
					if(newedit_p == "link")
					{
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab1-ln").value+"&url="+document.getElementById("tab1-url").value+"&id="+selected_dir+"&umch=1";
					}
					
				}
				else
				{
					switch(newedit_p)
					{
					case "link":
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab1-ln").value+"&url="+document.getElementById("tab1-url").value;
					break;
					case "section":
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab3-ns").value;
					break;
					case "dir":
						url = "m="+newedit_m+"&p="+newedit_p+"&name="+document.getElementById("tab2-nd").value;
					break;
					}
				}
		break;
		}
		
		
	url+='&'+get_sessn();	
	/////////////////////
	
	if(xmlhttp_newedit)
	{
		try
		{

			xmlhttp_newedit.open("POST",'set_newedit_m.php',true);
			xmlhttp_newedit.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_newedit.onreadystatechange = function HRSC() //Проверка состояния 3
			{
				if(xmlhttp_newedit.readyState == 4)
				{
					loading_show(0,9);
					lck9=1;
					if(xmlhttp_newedit.status == 200)
					{
			
						////
						clr();
						selected_page = "";
						selected_dir = "";
						////
						
						if(setopt_umch == 1)
						{
							get_menu('u');
						}
						else
						{
							get_menu();
						}
						////
						document.getElementById("chblock2").innerHTML = "";
						document.getElementById("tab1-ln").value = "";
						document.getElementById("tab1-url").value = "";
						document.getElementById("tab2-nd").value = "";
						document.getElementById("tab3-ns").value = "";
						
					}
					else
					{
						alert("newedit::error: 1");
					}
				}
			}
			lck9=0;
			loading_show(1,9);
			xmlhttp_newedit.send(url);
		}
		catch(e)
		{
			alert("newedit::error: 2\n"+e);
		}
	}

	
	} else return;
}
/////////////
function set_newpage()
{
	if(xmlhttp_newpage && lck10==1)
	{
		
		
	if((selected_page || selected_dir) && document.getElementById("txtar").value )
	{
		
		try
		{
		
			encH 			=	encodeURIComponent(document.getElementById("e-h").value.toString());
			encTxt			=	encodeURIComponent(document.getElementById("txtar").value.toString());
			encTitle		=	encodeURIComponent(document.getElementById("e-title").value.toString());
			encKeywords		=	encodeURIComponent(document.getElementById("e-keywords").value.toString());
			encDescription	=	encodeURIComponent(document.getElementById("e-description").value.toString());

		
			var url = "h="+encH+"&editor="+encTxt+"&title="+encTitle+"&keywords="+encKeywords+"&description="+encDescription+"&newmeta="+document.getElementById("ef-newmeta").checked.toString()+"&cmt="+document.getElementById("ef-cmt").checked.toString()+"&indexpage="+document.getElementById("ef-indexpage").checked.toString();
			
			if(selected_page)
			{
				
				url+="&selected="+selected_page;
				selected_page = null;
				
			} else {
				
				url+="&selected="+selected_dir;
				selected_dir = null;
			}
				
			url+='&'+get_sessn();

			xmlhttp_newpage.open("POST",'set_newpage.php',true);
			xmlhttp_newpage.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp_newpage.onreadystatechange = function HRSC()
			{
				if(xmlhttp_newpage.readyState == 4)
				{
					loading_show(0,10);
					lck10=1;
					if(xmlhttp_newpage.status == 200)
					{
						
						
						clr();
						
						selected_dir = selected_dir2;
						s_menu(selected_dir2);
						get_pages(selected_dir2);
						onsl();
						tb2(selected_dir2);
						get_dir_info(selected_dir2);
						
						////
						get_index_page();
						document.getElementById("chblock2").innerHTML = "";
					}
					else
					{
						alert("set_newpage::error: 1");
					}
				}
			}
			lck10=0;
			loading_show(1,10);
			xmlhttp_newpage.send(url);
	
		}
		catch(e)
		{
			alert("set_newpage::error: 2\n"+e);
		}
		
	} else alert("Текстовые поля, должны быть заполненными и необходимо выбрать каталог, в который добавится страница !");
	
	
	}
}

