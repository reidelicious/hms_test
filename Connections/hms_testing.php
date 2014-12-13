<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_hms_testing = "xampp";
$database_hms_testing = "hms_test";
$username_hms_testing = "root";
$password_hms_testing = "";
$hms_testing = mysql_pconnect($hostname_hms_testing, $username_hms_testing, $password_hms_testing) or trigger_error(mysql_error(),E_USER_ERROR); 
?>