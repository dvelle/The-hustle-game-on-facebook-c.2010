<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js" type="text/javascript"></script>
            
<style type="text/css">
<!--
#practice_button {
	position:absolute;
	width:200px;
	height:171px;
	z-index:3;
	left: 198px;
	top: 336px;
}

#fight_button {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 167px;
	top: 288px;
}
#inv_muscle {
	position:absolute;
	width:169px;
	height:106px;
	z-index:4;
	left: 9px;
	top: 404px;
}
#inventory_button {
	position:absolute;
	width:148px;
	height:69px;
	z-index:5;
	left: 162px;
	top: 442px;
}
#rroffice {
	position:absolute;
	width:110px;
	height:97px;
	z-index:6;
	left: 593px;
	top: 411px;
}
#mall {
	position:absolute;
	width:88px;
	height:58px;
	z-index:7;
	left: 672px;
	top: 453px;
}
#stats {
	position:absolute;
	width:187px;
	height:74px;
	z-index:8;
	left: 12px;
	top: 19px;
}
#apDiv1 {
	position:absolute;
	width:273px;
	height:206px;
	z-index:2;
	left: 198px;
	top: 302px;
}
#apDiv2 {
	position:absolute;
	width:561px;
	height:241px;
	z-index:1;
	left: 198px;
	top: 262px;
}
#apDiv3 {
	position:absolute;
	width:130px;
	height:115px;
	z-index:4;
	left: 169px;
	top: 383px;
}
#apDiv4 {
	position:absolute;
	width:160px;
	height:158px;
	z-index:3;
	left: 10px;
	top: 350px;
}
#crews {
	position:absolute;
	width:200px;
	height:63px;
	z-index:9;
	left: 444px;
	top: 448px;
}
#apDiv5 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:8;
	left: 443px;
	top: 379px;
}
#apDiv6 {
	position:absolute;
	width:107px;
	height:145px;
	z-index:5;
	left: 575px;
	top: 363px;
}
#apDiv7 {
	position:absolute;
	width:90px;
	height:71px;
	z-index:7;
	left: 669px;
	top: 437px;
}
#footer {
	background-image: url(graphics/hustle_bk_3.png);
	background-repeat: no-repeat;
	height: 97px;
}
#boards {
	position:absolute;
	width:200px;
	height:115px;
	z-index:0;
	left: 57px;
	top: 309px;
}
-->
</style>
</head>

<body>
<script>
jQuery(function() {				
			$('#practice_button').css('cursor','pointer');
			$('#fight_button').css('cursor','pointer');
			$('#inventory_butt').css('cursor','pointer');
			$('#crews').css('cursor','pointer');
			$('#boards').css('cursor','pointer');
			$('#inv_muscle').css('cursor','pointer');
			$('#mall').css('cursor','pointer');
			$('#rroffice').css('cursor','pointer');
			
			$("#practice_button").hover(
				  function () {
					$("#title").css("display","block");
				  }, 
				  function () {
					$("#title").css("display","none");
				  }
				);
			$("#fight_button").hover(
				  function () {
					$("#fight_title").css("display","block");
				  }, 
				  function () {
					$("#fight_title").css("display","none");
				  }
				);
			$("#inventory_button").hover(
				  function () {
					$("#gun_title").css("display","block");
				  }, 
				  function () {
					$("#gun_title").css("display","none");
				  }
				);
			$("#inv_muscle").hover(
				  function () {
					$("#muscle_title").css("display","block");
				  }, 
				  function () {
					$("#muscle_title").css("display","none");
				  }
				);
			$("#crews").hover(
				  function () {
					$("#recruiters").css("display","block");
				  }, 
				  function () {
					$("#recruiters").css("display","none");
				  }
				);
			$("#rroffice").hover(
				  function () {
					$("#deed").css("display","block");
				  }, 
				  function () {
					$("#deed").css("display","none");
				  }
				);
			$("#mall").hover(
				  function () {
					$("#cheats").css("display","block");
				  }, 
				  function () {
					$("#cheats").css("display","none");
				  }
				);
			});
</script>
<div id="footer"></div>          
<div id="content">
<img src="graphics/new_back.png" width="749" height="404" />
<div id="stats">
  <td width="341" style="background-color:#000"><img src="graphics/the_hustle_logo.png" width="232" height="66" /></td>
</div>

<div id="apDiv1"><span id="title" style="display:none"><img src="graphics/arcade_gif.png"/></span></div>
<div id="apDiv2"><span id="fight_title" style="display:none"><img src="graphics/coliseum_title.png"/></span></div>
<div id="apDiv3"><span id="gun_title" style="display:none"><img src="graphics/gunshop_title.png"/></span></div>
<div id="apDiv4"><span id="muscle_title" style="display:none"><img src="graphics/securityoffice_title.png"/></span></div>
<div id="apDiv5"><span id="recruiters" style="display:none"><img src="graphics/recruit_title.png"/></span></div>
<div id="apDiv6"><span id="deed" style="display:none"><img src="graphics/realtor_title.png"/></span></div>
<div id="apDiv7"><span id="cheats" style="display:none"><img src="graphics/store_title.png"/></span></div>
<div id="practice_button"><img src="graphics/arcade_hall_bk.png" width="272" height="174" /></div>
<div id="fight_button"><img src="graphics/coliseum_bk.png" width="590" height="220" /></div>
<div id="inv_muscle"><img src="graphics/securityoffice_bk.png" width="165" height="105" /></div>
<div id="inventory_button"><img src="graphics/gunshop_bk.png" width="145" height="68" /></div>
<div id="rroffice"><img src="graphics/recruit_realtor_bk.png" width="110" height="97" /></div>
<div id="mall"><img src="graphics/store_office_bk.png" width="81" height="52" /></div>
</div>
<div id="crews"><img src="graphics/recruit_bk.png" width="198" height="64" /></div>
<div id="boards"><img src="graphics/billboard_bk.png" width="229" height="156" /></div>
</body>
</html>
