<?php 
require('../common.php');

$type = $_GET['type'];
$id = $_GET['id'];

if($type=="" OR $type==NULL){
	die;
}else{
	require('../classes/'.$type.'.class.php');
	$edit = new $type();
	$data = $edit->edit($_GET['id']);
}

echo $data;
?>