<?
session_start();

require($_SERVER['DOCUMENT_ROOT'].'/config.php');
require('classes/loader.class.php');

//Set Database
$db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

$load = new loader();

$Page = $load->module('page');
$currentpage = $Page->init();

//Additional Objects
$Block = $load->module('block');

?>