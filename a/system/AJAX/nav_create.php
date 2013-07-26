<?
require('../common.php');
//print_r($_POST['list']);

require('../classes/link.class.php');
$link = new link();
$link->create($_POST['text'], $_POST['url'], $_POST['target'], $_POST['linktype'], $_POST['attr']);

$navigation = $db->prepare("SELECT `item_id` FROM cms_navigation WHERE `url` = :url AND `text` = :text AND `target` = :target AND `type` = :type AND `attr` = :attr LIMIT 1");
$navigation->bindParam(':text', $_POST['text']);
$navigation->bindParam(':url', $_POST['url']);
$navigation->bindParam(':target', $_POST['target']);
$navigation->bindParam(':type', $_POST['linktype']);
$navigation->bindParam(':attr', $_POST['attr']);
$navigation->execute();

while($row = $navigation->fetch(PDO::FETCH_ASSOC)){
	?>
	<script>
		$('.navigationEdit').prepend('<li id="list_<?=$row['item_id']?>" data-url="<?=$_POST['url']?>"><div><span><?=$_POST['text']?></span><a style="color:#da4f49" data-id="<?=$row['item_id']?>" data-title="<?=$row['text']?>" data-type="link" class="deleteButton"><i class="icon-trash pull-right"></i></a><a style="color:#faa732" data-id="<?=$row['item_id']?>" class="navitemedit"><i class="icon-edit pull-right"></i></a></div></li>');
	</script>
	<?
}
?>
<script>
$('.notifications').notify({
    message: { text: 'The link "<?=$_POST['text'] ?>" was created.' },
	type: "success"
  }).show();
</script>