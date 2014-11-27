<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_hms_test = "localhost";
$database_hms_test = "hms_test";
$username_hms_test = "root";
$password_hms_test = "";
$hms_test = mysql_pconnect($hostname_hms_test, $username_hms_test, $password_hms_test) or trigger_error(mysql_error(),E_USER_ERROR); 
?>