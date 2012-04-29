<?PHP
include ("config.php");

//echo "<p>Messages loaded: ".date("d/m/y : H:i:s", time())."</p>";

if(isset($_GET['offset'])){
$offset = $_GET['offset'];
}else{
$offset=0;
}	

$numresults=mysql_query("SELECT * FROM message_board");
$numrows=mysql_num_rows($numresults)
			or die ("Currently you do not have any items. Click <a href=board.php>here</a> to add.");

$query="SELECT * FROM message_board ORDER BY id desc limit $offset,$limit";
$result=mysql_query($query);

$num=mysql_num_rows($result);

mysql_close();

//echo "<h1>Showing 10 of $num comments</h1>";


$i=0;
if ($num > 0){
echo '<ol style="list-style-type: none;">';
while ($i < $num) {

$id=mysql_result($result,$i,"id");
$date=mysql_result($result,$i,"post_dt");
$email=mysql_result($result,$i,"email");
$url=mysql_result($result,$i,"url");
$name=stripslashes(mysql_result($result,$i,"name"));
$message=stripslashes(mysql_result($result,$i,"message"));

echo "<li>";
//if ($email!=""):
//echo "by <b><a href=mailto:$email target=_blank>$name</a></b><br>";
//else:
echo "<cite>$name</cite> says:<br>";
//endif;
echo "On $date<br>";
if ($url!="") {
echo "URL: <a href=\"$url\" target=\"_blank\">$url</a><br>";
}
echo "<p>$message</p>";

echo "</li>";

$i++;
}

echo '</ol>';

// create paging links below
echo '<p class="button-link">';
if ($offset >= $limit) { 
$prevoffset = $offset - $limit; 
echo "<a href=\"#\" onclick=\"loadMessages($prevoffset);\">Back</a>&nbsp;\n"; 
} 

$pages=intval($numrows/$limit);
if ($pages < ($numrows/$limit)){
$pages=($pages + 1);
}

//uncomment below to show paging links from page numbers
//for ($i = 1; $i <= $pages; $i++) { 
//$newoffset = $limit*($i-1); 
//if ($newoffset == $offset) { 
//print "<span class=\"current\">$i</span>&nbsp;\n"; 
//} else { 
//echo "<a href=\"#\" onclick=\"loadMessages($newoffset);\">$i</a>&nbsp;\n"; 
//} 
//} 

//show next if not last
if (! ( ($offset/$limit) == ($pages - 1) ) && ($pages != 1) ) { 
$newoffset = $offset+$limit; 
echo "<a href=\"#\" onclick=\"loadMessages($newoffset);\">Next</a>\n"; 
}

echo '</p>';

}else{
echo "No entry yet.";
}
?>
