var options = {
	script:"autocompletador.php?json=true&limit=6&",
	varname:"input",
	json:true,
	shownoresults:false,
	maxresults:6,
	callback: function (obj) { document.getElementById('testid').value = obj.id; }
};
var as_json = new bsn.AutoSuggest('provincia', options);
	
	
var options_xml = {
	script: function (input) { return "autocompletador.php?input="+input+"&testid="+document.getElementById('provincia').value; },
	varname:"input"
};
var as_xml = new bsn.AutoSuggest('testinput_xml', options_xml);
