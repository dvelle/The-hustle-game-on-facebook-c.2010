<?php
require_once( 'configure/config.php' );



if($running_mode == 'host')
{
	$urlinfo = getHostParameters($host_address);
	$swfname = basename($urlinfo['path']);   
	parse_str($urlinfo['query']);
}


$width = "100%";
$height = "100%";
$user = '';

if(is_file("api/Api_user_session.php")&& $running_mode != 'free')
{
   require_once("api/Api_user_session.php");
   if(!empty($username)&&!empty($password))
   {
  	 $user = "&init_user=".rawurlencode($username)."&init_password=".$password;
   
   }

}

switch($running_mode)
{
	case 'free':
		chat_free();
		break;
	case 'host':
		show_chat();
		break;
	case 'local':
		show_chat();
		break;
	default:
	     echo '<script>window.location.href("index.php");</script>';
		 exit;break;
}




function chat_free()
{
	global $room_name,$width,$height;
	
	echo pageheader();
	echo '<!-- FROM 123FLASHCHAT CODE BEGIN -->

<div id="topcmm_123flashchat" style="width:728px;height:20;margin:0">
<table width="728">
<tr>
<td  class="menu" align="right"><a href="http://www.123flashchat.com/" target="_blank">flash chat</a> | 
<a href="http://www.123flashchat.com/" target="_blank">chat software</a>
</tr></table>
</div>
<script language="javascript" src="http://free.123flashchat.com/js.php?room='.rawurlencode($room_name).'&width=728&height=500"></script>

	<!-- 123FLASHCHAT CHAT ROOM CODE END -->';
	echo pagefooter();
}


function show_chat()
{
	global $swfname,$init_host,$init_port,$init_group,$width,$height,$host_address,$user,$running_mode;
	
	
	if($running_mode == 'host')
	{
		$client_location = checkSlash($host_address);
			
		$swfurl = $client_location.$swfname;
	
		if(!empty($init_host)){
			$swfurl .= (strpos($swfurl,"?"))?"&init_host=".$init_host:"?init_host=".$init_host;
		}
		if(!empty($init_port)){
			$swfurl .= (strpos($swfurl,"?"))?"&init_port=".$init_port:"?init_port=".$init_port;
		}
		if(!empty($init_group)){
			$swfurl .= (strpos($swfurl,"?"))?"&init_group=".$init_group:"?init_host=".$init_group;
		}
		
		}else if($running_mode == 'local'){
		
		   if(file_exists('client/123flashchat.swf')){
		   
		   	$php_self= str_replace('123flashchat.php','',$_SERVER['PHP_SELF']);
        	$client_url = 'http://'.$_SERVER['HTTP_HOST'].$php_self;
			$swfurl = $client_url.'client/123flashchat.swf?init_group=default';
		   }else {
			echo 'not find client folder';
			exit;
			}
     	}
	
	
		$swfurl .= $user;


		echo pageheader();
		echo '<!-- FROM 123FLASHCHAT CODE BEGIN --><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="100%" height="100%">';
		echo '<param name=movie value="'.$swfurl.'">';
		echo '<param name=quality value=high>' ;
		echo '<param name=menu value=false>';
		echo '<param name=scale value=noscale>';
		echo '<param name="allowScriptAccess" value="always" />';
		echo '<embed src="'.$swfurl.'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="100%" height="100%" menu="false" scale="noscale" allowScriptAccess="always">';
		echo '</embed>';
		echo '</object><!-- 123FLASHCHAT CODE END -->';
		echo pagefooter();
	}

function getHostParameters($client_location)
{
	$content = @file_get_contents($client_location);
	if(!empty($content))
	{
		$pattern = '|var urlValue="(.*)"|U';
		preg_match($pattern, $content, $matches);
		if(!empty($matches[1]))
		{
			$url = $matches[1];
			$urlinfo = parse_url($url);
			return $urlinfo;
		}
		else
		{
			$pattern = '|PARAM NAME=movie VALUE="(.*)"|U';
			preg_match($pattern, $content, $matches);
			if(!empty($matches[1]))
			{
				$url = $matches[1];
				$urlinfo = parse_url($url);
				return $urlinfo;
			}
		}
		return false;
	}
}


function checkSlash($path)
{
		if(substr($path,-1,1) != "/" && !empty($path)){
			$path = $path."/";
		}
		return $path;
}

function pageheader()
{
      global $running_mode;
		echo '<html>';
		echo '<head>';
		echo '<title>Chat Room - Powered by 123FlashChat</title>';
		echo '</head>';
		if($running_mode=='free')
		echo '<link rel="stylesheet" type="text/css" media="screen" href="http://www.123flashchat.com/stylesheet22.css" />';
		echo '<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" scroll="no">';
}

function pagefooter()
{
		echo '</body>';
		echo '</html>';
}
?>