var f = true;
function press_b()
{
f = !f;
var cmed_main = document.getElementById('cmed_main');
var cmed_button = document.getElementById('cmed_button');
		
	if(f == true) 
	{
		cmed_main.style.display = "none";
		cmed_button.className="cmed_button_2";
	}
	else 
	{
		cmed_main.style.display = "block";
		cmed_button.className="cmed_button_1";
	}
}
function b()
{
	document.getElementById('cmed_textarea').value+="[b][/b]";	
	word_count();
}
function em()
{
	document.getElementById('cmed_textarea').value+="[em][/em]";	
	word_count();
}
function strike()
{
	document.getElementById('cmed_textarea').value+="[s][/s]";	
	word_count();
}
function quote(nameid)
{
	if(nameid) 
	{	
		var sq = document.getElementById('ncmt_cmt_'+nameid).innerHTML;
		var sn = document.getElementById('ncmt_name_'+nameid).innerHTML;
		sq 	= sq.replace(/<\/?[^>]+>/gi, '');  
		sq	= '[quote]'+'\n'+sn+sq+'\n'+'[/quote]';
		document.getElementById('cmed_textarea').value+=sq;
		word_count();
	}
	else
	{
		document.getElementById('cmed_textarea').value+="[quote][/quote]";	
		word_count();
	}
}
function url()
{
	var link = prompt('Ссылка:','http://');
	if(link)
	{
		document.getElementById('cmed_textarea').value+='[URL='+link+']'+link+'[/URL]';
		word_count();
	}
}
function word_count()
{
	var txt1 = document.getElementById("cmed_textarea").value;
	var txt2 = document.getElementById("cmed_input").value;
	var txt4 = document.getElementById("cmed_cpt_input").value;
	txt3=txt1+txt2;
	if(txt1.length == 0 || txt2.length == 0 || txt4.length == 0 || txt3.length >= 3001) {document.getElementById("cmed_submit").disabled=true;}
	else {document.getElementById("cmed_submit").disabled=false;}
	document.getElementById("cmed_count").innerHTML=txt3.length + "/3000";
}
var updimg=1;
function upd_cpt() {
	updimg++;
	document.getElementById("cmed_captcha").src="captcha.php?updimg="+updimg;
}