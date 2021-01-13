<?php #Script 7.2 - mysql_connect.php
// insert user name and password for the new bets database
DEFINE ('DB_USER', 'user_name');
DEFINE ('DB_PASSWORD', 'password');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'bets');

$dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD)
OR die ('Could not connect to MySQL:' . mysql_error() );

mysql_select_db (DB_NAME) 
OR die ('Could not select the database: ' . mysql_error() );

?>
