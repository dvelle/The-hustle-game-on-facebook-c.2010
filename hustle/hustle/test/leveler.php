<?php

function leveler($cool){
		if($cool <= 9){
		  $stage=1;
		  $l_label="Initiate";
		  $array = array($stage,$l_label);
		  setStat('exp_rem',$userID,'9');
		  return $array;
		} elseif($cool <= 19){
		  $stage=2;
		  $l_label="Initiate";
		  setStat('exp_rem',$userID,'19');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 29){
		  $stage=3;
		  $l_label="Initiate";
		  setStat('exp_rem',$userID,'29');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 40){
		  $stage=4;
		  $l_label="Newbie";
		  setStat('exp_rem',$userID,'40');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 59){
		  $stage=5;
		  $l_label="Newbie";
		  setStat('exp_rem',$userID,'59');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 92){
		  $stage=6;
		  $l_label="Newbie";
		  setStat('exp_rem',$userID,'92');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 155){
		  $stage=7;
		  $l_label="Bum";
		  setStat('exp_rem',$userID,'155');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 240){
		  $stage=8;
		  $l_label="Bum";
		  setStat('exp_rem',$userID,'240');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 350){
		  $stage=9;
		  $l_label="Bum";
		  setStat('exp_rem',$userID,'350');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 500){
		  $stage=10;
		  $l_label="Mooch";
		  setStat('exp_rem',$userID,'500');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 670){
		  $stage=11;
		  $l_label="Mooch";
		  setStat('exp_rem',$userID,'670');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 880){
		  $stage=12;
		  $l_label="Mooch";
		  setStat('exp_rem',$userID,'880');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 1105){
		  $stage=13;
		  $l_label="Drifter";
		  setStat('exp_rem',$userID,'1105');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 1225){
		  $stage=14;
		  $l_label="Drifter";
		  setStat('exp_rem',$userID,'1225');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 1795){
		  $stage=15;
		  $l_label="Drifter";
		  setStat('exp_rem',$userID,'1795');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 2257){
		  $stage=16;
		  $l_label="Hoodlum";
		  setStat('exp_rem',$userID,'2257');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 2500){
		  $stage=17;
		  $l_label="Hoodlum";
		  setStat('exp_rem',$userID,'2500');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 2757){
		  $stage=18;
		  $l_label="Hoodlum";
		  setStat('exp_rem',$userID,'2757');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 3025){
		  $stage=19;
		  $l_label="Con Artist";
		  setStat('exp_rem',$userID,'3025');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 3307){
		  $stage=20;
		  $l_label="Con Artist";
		  setStat('exp_rem',$userID,'3307');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 3600){
		  $stage=21;
		  $l_label="Con Artist";
		  setStat('exp_rem',$userID,'3600');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 3907){
		  $stage=22;
		  $l_label="Drifter";
		  setStat('exp_rem',$userID,'3907');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 4225){
		  $stage=23;
		  $l_label="Drifter";
		  setStat('exp_rem',$userID,'4225');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 4557){
		  $stage=24;
		  $l_label="Drifter";
		  setStat('exp_rem',$userID,'4557');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 4900){
		  $stage=25;
		  $l_label="Thug";
		  setStat('exp_rem',$userID,'4900');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 5257){
		  $stage=26;
		  $l_label="Thug";
		  setStat('exp_rem',$userID,'5257');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 5625){
		  $stage=27;
		  $l_label="Thug";
		  setStat('exp_rem',$userID,'5625');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 6007){
		  $stage=28;
		  $l_label="Hustler";
		  setStat('exp_rem',$userID,'6007');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 6400){
		  $stage=29;
		  $l_label="Hustler";
		  setStat('exp_rem',$userID,'6400');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 6807){
		  $stage=30;
		  $l_label="Hustler";
		  setStat('exp_rem',$userID,'6807');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 7225){
		  $stage=31;
		  $l_label="Rank Amateur";
		  setStat('exp_rem',$userID,'7225');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 7657){
		  $stage=32;
		  $l_label="Rank Amateur";
		  setStat('exp_rem',$userID,'7657');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 8100){
		  $stage=33;
		  $l_label="Rank Amateur";
		  setStat('exp_rem',$userID,'8100');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 8857){
		  $stage=34;
		  $l_label="Novice";
		  setStat('exp_rem',$userID,'8857');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 9025){
		  $stage=35;
		  $l_label="Novice";
		  setStat('exp_rem',$userID,'9025');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 9507){
		  $stage=36;
		  $l_label="Novice";
		  setStat('exp_rem',$userID,'9507');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 10000){
		  $stage=37;
		  $l_label="Amatuer";
		  setStat('exp_rem',$userID,'10000');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 10507){
		  $stage=38;
		  $l_label="Amateur";
		  setStat('exp_rem',$userID,'10507');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 11025){
		  $stage=39;
		  $l_label="Amateur";
		  setStat('exp_rem',$userID,'11025');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 11557){
		  $stage=40;
		  $l_label="Pro";
		  setStat('exp_rem',$userID,'11557');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 12100){
		  $stage=41;
		  $l_label="Pro";
		  setStat('exp_rem',$userID,'12100');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 12657){
		  $stage=42;
		  $l_label="Pro";
		  setStat('exp_rem',$userID,'12657');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 13225){
		  $stage=43;
		  $l_label="Expert";
		  setStat('exp_rem',$userID,'13225');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 13807){
		  $stage=44;
		  $l_label="Expert";
		  setStat('exp_rem',$userID,'13807');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 14400){
		  $stage=45;
		  $l_label="Expert";
		  setStat('exp_rem',$userID,'14400');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 15007){
		  $stage=46;
		  $l_label="UpStart";
		  setStat('exp_rem',$userID,'15007');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 15625){
		  $stage=47;
		  $l_label="UpStart";
		  setStat('exp_rem',$userID,'15625');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 16257){
		  $stage=48;
		  $l_label="Upstart";
		  setStat('exp_rem',$userID,'16257');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 16900){
		  $stage=49;
		  $l_label="Lord";
		  setStat('exp_rem',$userID,'16900');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 17557){
		  $stage=50;
		  $l_label="Lord";
		  setStat('exp_rem',$userID,'17557');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 18225){
		  $stage=51;
		  $l_label="Lord";
		  setStat('exp_rem',$userID,'18225');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 18907){
		  $stage=52;
		  $l_label="Baron";
		  setStat('exp_rem',$userID,'18907');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 19600){
		  $stage=53;
		  $l_label="Baron";
		  setStat('exp_rem',$userID,'19600');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 20307){
		  $stage=54;
		  $l_label="Baron";
		  setStat('exp_rem',$userID,'20307');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 21025){
		  $stage=55;
		  $l_label="Gangster";
		  setStat('exp_rem',$userID,'21025');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 21757){
		  $stage=56;
		  $l_label="Gangster";
		  setStat('exp_rem',$userID,'21757');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 22500){
		  $stage=57;
		  $l_label="Gangster";
		  setStat('exp_rem',$userID,'22500');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 23257){
		  $stage=58;
		  $l_label="Made-Man";
		  setStat('exp_rem',$userID,'23257');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 24025){
		  $stage=59;
		  $l_label="Made-man";
		  setStat('exp_rem',$userID,'24025');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 24807){
		  $stage=60;
		  $l_label="Made-Man";
		  setStat('exp_rem',$userID,'24807');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 25600){
		  $stage=61;
		  $l_label="Captain";
		  setStat('exp_rem',$userID,'25600');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 26407){
		  $stage=62;
		  $l_label="Captain";
		  setStat('exp_rem',$userID,'26407');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 27225){
		  $stage=63;
		  $l_label="Captain";
		  setStat('exp_rem',$userID,'27225');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 28057){
		  $stage=64;
		  $l_label="General";
		  setStat('exp_rem',$userID,'28057');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 28900){
		  $stage=65;
		  $l_label="General";
		  setStat('exp_rem',$userID,'28900');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 29757){
		  $stage=66;
		  $l_label="General";
		  setStat('exp_rem',$userID,'29757');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 30625){
		  $stage=67;
		  $l_label="Boss";
		  setStat('exp_rem',$userID,'30625');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 31507){
		  $stage=68;
		  $l_label="Boss";
		  setStat('exp_rem',$userID,'31507');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 32400){
		  $stage=69;
		  $l_label="Boss";
		  setStat('exp_rem',$userID,'32400');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 33387){
		  $stage=70;
		  $l_label="Lower Boss";
		  setStat('exp_rem',$userID,'33387');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 34225){
		  $stage=71;
		  $l_label="Lower Boss";
		  setStat('exp_rem',$userID,'34225');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 35157){
		  $stage=72;
		  $l_label="Lower Boss";
		  setStat('exp_rem',$userID,'35157');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 36100){
		  $stage=73;
		  $l_label="Chief";
		  setStat('exp_rem',$userID,'36100');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 37057){
		  $stage=74;
		  $l_label="Chief";
		  setStat('exp_rem',$userID,'37057');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 38025){
		  $stage=75;
		  $l_label="Chief";
		  setStat('exp_rem',$userID,'38025');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 39007){
		  $stage=76;
		  $l_label="Upper Boss";
		  setStat('exp_rem',$userID,'39007');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 40000){
		  $stage=77;
		  $l_label="Upper Boss";
		  setStat('exp_rem',$userID,'40000');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 41007){
		  $stage=78;
		  $l_label="Upper Boss";
		  setStat('exp_rem',$userID,'41007');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 42025){
		  $stage=79;
		  $l_label="Mastermind";
		  setStat('exp_rem',$userID,'42025');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 43057){
		  $stage=80;
		  $l_label="Mastermind";
		  setStat('exp_rem',$userID,'43057');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 44100){
		  $stage=81;
		  $l_label="Mastermind";
		  setStat('exp_rem',$userID,'44100');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif($cool <= 52000){
		  $stage=82;
		  $l_label="Mogul";
		  setStat('exp_rem',$userID,'52000');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 54000){
		  $stage=83;
		  $l_label="Mogul";
		  setStat('exp_rem',$userID,'54000');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 56000){
		  $stage=84;
		  $l_label="Mogul";
		  setStat('exp_rem',$userID,'56000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 59000){
		  $stage=85;
		  $l_label="OverLord";
		  setStat('exp_rem',$userID,'59000');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 62000){
		  $stage=86;
		  $l_label="OverLord";
		  setStat('exp_rem',$userID,'62000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 67575){
		  $stage=87;
		  $l_label="OverLord";
		  setStat('exp_rem',$userID,'67575');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 78431){
		  $stage=88;
		  $l_label="Kingpin";
		  setStat('exp_rem',$userID,'78431');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 86995){
		  $stage=89;
		  $l_label="Kingpin";
		  setStat('exp_rem',$userID,'86995');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 100000){
		  $stage=90;
		  $l_label="Kingpin";
		  setStat('exp_rem',$userID,'100000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 110000){
		  $stage=91;
		  $l_label="King";
		  setStat('exp_rem',$userID,'110000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 120765){
		  $stage=92;
		  $l_label="King";
		  setStat('exp_rem',$userID,'120765');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 140900){
		  $stage=93;
		  $l_label="King";
		  setStat('exp_rem',$userID,'140900');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 240000){
		  $stage=94;
		  $l_label="Juggernaut";
		  setStat('exp_rem',$userID,'240000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 340000){
		  $stage=95;
		  $l_label="Juggernaut";
		  setStat('exp_rem',$userID,'340000');
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 567000){
		  $stage=96;
		  $l_label="Juggernaut";
		  setStat('exp_rem',$userID,'567000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 798000){
		  $stage=97;
		  $l_label="Don";
		  setStat('exp_rem',$userID,'798000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		} elseif ($cool <= 899000){
		  $stage=98;
		  $l_label="Don";
		  setStat('exp_rem',$userID,'899000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;  
		} elseif ($cool <= 1000000){
		  $stage=99;
		  $l_label="Don";
		  setStat('exp_rem',$userID,'1000000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array;
		 } elseif ($cool <= 5000000){
		  $stage=100;
		  $l_label="Alien";
		  setStat('exp_rem',$userID,'5000000');
		  setStat('ep_rem',$userID,$energy_max);
		  $array = array($stage,$l_label);
		  return $array; 
		}else {
		  echo "err";
		}
}
?>