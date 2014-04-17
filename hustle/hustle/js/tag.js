$(function () {
			
	    $.history.init(pageload);
	    
		$('a[href=' + window.location.hash + ']').addClass('selected');
		
		$('a[rel=ajax]').click(function () {
		
			var hash = this.href;
			hash = hash.replace(/^.*#/, '');
	 		$.history.load(hash);	
	 		
	 		$('a[rel=ajax]').removeClass('selected');
	 		$(this).addClass('selected');
	 		$('#body').hide();
	 		$('.loading').show();
	 		
			getPage();
			earners();
	
			return false;
		});	
		
	});
	
	function pageload(hash) {
		if (hash) getPage();    
	}
		
	function getPage() {
		var data = 'page=' + encodeURIComponent(document.location.hash);
		$.ajax({
			url: "loader.php",	
			type: "GET",		
			data: data,		
			cache: false,
			success: function (html) {	
				$('.loading').hide();
				$('#content').html(html);
				$('#body').fadeIn('slow');
		
			}		
		});
	}
	
		
	
	function earners(){
		$.post("smgtrack_ajax.php", {data: htmlStr}, function(results) {
											 var user_cash_cow = results.cash_cow;
											 var user_cow_earns = results.cow_earns;
											 var user_drain = results.cash_drain;
											 var user_drain_losses = results.drain_loss;
									 $('#cash_cow').append('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_cash_cow + '"/>');
									 $('#profits').append(user_cow_earns);
									 $('#drain').append('<img src=" http://www.12daysoffun.com/hustle/file/pic/user/' + user_drain + '"/>');
									 $('#losses').append(user_drain_losses);
									 
									}, "json");
	}