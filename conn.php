<?php

error_reporting(E_ERROR);

define('DB_HOST', 'localhost');

define('DB_USER', 'root');
define('DB_PWD','xxxxx');

define('DB_CHARSET', 'utf-8');
define('DB_NAME', 'login');

$db = mysql_connect(DB_HOST, DB_USER, DB_PWD) or die("connect error!" . mysql_error());

mysql_select_db(DB_NAME, $db);

mysql_set_charset(DB_CHARSET, $db);

mysql_query('set names utf8');


?>
