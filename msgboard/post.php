<?

include ("config.php");

session_start();
//$session_code = $_SESSION['captcha_code'];

include_once ("captcha/securimage.php");
$securimage = new Securimage();


if(isset($_POST['name'])){
$name = $_POST['name'];
}else{
$name = "";
}
if(isset($_POST['email'])){
$email = $_POST['email'];
}else{
$email = "";
}

if(isset($_POST['captcha_code'])){
$security_code = $_POST['captcha_code'];
}else{
$security_code = "";
}

if(isset($_POST['website'])){
$website = $_POST['website'];
}else{
$website = "";
}
if($website=='http://'){
$website = "";
}
if($website!=''){
//if (strpos($website,"http://")==false){
//$website = "http://".$website;
//}
}

if(isset($_POST['message'])){
$message = $_POST['message'];
}else{
$message = "";
}

$ip=$_SERVER['REMOTE_ADDR']; 

$name = mysql_real_escape_string(trim(addslashes($name)));
$website = mysql_real_escape_string($website);
$email = strip_tags_attributes(trim(addslashes($email)));
$message = strip_tags_attributes(trim(addslashes($message)));

//remove line break and &
$message = str_replace("\r", "", $message);
$message = str_replace("\n", "", $message);
$message = str_replace("&", "%26", $message);

//filter bad words
for($x=0; $x< count($badwords); $x++) 
{ 
$name = eregi_replace($badwords[$x], "****", $name); 
$message = eregi_replace($badwords[$x], "****", $message); 
} 




function strip_tags_attributes($sSource, $aAllowedTags = array(), $aDisabledAttributes = array('onclick', 'ondblclick', 'onkeydown', 'onkeypress', 'onkeyup', 'onload', 'onmousedown', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onunload'))
    {
        if (empty($aDisabledAttributes)) return strip_tags($sSource, implode('', $aAllowedTags));

        return preg_replace('/<(.*?)>/ie', "'<' . preg_replace(array('/javascript:[^\"\']*/i', '/(" . implode('|', $aDisabledAttributes) . ")[ \\t\\n]*=[ \\t\\n]*[\"\'][^\"\']*[\"\']/i', '/\s+/'), array('', '', ' '), stripslashes('\\1')) . '>'", strip_tags($sSource, implode('', $aAllowedTags)));
}

//Add into database

if ($securimage->check($security_code) == false) {
  die('Error encountered. Invalid Security Code.');
  exit;
}

if ($name=='' && $message==''){
  die('Error encountered.');
  exit;
}

$insert = "INSERT INTO message_board(name, email, url, post_dt, message, ip_address) VALUES('$name', '$email', '$website', now(), '$message', '$ip')";
$mysql_insert = mysql_query($insert)
	or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $query . "<br />\nError: (" . mysql_errno() . ") " . mysql_error()); 
//	or die("Insert Fails. Please try agian later.");

//uncomment to notify if there's a new entry
//$ToEmail = "jeromewongcj@yahoo.com";
//$ToName = "Administrator";
//$ToSubject = "Somebody posted a message on your website(Jenstudiobrunei.com)";
//$EmailBody = "By: $name\n Website: $website\n Email: $email\n\nComments:\n $message\n";
//mail($ToName." <".$ToEmail.">",$ToSubject, $EmailBody, "From: Auto-Notify <robot@jenstudiobrunei.com>");

exit;

?>
