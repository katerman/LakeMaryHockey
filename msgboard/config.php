<?
//config file

if ('config.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Do not load this page directly');

$host = "mysql15.000webhost.com";
//$host = "yourserver.net";
$username = "a4610366_admin"; //username for database here
$password = "halo12"; //password for database here
$database =  "a4610366_board"; //name of your database here

$limit = 5; //entries displayed per page
$badwords = array("fuck","bitch","cunt");  //add more bad words here

$mysql_link = mysql_pconnect($host, $username, $password) 
               or die( "Unable to connect to SQL server"); 
mysql_select_db( "$database") or die( "Unable to select database"); 

//error_reporting(E_ALL ^ E_NOTICE);

?>