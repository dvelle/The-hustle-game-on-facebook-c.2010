<?
$f=$_GET['l'].".dat";
$q=$_GET['r'];
if ( $f == ".dat" ) 
$f="VH.dat";
$fd=fopen($f,'r');
$x=0;
while (!feof($fd) && ($x!=$q) ) 
{
$x++;
$ret=fgets($fd);
}
fclose($fd);
$ret=trim($ret)."&eof";
echo $ret;
?>
