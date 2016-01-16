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
	$block->create($_POST['title'], $_POST['content']);
	$title = $_POST['title'];
}else if($type=="user"){
	require('../classes/user.class.php');
	$user = new user();
	$user->create($_POST['name'], $_POST['username'], $_POST['role'], $_POST['password']);

	$title = $_POST['username'];

	function role($num){ 
	  if($num == 0){
		  echo "Bystander";
	  }else if($num == 1){
		  echo "Content Editor";
	  }else if($num == 2){
		  echo "Minute Admin";
	  }else if($num == 3){
		  echo "Super Admin";
	  }
	}
}else{
	die;
}

echo 'The '.$type.' "'.$title.'" was created.';
?>