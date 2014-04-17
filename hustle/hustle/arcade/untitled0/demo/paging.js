$(document).ready(function(){
	//References
	var pages = $("#menu li");
	var loading = $("#loading");
	var content = $("#content");
	
	//show loading bar
	function showLoading(){
		loading
			.css({visibility:"visible"})
			.css({opacity:"1"})
			.css({display:"block"})
		;
	}
	//hide loading bar
	function hideLoading(){
		loading.fadeTo(1000, 0);
	};
	

	//Manage click events
	pages.click(function(){
		//show the loading bar
		showLoading();
		
		//Highlight current page number
		pages.css({'background-color' : ''});
		$(this).css({'background-color' : 'yellow'});

		//Load content
		var pageNum = this.id;
		var targetUrl = "content.php?page=" + pageNum + "&" + $("#myForm").serialize() + " #content";
		content.load(targetUrl, hideLoading);
	});
	
	//default - 1st page
	$("#1").css({'background-color' : 'yellow'});
	var targetUrl = "content.php?page=1&" + $("#myForm").serialize() + " #content";
	showLoading();
	content.load(targetUrl, hideLoading);
});