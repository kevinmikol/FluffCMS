<?php require('includes/header.php'); ?>
<h2><?=$CurrentPage->title;?></h2>
<img src="<?=$CurrentPage->image;?>" />
<br />
<?=$CurrentPage->content;?>
<h1><?=$Block->load(1)->title;?></h1>
<?=$Block->load(1)->content;?>
<?php require('includes/footer.php'); ?>