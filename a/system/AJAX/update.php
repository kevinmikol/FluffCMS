<?php 
require('../common.php');

$type = $_POST['type'];
$id = $_POST['id'];

$title = $_POST['title'];

if($type=="" OR $type==NULL){
	die;

}else if($type=="page"){
    $title = $_POST['title'];
	require('../classes/page.class.php');
	$page = new page();
	$page->update($_POST['title'], $_POST['url'], $_POST['htmlcontent'], $_POST['id'], $_POST['ub'], $_POST['template'], $_POST['featuredImage']);
}else if($type=="block"){
	require('../classes/block.class.php');
	$block = new block();
	$block->update($_POST['title'], $_POST['content'], $_POST['id']);
}else if($type=="user"){
    $title = $_POST['username'];
	require('../classes/user.class.php');
	$user = new user();
	$user->update($_POST['id'], $_POST['role'], $_POST['name'], $_POST['username'], $_POST['email']);
    if($_POST['newPW'] !== "")
        $user->updatePW($_POST['id'], $_POST['newPW']);
}else if($type=="navigation"){
	require('../classes/link.class.php');
	$link = new link();
	$link->update($_POST['id'], $_POST['role'], $_POST['name'], $_POST['username']);
	$title = $_POST['text']; ?>
	<script>
		$("ol li#list_<? echo $id; ?> div span").text('<? echo $_POST['text']; ?>');
	</script>
<? }else{
    die;
}
?>
<script>
    $('.notifications').notify({
        message: { text: 'The <?=$type ?> "<?=$title ?>" was updated.' },
        type: "info"
    }).show();
</script>