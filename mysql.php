<?php
$host = 'localhost';
$username = 'roma';
$passwd = '<mysql-passwd>';
$dbname = 'classroom';
$mysqli = new mysqli($host,$username,$passwd,$dbname);
if ($mysqli->connect_error) {
  die("データベースに接続できません:" . $mysqli->connect_error . "\n");
}

?>