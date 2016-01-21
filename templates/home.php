<?php require('includes/header.php'); ?>
<?=$CurrentPage->content;?>
<h1><?=$Block->load(1)->title;?></h1>
<?=$Block->load(1)->content;?>
<?php require('includes/footer.php'); ?>