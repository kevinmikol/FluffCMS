<?php 
require('../common.php');

$type = $_POST['type'];
$id = $_POST['id'];

$title = $_POST['title'];

//print_r($_POST);
print_r($_FILES);

if($type=="" OR $type==NULL){
	die;

}else if($type=="page"){

	require('../classes/page.class.php');
	$page = new page();
	$page->update($_POST['title'], $_POST['url'], $_POST['htmlcontent'], $_POST['id'], $_POST['ub'], $_POST['template'], $_POST['featuredImage']);

}else if($type=="block"){

	require('../classes/block.class.php');
	$block = new block();
	$block->update($_POST['title'], $_POST['content'], $_POST['id']);

}else if($type=="user"){

	require('../classes/user.class.php');
	$user = new user();
	$user->update($_POST['id'], $_POST['role'], $_POST['name'], $_POST['username']);

}else if($type=="navigation"){
	
	require('../classes/link.class.php');
	$link = new link();
	$link->update($_POST['id'], $_POST['role'], $_POST['name'], $_POST['username']);

	//print_r($update_link->errorInfo());
	$title = $_POST['text'];
	?>
	<script>
		$("ol li#list_<? echo $id; ?> div span").text('<? echo $_POST['text']; ?>');
	</script>
	<?
}else{
die; }
?>
<script>
$('.notifications').notify({
    message: { text: 'The <?=$type ?> "<?=$title ?>" was updated.' },
	type: "info"
  }).show();
</script>