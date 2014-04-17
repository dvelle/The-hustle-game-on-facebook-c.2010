<?

switch($_GET['page'])  {
	case '#home' : $page = '<b>Introduction</b><ul><li>History support, solved ajax Back Button limitation with jquery.history.js</li><li>Bookmark support. Using hash value to identify a specific page and load it</li><li>It\'s AJAX/AHAH! It\'s cool and cutting edge!</li><li>This tutorial can be used as a kickstart for your AJAX based web development project. Small ajax based content like autocomplete and check username are basically using the same concept.</li></ul><br/>'; break;

	case '#store' : $page = '<b>Portfolio</b><br/>You can put whatever you want. For advance programmers, you can create your own simple backend that store web pages, and then display it by using PHP to retrieve it from database. Also, you can integrate a Rich Text Editor for your backend too! I have made a post regarding <a href="http://www.queness.com/post/212/10-jquery-and-non-jquery-javascript-rich-text-editors">Rich Text Editor</a>.<br/><br/> Starting from a simple guideline, you can build your own Content Management System.'; break;

	case '#invite' : $page = '<b>About</b><br/>This is a simple AJAX-Based website created by Kevin from Queness.com. General speaking, we shouldn\'t call this as AJAX (Asynchronous Javascript and XML) because there is no XML data. Instead of AJAX, we should call it as AHAH.<br/><br/><b>Asychronous HTML and HTTP aka AHAH</b><br/>AHAH is a technique for dynamically updating web pages using JavaScript, involving usage of XMLHTTPRequest to retrieve (X)HTML fragments which are then inserted directly into the web page. Inspite of retreiving XML, AHAH stands for retreiving (X)HTML. It\'s a subset of AJAX.'; break;

	case '#inventory' : $page = '<b>Contact</b><br/>This form is just a demostration of what content you can put.<br/><br/><form>Name:<br/><input type="text"/><br/>Email:<br/><input type="text"/><br/>Message:<br/><textarea></textarea><br/><input type="button" value="Send"></form>'; break;

}

echo $page;
?>