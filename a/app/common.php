<?
session_start();

require($_SERVER['DOCUMENT_ROOT'].'/config.php');
require('loader.php');

//Set Database
$db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

$load = new load();

$currentpage = $load->init();
?>