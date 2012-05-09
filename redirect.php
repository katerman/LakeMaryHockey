<html>
<head>
<?php 
@session_start(); 
if ($_SESSION["logged_in"] !== 1) { 


header("location:http://lmgtfy.com/?q=nice+try+bro".$row_rbs_redirect['redirect']);
exit();
  // or output an error message of your choice, then exit() 
} 
?> 
</head>
<body>
	<a href="addnews.php">Add News</a><br/>
	<a href="editnews.php">Edit News</a><br/>
	<a href="delete.php">Delete News</a><br/>
	<br/><br/>
	<a href="index.php">Home</a>
</body>
</html>


