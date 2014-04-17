//Global vars to hold connection to web pages
var xmlHttp
var xmlHttp2

function showPage(str) { 
	//Function that gets called
	//Currently we only call one other sub, but this could change
	showStates(str)
}

function showStates(str) { 
	//This sub will populate a table with all the states and get the 
	//pagination built
	
	//Make the AJAX connection for both the navigation and content
	xmlHttp=GetXmlHttpObject()
	xmlHttp2=GetXmlHttpObject()
	
	//If we cant do the request error out
	if (xmlHttp==null || xmlHttp2==null ) {
	 	alert ("Browser does not support HTTP Request")
	 	return
	}
		
	//First build the navigation panel
	var url="getarcade.php"
	url=url+"?p="+str
	url=url+"&t=nav"
	url=url+"&sid="+Math.random()

	//Once the page finished loading put it into the div
	xmlHttp2.onreadystatechange=navDone 

	//Get the php page
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)
	
	//Build the url to call
	//Pass variables through the url
	var url="getarcade.php"
	url=url+"?p="+str
	url=url+"&t=con"
	url=url+"&sid="+Math.random()
	
	//Once the page finished loading put it into the div
	xmlHttp.onreadystatechange=stateChanged 
	
	//Get the php page
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}

function navDone() { 
	//IF this is getting called when the page is done loading then fill the pagination div
	if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete") { 
	 	//Update the Div tag with the outputted text
	 	document.getElementById("pgNavigation").innerHTML=xmlHttp2.responseText 
	} 
}

function stateChanged() { 
	//IF this is getting called when the page is done loading the states then output the div
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") { 
	 	//Update the Div tag with the outputted text
	 	document.getElementById("pgContent").innerHTML=xmlHttp.responseText 
	} 
}

function GetXmlHttpObject() {
	//Determine what browser we are on and make a httprequest connection for ajax
	var xmlHttp=null;

	try {
	 	// Firefox, Opera 8.0+, Safari
	 	xmlHttp=new XMLHttpRequest();
	}
	catch (e) {
	 	//Internet Explorer
	 	try {
	  		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	  	}
	 	catch (e) {
	  		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	  	}
	}
	
	return xmlHttp;
}

function plusOne() {
	//This is just a second counter to prove that we arent refreshing 
	// If using the content ('childNode') of an id element...
	var spanEl = document.getElementById('spanEl');
	spanEl.childNodes[0].nodeValue = ( parseInt(spanEl.childNodes[0].nodeValue) + 1 );
}

//Creates a timer 
var stop = setInterval("plusOne()",1000);

//Starts the counter
window.onload = plusOne;

//Onload start the user off on page one
window.onload = showPage("1");