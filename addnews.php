

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
	<form action="submit.php" method="post">
	<b>Title</b>
	<BR />
	<input type="text" name="title" size="40" maxlength="80" value="" />
	<br />
	<br />
	<b>News</b><BR><textarea name="news" rows="3" cols="40"></textarea>
	<br />
	<br />
	<input type="submit" value="submit" /> <input type="reset" value="reset" />
	</form>
	
	<a href="editnews.php">Edit News</a></br>
	<a href="index.php">Home</a>
</body>
</html>


