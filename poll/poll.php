<html>

<head>
<style>
.votes {
   overflow:hidden;
   background:#CCC;
   height:20px;
   width:100px;
   margin:5px 0 0 23px;
   float:left;
}
.percentage {
   overflow:hidden;
   background:#F00;
   height:20px;
}
.option {
   position:absolute;
   width:100px;
   height:20px;
}
.percentagetext {
   overflow:hidden;
   width:75px;
   height:20px;
   margin:5px 0 0 0;
   float:left;
   text-align:left;
}
</style>
</head>

<body>
<div id="poll" style="width:200px;overflow:hidden;text-align:center;">
Do you like this poll?<br/>
<div style="text-align:left;width:180px;margin:0 auto;">
<input type="radio" name="poll" id="poll1" checked>Logo One<br/>
<input type="radio" name="poll" id="poll2">Logo Two<br/>
<input type="radio" name="poll" id="poll3">Logo Three<br/>
<input type="radio" name="poll" id="poll4">None<br/>
</div>
<input type="button" value="Vote!" onClick="vote();"/>
</div>
<script type="text/javascript">
function vote(){
   for(var i=1;i<=4;i++){
      if(document.getElementById('poll' + i).checked){
         //Check which one has been checked
         var sendto = 'vote.php?vote=' + i;
      }
   }
   // Call the vote.php file
   if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest;
      xmlhttp.open("GET",sendto,false);
      xmlhttp.send(null);
   }
   else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      xmlhttp.open("GET",sendto,false);
      xmlhttp.send();
   }
   //Output the response
   document.getElementById('poll').innerHTML = xmlhttp.responseText;
}
</script>

<a href="http://www.lakemaryhockey.com/">Back</a>
</body>
</html>