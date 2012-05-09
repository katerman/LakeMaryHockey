<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lake Mary Hockey - Message Board</title>

<link href="../css/global.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/jquery.timer.js"></script>
<script type="text/JavaScript">


function limitChars(limit){

var text = $('#message').val(); 
var textlength = text.length;

$('#count').html(textlength);

if(textlength > limit){
return false;
}else{
return true;
}

}

function isValidEmail(str) {
return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
}
function isValidURL(url){
    var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
} 

function refreshCaptcha(){
document.getElementById('captcha').src = 'captcha/securimage_show.php?' + Math.random(); 
//return false;
}

function postData(){

var name = $('#name').val();
var email = $('#email').val();
var message = $('#message').val();
var captcha_code = $('#captcha_code').val();

 var dataString = 'name='+ name + '&email=' + email + '&message=' + message + '&captcha_code=' + captcha_code;  
 $("#error").html("Processing...");
 $.ajax({  
   type: "POST",  
   url: "post.php",  
   data: dataString,  
   error: function(){
     //alert('Error loading document');
	 return false; 
   },
   success: function() {
     //place something here
   }
 });
return true;
}

function loadMessages(offset){
$("#messages").html("Loading...").hide().fadeIn("slow");
$('#messages').load('messages.php?offset='+offset).hide().fadeIn("slow");
return false;
}

$(document).ready(function(){

  loadMessages(0);
  $("#cap").html("<img id=captcha src=captcha/securimage_show.php alt=CAPTCHA Image />");
//$("#cap").html("<img src=CaptchaSecurityImages.php?width=100&amp;height=26&amp;characters=5>");


  $("#message").keyup(function() {
     limitChars(20);
  });
  
  $(".refresh").click(function() {
  loadMessages(0);
  //alert('refresh!');
  return false;
  });
  
  //$("form").submit(function() {
  $(".button").click(function() {
  
var sec_code = $.ajax({
  url: "get_session.php",
  async: false
 }).responseText;

  
     if($('#message').val()==''||$('#name').val()==''){
        $('#error').html("Name and Message cannot be empty").addClass('error').hide().fadeIn("slow");
        return false; 
	 };	 
	 if($('#email').val()!=''){
	   if(isValidEmail($('#email').val())==false){
	   $('#error').html("Invalid email address").addClass('error').hide().fadeIn("slow");
	   return false; 
	   };
	 };
	 
	 if($('#message').val().length>300){
	 $('#error').html("Message must not exceed 300 characters.").addClass('error').hide().fadeIn("slow");
	 return false; 
	 };
	 if(sec_code!=$('#captcha_code').val()){
	 $('#error').html("Invalid security code.").addClass('error').hide().fadeIn("slow");
	 refreshCaptcha();
	 return false; 
	 }
	 if(postData()){
	 $('#error').html("Processing.....").removeClass('error').hide().fadeIn("slow");
	 $.timer(3000,function(){
	 $('#error').html("Message inserted!").addClass('success').hide().fadeIn("slow");
	 loadMessages(0);
	 refreshCaptcha();
	 //$('input[@type="text"]').val("");
	 $('#name').val("");
	 $('#email').val("");
	 $('#message').val("");
	 $('#captcha_code').val("");
	 });
	 }else{
	 $('#error').html("Database Error.").fadeIn("slow");
	 return false; 
	 }
	 return false;

  });
  
  
});

</script>
</head>

<body>

	<?php //echo "Page loaded on " . date("d/m/y : H:i:s", time()); ?>
<div id="msg-container">
	<div id="header">
			<h1> Lake Mary Hockey</h1>
		</div>
	
		<div id="nav">
				<li><a href="../index.php">Home</a></li>
			 	<li><a href="../standings.htm#stands">Teams</a></li>
			 	<li><a href="../playerstats.html#players">Players</a></li>
				<li><a href="http://www.facebook.com/groups/242140609216858/photos/">Pictures</a></li>
				<li><a href="../rules.html">Rules</a></li>
				<li><a href="../awards.html#awards">Awards</a></li>
				<li><a href="../schedule.html">Schedule</a></li>
				<li><a href="#">Payment</a></li>
				<li class="nav-msgbrd-fix" ><a class="active" href="#">Message Boards</a></li>
		</div>
	<div id="content">
		<div id="stylized" class="myform">
			<form id="form" name="form" action="#" method="post">
			<h1>Post your message</h1>
			<p id="error">Please complete the form below</p>
			
			<label>Name</label>
			<input name="name" type="text" id="name" />
			
			<label>Email</label>
			<input name="email" type="text" id="email" />
			
			<label>Message <span class="small">(Character count: <span id="count">0</span>)</span></label>
			<textarea name="message" id="message"></textarea>
			<label>Security Code
			<span class="small">Click to refresh</span>
			</label>
			<a href="#" onclick="refreshCaptcha();"><span id="cap"></span></a>
			<label>Re-type Security Code
			<span class="small">(case sensitive)</span>
			</label>
			<input name="captcha_code" type="text" id="captcha_code" size="10" maxlength="10" />
			<button type="submit" class="button">Submit</button>
			<div class="spacer"></div>
			</form>
		</div>
	
	<!--<input type="button" name="button" class="refresh" id="button" value="Refresh Messages" style="margin-bottom: 10px"/>-->
	
			<div style="float:left">
				<div id="messages" class="messages">
				<!-- posted messages display here -->
				</div>
			</div>
		</div>
	</div>

		<div id="footer"><!-- Start Footer -->

			<img class="footer" src="../images/badaslogo.png" alt="badas logo!"/>
			<a href="http://www.badasdesign.com">
				Badas Design 2012&copy;
			</a>

		</div><!-- End Footer -->	
</body>
</html>
