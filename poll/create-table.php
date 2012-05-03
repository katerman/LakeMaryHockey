<?php
mysql_connect('mysql15.000webhost.com', 'a4610366_poll', 'halo12')
or die (mysql_error());
mysql_select_db('a4610366_poll')
or die (mysql_error());
mysql_query("create table poll(
   vote tinyint(2) NOT NULL, 
   ip varchar(15) NOT NULL, 
   PRIMARY KEY (ip)
)") or die (mysql_error());
echo "Complete.";
?>