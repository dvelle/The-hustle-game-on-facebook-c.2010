$(document).ready(function(){
	//References
	var sections = $("#menu li");
	var loading = $("#loading");
	var content = $("#content");
	
	//Manage click events
	sections.click(function(){
		//show the loading bar
		showLoading();
		//load selected section
		switch(this.id){
			case "home":
				content.slideUp();
				content.load("sections.html #section_home", hideLoading);
				content.slideDown();
				break;
			case "news":
				content.slideUp();
				content.load("sections.html #section_news", hideLoading);
				content.slideDown();
				break;
			case "interviews":
				content.slideUp();
				content.load("sections.html #section_interviews", hideLoading);
				content.slideDown();
				break;
			case "external":
				content.slideUp();
				content.load("external.html", hideLoading);
				content.slideDown();
				break;
			default:
				//hide loading bar if there is no selected section
				hideLoading();
				break;
		}
	});

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
});