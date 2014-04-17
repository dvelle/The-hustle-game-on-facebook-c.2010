$(function() {  
  $('.error').hide();  
  $(".button").click(function() {  
    // validate and process form here  
  
    $('.error').hide();  
      var user = $("input#instigator").val();  
        
      var target = $("input#target").val();  
        
      var shortname = $("input#game").val(); 
	  
	  var wager = $("input#wager").val();  
        
      var style = $("input#radio").val();  
        
  
  });
  
  var dataString = 'instigator='+ user + '&target=' + target + '&game=' + shortname + '&wager=' + wager + '&radio=' + style;
  //alert (dataString);return false;
  $.getJSON("test.js", { data: dataString}, function(json){
    alert("JSON Data: " + json.file);
															   });
  return false;
  
  
});  
