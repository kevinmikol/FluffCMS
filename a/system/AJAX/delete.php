<?php 
require('../common.php');

$type = $_POST['type'];
$id = $_POST['id'];

if($type=="" OR $type==NULL){
	die;
}else{
	require('../classes/'.$type.'.class.php');
	$object = new $type();
	$object->delete($_POST['id']);
}
if($type=="link")
	echo "<script>$('ol li#list_".$_POST['id']."').fadeOut();</script>";
?>