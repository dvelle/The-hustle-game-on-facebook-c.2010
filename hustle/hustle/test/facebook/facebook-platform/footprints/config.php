<?php

// Get these from http://developers.facebook.com
$api_key = '2b154bd6f13c0d2e91ee4619514aeaf9';
$secret  = '7fc8a6d46f6e752178aa9c6f99d2cb3e';
/* While you're there, you'll also want to set up your callback url to the url
 * of the directory that contains Footprints' index.php, and you can set the
 * framed page URL to whatever you want.  You should also swap the references
 * in the code from http://apps.facebook.com/footprints/ to your framed page URL. */

// The IP address of your database
$db_ip = '97.74.149.20';           

$db_user = 'btr_the_hunt';
$db_pass = 'Jgreen87!';

// the name of the database that you create for footprints.
$db_name = 'btr_the_hunt';

/* create this table on the database:
CREATE TABLE `footprints` (
  `from` int(11) NOT NULL default '0',
  `to` int(11) NOT NULL default '0',
  `time` int(11) NOT NULL default '0',
  KEY `from` (`from`),
  KEY `to` (`to`)
)
*/
