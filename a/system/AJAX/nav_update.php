<?
require('../common.php');
//print_r($_POST['list']);

$list = $_POST['list'];

foreach ($list as $value) {
	$navigation = $db->prepare("UPDATE cms_navigation SET `parent_id` = :parent_id, `depth` = :depth, `left` = :left, `right` = :right WHERE `id` = :id");
	$navigation->bindParam(':id', $value['id']);
	$navigation->bindParam(':parent_id', $value['parent_id']);
	$navigation->bindParam(':depth', $value['depth']);
	$navigation->bindParam(':left', $value['left']);
	$navigation->bindParam(':right', $value['right']);
	$navigation->execute();
}
?>
<script>
$('.notifications').notify({
    message: { text: 'The menu was updated.' },
	type: "info"
  }).show();
</script>