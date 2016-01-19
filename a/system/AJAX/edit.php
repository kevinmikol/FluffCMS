<?php 
require('../common.php');

$type = $_GET['type'];
$id = $_GET['id'];

if($type=="" OR $type==NULL){
	die;
}else if($type=="page"){
	require('../classes/page.class.php');
	$page = new page();
	$data = $page->edit($_GET['id']);
}else if($type=="block"){
	require('../classes/block.class.php');
	$block = new block();
	$data = $block->edit($_GET['id']);
}else if($type=="user"){
	require('../classes/user.class.php');
	$user = new user();
	$data = $user->edit($_GET['id']);
}else if($type=="navigation"){
	require('../classes/link.class.php');
	$link = new link();
	$data = $link->edit($_GET['id']);
}

echo $data;
?>