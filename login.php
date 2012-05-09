<?php 

$sites = array( 
   'halo12'   => 'redirect.php', 
); 

$password = isset($_POST['password']) ? trim($_POST['password']) : ''; 
@session_start(); 
@session_register("logged_in"); 
$_SESSION["logged_in"] = 1;  

if($password && isset($sites[$password])) { 
   header('Location: ' . $sites[$password]); 
} 
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<style type="text/css"> 
body {margin: 0;padding: 0;background:#222 url('splash.gif') no-repeat top left;} 
#login {margin: 245px 0 0 245px;} 
#login p {margin: 2px 0 0 45px; color:#fff} 
#login input {padding: 5px;color: #666} 
#login input:focus {color: #000} 
</style> 
</head> 
<body> 
<div id="login"> 
<p>Password:</p>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>"> 
  <input type="password" name="password" size="20" maxlength="100" /> 
  <p><input type="submit" value="Submit" /></p> 
</form> 
</div> 
</body> 
</html>