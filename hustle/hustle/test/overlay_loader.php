<?
$call = $_REQUEST['page'];

switch($call)  {
	case 'carlot' : $page = '<img src="../file/graphics/car_list.jpg" />'; break;
	
	case 'arcadehus' : $page = '<img src="../file/graphics/doing.jpg" />'; break;
	
	case 'bankcheckin' : $page = '<img src="../file/graphics/bankjob_recruit.jpg" />'; break;
	
	case 'bankboss' : $page = '<img src="../file/graphics/bankjob_header.jpg" />'; break;
	
	case 'bankwho' : $page = '<img src="../file/graphics/bankjob_who.jpg" />'; break;
	
	case 'junkieopt' : $page = '<img src="../file/graphics/options.jpg" />'; break;
	
	case 'diner' : $page = '<img src="../file/graphics/diner_menu.jpg" />'; break;
	
	case 'gotbribe' : $page = '<img src="http://www.12daysoffun.com/hustle/hustle/file/pic/fbimages/easter/show_bribe.png" />'; break;
	
	case 'caroffer' : $page = '<img src="http://www.12daysoffun.com/hustle/hustle/file/pic/fbimages/easter/prem_info.png" />'; break;
	
	case 'federal' : $page = '<img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/investigation.png" />'; break;
	
	case 'stopcop' : $page = '<img src="../file/pic/fbimages/drop.png" width="323" height="212" />'; break;
	
	case 'snitch' : $page = '<img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/snitchers.png" />'; break;
	
	case 'clubbuy' : $page = '<img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/club_info.png" />'; break;
	
	case 'entercasino' : $page = '<img src="../graphics/casino_enter.png" width="323" height="217" />'; break;
	
	case 'casinobuy' : $page = '<img src="http://www.12daysoffun.com/hustle/file/pic/fbimages/casino_info.png" />'; break;
	
	case 'dealerinfo' : $page = '<img id="task_n" src="http://www.12daysoffun.com/hustle/graphics/dealer_info.png" />'; break;
	
	case 'crook' : $page = '<img id="task_n" src="http://www.12daysoffun.com/hustle/graphics/new_criminal.png" />'; break;
	
	case 'cop' : $page = '<img src="http://www.12daysoffun.com/hustle/graphics/new_recruit.png" />'; break;
}

echo $page;
?>