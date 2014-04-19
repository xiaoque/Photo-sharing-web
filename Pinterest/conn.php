<?php
$conn = @ mysql_connect("localhost", "root", "root") or die("Connect error!");
mysql_select_db("pinterest", $conn);
mysql_query("set names 'utf8'");

session_start(); 
?>