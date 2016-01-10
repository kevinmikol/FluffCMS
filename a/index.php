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
    <meta name="author" content="Kevin Mikolajczak">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
      
    <link href="assets/css/style.css" rel="stylesheet">
  </head>

  <body>
  <div class="loader"><img src="assets/img/ripple.svg" /></div>
	<div class='notifications bottom-right'></div>
    
      <header>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/a"><img src="assets/img/logo.png" style="width:78px;" /></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="pull-right navbar-nav nav">
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
                    <ul class="pull-right navbar-nav nav loaders">
                        <li page="users"><a><i class="icon-group"></i> Manage Users</a></li>
                    </ul>
                    <? } ?>
                    <ul class="navbar-nav nav loaders">
                      <li page="dashboard"><a><i class="icon-dashboard"></i> Dashboard</a></li>
                        <? if($user_role > 0){ ?> <li page="posts"><a><i class="icon-pencil"></i> Posts</a></li> <? } ?>
                        <? if($user_role > 1){ ?><li page="pages"><a><i class="icon-file-text-alt"></i> Pages</a></li> <? } ?>
                        <? if($user_role > 3){ ?><li page="navigation"><a><i class="icon-road"></i> Navigation</a></li> <? } ?>
                        <? if($user_role > 1){ ?> <li page="blocks"><a><i class="icon-puzzle-piece"></i> Blocks</a></li> <? } ?>
                    </ul>
              </div><!--/.nav-collapse -->
            </div>
        </nav>
    </header>
    
    <div class="container">
		<? $load->page(); ?>
    </div><!--/span-->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&copy;<?=date(Y)?> FluffCMS. All rights reserved. - Created by <a href="http://kevinmikol.com" target="_blank">Kevin Mikolajczak</a>
                </div>
            </div>
        </div>    
    </footer>

    </div>
		
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	
	<!--PLUGINS -->
<!--	<script src="plugins/ckeditor/ckeditor.js"></script>-->
    
    <script src="plugins/summernote/summernote.min.js"></script>
    <link href="plugins/summernote/summernote.css" rel="stylesheet">

	<script src="plugins/nested/jquery.mjs.nestedSortable.js"></script>
	<link href="plugins/nested/style.css" rel="stylesheet">

	<script src="plugins/notify/bootstrap-notify.js"></script>
    <link href="plugins/notify/bootstrap-notify.css" rel="stylesheet">
    <link href="plugins/notify/alert-notification-animations.css" rel="stylesheet">

<!--
	<script src="https://www.google.com/jsapi"></script>
	<script src="plugins/google/gadash.js"></script>
	<script src="https://apis.google.com/js/client.js?onload=gadashInit"></script>
-->
	<script>
		var TABLE_ID = 'ga:<?=$gana; ?>';
		var API_KEY = '<?=$apikey; ?>';
		var CLIENT_ID = '<?=$clientid; ?>';
	</script>
	<script src="plugins/google/scripts.js"></script>

	<script>
		var first = "<?=$activepage?>";
	</script>
	<script src="assets/js/scripts.js"></script>
	
	<? $load->modal(); ?>

  </body>
</html>
