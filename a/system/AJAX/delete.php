<?php 
require('../common.php');

$type = $_POST['type'];
$id = $_POST['id'];

if($type=="" OR $type==NULL){
	die;
}else if($type=="page"){
	require('../classes/page.class.php');
	$page = new page();
	$page->delete($_POST['id']);
}else if($type=="block"){
	require('../classes/block.class.php');
	$block = new block();
	$block->delete($_POST['id']);
}else if($type=="user"){
	require('../classes/user.class.php');
	$user = new user();
	$user->delete($_POST['id']);
}else if($type=="link"){
	require('../classes/link.class.php');
	$link = new link();
	$link->delete($_POST['id']);
	echo "<script>$('ol li#list_".$_POST['id']."').fadeOut();</script>";
}else{
	die;
}
?>
<script>
$('#<?=$type?>-table tr#<?=$id?>').fadeOut();
$('#deleteModal').modal('hide');
$('.notifications').notify({
    message: { type: 'alert', text: 'The <?=$type ?> #<?=$id ?> was deleted.' },
	type: "error"
  }).show();
</script>