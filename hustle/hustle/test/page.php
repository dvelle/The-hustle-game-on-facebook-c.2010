<?php
session_start(); // necessary for getting/setting SESSION data

$energy = 1;
$cool_max = 2;
$cool = 3;
$energy_max = 4;
$cash = 5;
$token = 6;
$crew_rank = 7;
$stage = 8;
$l_label = 9;

$poller = json_encode(array(
  "username" => $cool,
  "msgCount" => $stage,
  "userHTML" => $token,
));
echo $poller
?>
