<?
@session_start(); 
if ($_SESSION["logged_in"] !== 1) { 


header("location:http://lmgtfy.com/?q=nice+try+bro".$row_rbs_redirect['redirect']);
exit();
  // or output an error message of your choice, then exit() 
} 

//grabs the variables
$news = $_POST["news"];
$title = $_POST["title"];
//gets mysql info
include("dbconnect.php");
//gets the current date...
$date = date("j F");
$addnews =MYSQL_QUERY("INSERT INTO news (id,title,date,news)". "VALUES ('NULL', '$title', '$date', '$news')");
//success...
echo("News Added!");
?>


<br/>

	<a href="addnews.php">Add News</a><br/>
	<a href="editnews.php">Edit News</a><br/>
	<a href="index.php">Home</a><br/>
