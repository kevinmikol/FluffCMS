<?php
require('system/common.php');
require('system/loader.php');

$load = new load();

$url = $_SERVER[REQUEST_URI];

$page = $_GET['page'];
if(!isset($page)){
	$activepage = "dashboard";
}else{
	$activepage = $page;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>FluffCMS | <?=$sitetitle?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
  </head>

  <body > <!--data-spy="scroll"-->
  <div class="loading"><div class="loader"></div></div>
	<div class='notifications bottom-right'></div>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand"><img src="assets/img/logo.png" style="width:78px;" /></a>
          <div class="nav-collapse collapse">
			<ul class="pull-right nav">
				<li class="dropdown">
					 <a class="dropdown-toggle" data-toggle="dropdown">Logged in as <?=$user_name; ?><b class="caret"></b></a>
					   <ul class="dropdown-menu">
							<li><a>User ID: <?=$user_id; ?></a></li>
							<li><a>Name: <?=$user_name; ?></a></li>
							<li><a>Username: <?=$user_username; ?></a></li>
						   <li class="divider"></li>
						   <li><a href="system/AJAX/logout.php"><i class="icon-off"></i>  Logout</a></li>
						</ul>
				  </li>
            </ul>
			<? if($user_role > 3){ ?>
			<ul class="pull-right nav loaders">
				<li page="users"><a><i class="icon-group"></i> Manage Users</a></li>
			</ul>
			<? } ?>
            <ul class="nav loaders">
              <li page="dashboard"><a><i class="icon-dashboard"></i> Dashboard</a></li>
              <? if($user_role > 1){ ?><li page="pages"><a><i class="icon-file-text-alt"></i> Pages</a></li> <? } ?>
              <? if($user_role > 3){ ?><li page="navigation"><a><i class="icon-road"></i> Navigation</a></li> <? } ?>
             <? if($user_role > 1){ ?> <li page="blocks"><a><i class="icon-puzzle-piece"></i> Blocks</a></li> <? } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
		<? $load->page(); ?>
    </div><!--/span-->


      <hr>

<footer>
        <div class="container">
            <div class="pull-left">
                <p class="muted credit">&copy;<?=date(Y)?> FluffCMS. All rights reserved. - Created by <a href="http://kevinmikol.com" target="_blank">Kevin Mikolajczak</a>
            </div>
        </div>    
</footer>

    </div>
		
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	
	<!--PLUGINS -->
	<script src="plugins/ckeditor/ckeditor.js"></script>

	<script src="plugins/nested/jquery.mjs.nestedSortable.js"></script>
	<link href="plugins/nested/style.css" rel="stylesheet">

	<script src="plugins/notify/bootstrap-notify.js"></script>
    <link href="plugins/notify/bootstrap-notify.css" rel="stylesheet">
    <link href="plugins/notify/alert-notification-animations.css" rel="stylesheet">

	<script src="https://www.google.com/jsapi"></script>
	<script src="plugins/google/gadash.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=gadashInit"></script>
	<script>
		var TABLE_ID = 'ga:<?=$gana; ?>';
		var API_KEY = '<?=$apikey; ?>';
		var CLIENT_ID = '<?=$clientid; ?>';
	</script>
	<script src="plugins/google/scripts.js"></script>

	<script>
		var first = "<?=$activepage?>";
	</script>
	<script src="assets/js/custom.js"></script>
	
	<? $load->modal(); ?>

  </body>
</html>
