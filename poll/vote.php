<?php
//Connect to MySQL
mysql_connect('mysql15.000webhost.com','a4610366_poll','halo12');
//Select database
mysql_select_db('a4610366_poll');
//Check if the current user has already voted or not
//@$REMOTE_ADDR is used to get the ip of the user
if(mysql_num_rows(mysql_query("select * from poll where ip = '" . @$REMOTE_ADDR . "'")) != 0){
   echo 'You can vote only once!';
}
else{
   //If the user had not voted then insert the new vote in the poll table
   mysql_query("insert into poll values ('" . $vote . "', '" . @$REMOTE_ADDR . "')") or die (mysql_error());
}
$mostvotes = 0;
for($i=1;$i<=4;$i++){
   //Create an array of votes for each option
   $votes[$i] = mysql_num_rows(mysql_query("select * from poll where vote = " . $i));
   if($votes[$i] > $mostvotes){
      //Select the option with the higher number of votes
      $mostvotes = $votes[$i];
   }
   //Each vote
   $allvotes += $votes[$i];
}
$option[1] = 'Logo One';
$option[2] = 'Logo Two';
$option[3] = 'Logo Three';
$option[4] = 'None';
//Generate the result in a HTML form by calculating the percentage of each option and showing the number of votes
for($i=1;$i<=4;$i++){
   echo "<div class='votes'><div class='option'>" . $option[$i] . "</div><div class='percentage' style='width:" . floor($votes[$i] / $allvotes * 100) . "px'></div></div><div class='percentagetext'> - " . floor($votes[$i] / $allvotes * 100) . "% (" . $votes[$i] . ")</div>";
}
?>