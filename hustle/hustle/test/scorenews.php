<?php
include('../test/stats.php');

include('../test/connect.php');
		$conn = mysql_connect($dbhost,$dbuser,$dbpass)
			or die ('Error connecting to mysql');
		mysql_select_db($dbname);

//$user = $_POST['name'];
$user = "jermongreen";

$stack = array();
//Any score news?
$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') OR loser = ('%s')",
		mysql_real_escape_string($user),
		mysql_real_escape_string($user));
$result = mysql_query($query);
$news_ar = mysql_fetch_assoc($result);
//
if(is_array($news_ar)){
	$activity = "You have to play a game first!";// 2 no records
	//winning news? unfair
	$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') AND type = 'news'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You just defeated ".$user." at a game of".$gamename." playing".$fair.", Earning you $".$take." for your crew and $".$wages." for yourself and a ".$gain." of ".$coolp."Cool Points!";
	}
	//defeated news unfair
	$query = sprintf("SELECT * FROM h_user_news WHERE loser = ('%s') AND type = 'news'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You were just defeated by".$instigator." at a game of".$gamename." you played".$fair.", and they ".$did." You lost $".$take." for your crew and personally lost $".$wages." and a ".$gain." of ".$coolp."Cool Points...";
	}
	//challenge win fair
	$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') AND type = 'alert'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You just defeated ".$user." at a game of".$gamename." playing".$fair.", Earning you $".$take." for your crew and $".$wages." for yourself and a ".$gain." of ".$coolp."Cool Points!";
	}
	//new high score
	$query = sprintf("SELECT * FROM h_user_news WHERE winner = ('%s') AND type = 'gen'",
		mysql_real_escape_string($user));
	$result = mysql_query($query);
	$news_ar = mysql_fetch_assoc($result);
	while($news_ar = mysql_fetch_assoc($result)){
		echo "You played ".$gname." and scored ".$score." ".$err." and received a bonus of".$upgrade."plus $".$payout." but after your crew you have $".$left;
	}
}
?>