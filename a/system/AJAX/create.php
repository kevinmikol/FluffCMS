<?php 
require('../common.php');

$type = $_POST['type'];

if($type=="" OR $type==NULL){
	die;
}else if($type=="page"){
	require('../classes/page.class.php');
	$page = new page();
	$page->create($_POST['title'], $_POST['url'], $_POST['template'], $_POST['htmlcontent'], $_POST['cb'], $_POST['template'], $_POST['featuredImage']);
	$title = $_POST['title'];
}else if($type=="block"){
	require('../classes/block.class.php');
	$block = new block();
	$block->create($_POST['title'], $_POST['htmlcontent'], $_POST['cb']);
	$title = $_POST['title'];
}else if($type=="user"){
	require('../classes/user.class.php');
	$user = new user();
	$user->create($_POST['name'], $_POST['username'], $_POST['role'], $_POST['password'], $_POST['email']);
	$title = $_POST['username'];
}else if($type=="post"){
    require('../classes/post.class.php');
	$post = new post();
	$post->create($_POST['title'], $_POST['url'], $_POST['htmlcontent'], $_POST['cb'], $_POST['featuredImage'], $_POST['status']);
    $title = $_POST['title'];
}else{
	die;
}

echo 'The '.$type.' "'.$title.'" was created.';
?>