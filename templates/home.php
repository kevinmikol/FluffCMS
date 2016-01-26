<?php require('includes/header.php'); ?>
<!-- Primary Page Layout
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
<div class="container">
    <div class="row">
      <div class="one-half column">
        <h2><?=$CurrentPage->title;?></h2>
        <img src="<?=$CurrentPage->image;?>" />
        <?=$CurrentPage->content;?>
      </div>
    </div>
</div>
<?php require('includes/footer.php'); ?>