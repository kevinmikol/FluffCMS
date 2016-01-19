<? require('../common.php');

$list = $_POST['list'];

require('../classes/link.class.php');
$link = new link();
$data = $link->reorder($list); ?>
<script>
$('.notifications').notify({
    message: { text: 'The menu was updated.' },
	type: "info"
  }).show();
</script>