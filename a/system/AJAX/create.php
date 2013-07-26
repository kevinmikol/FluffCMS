<?php 
require('../common.php');

$type = $_POST['type'];

if($type=="" OR $type==NULL){
	die;
}else if($type=="page"){
	require('../classes/page.class.php');
	$page = new page();
	$page->create($_POST['title'], $_POST['url'], $_POST['content'], $_POST['cb']);
	$title = $_POST['title'];
	?>
		<script>
			$('#<?=$type?>-table tr:last').after('<tr><td><span class="label label-info">just created!</span></td><td><?=$_POST['url']?><td><?=$_POST['title']?></td><td><?=$_POST['cb']?></td><td><a class="btn btn-info" href="<?=$baseurl.$_POST['url']?>" target="_blank"><i class="icon-external-link"></i> View</a></td></tr>');
		</script>
	<?
}else if($type=="block"){
	require('../classes/block.class.php');
	$block = new block();
	$block->create($_POST['title'], $_POST['content']);
	$title = $_POST['title'];
	?>
		<script>
			$('#<?=$type?>-table tr:last').after('<tr><td><span class="label label-info">just created!</span></td><td><?=$_POST['title']?></td><span class="label label-warning">refresh to view</span><td></td></tr>');
		</script>
	<?
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
	?>
		<script>
			$('#<?=$type?>-table tr:last').after('<tr><td><span class="label label-info">just created!</span></td><td><?=$_POST['username']?></td><td><?=$_POST['name']?></td><td><? role($_POST['role']);?></td><td><span class="label label-warning">refresh to view</span></td></tr>');
		</script>
	<?
}else{
	die;
}
?>
<script>
$('.notifications').notify({
    message: { text: 'The <?=$type ?> "<?=$title ?>" was created.' },
	type: "success"
  }).show();
</script>