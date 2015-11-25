<?php
session_start();

date_default_timezone_set('America/Chicago');
		   
if(!isset($_SESSION['siteadmin'])){
	require('includes/signin.php');
	die;
}else{
	$user_name = $_SESSION['adminname'];
	$user_role = $_SESSION['adminrole'];
	$user_username = $_SESSION['adminusername'];
	$user_id = $_SESSION['adminid'];
}

require($_SERVER['DOCUMENT_ROOT'].'/config.php');

//Set Database
$db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

?>