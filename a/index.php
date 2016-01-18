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
    <title>FluffCMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Kevin Mikolajczak">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
      
    <link href="assets/css/style.css" rel="stylesheet">
  </head>

  <body>
  <div class="loader"><img src="assets/img/ripple.svg" /></div>
	<div class='notifications top-right'></div>
    
      <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/a"><img src="assets/img/logo.png" style="width:78px;" /></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse loaders">
                    <ul class="nav navbar-nav navbar-left">
                      <li page="dashboard"><a><i class="icon-dashboard"></i> Dashboard</a></li>
                        <? if($user_role > 0){ ?> <li page="posts"><a><i class="icon-pencil"></i> Posts</a></li> <? } ?>
                        <? if($user_role > 1){ ?><li page="pages"><a><i class="icon-file-text-alt"></i> Pages</a></li> <? } ?>
                        <? if($user_role > 3){ ?><li page="navigation"><a><i class="icon-road"></i> Navigation</a></li> <? } ?>
                        <? if($user_role > 1){ ?> <li page="blocks"><a><i class="icon-puzzle-piece"></i> Blocks</a></li> <? } ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                         <? if($user_role > 3){ ?><li page="users"><a><i class="icon-group"></i> Manage Users</a></li><? } ?>
                        <li class="dropdown">
                             <a class="dropdown-toggle" data-toggle="dropdown">Logged in as <?=$user_name; ?><b class="caret"></b></a>
                               <ul class="dropdown-menu">
                                    <li><a>Name: <?=$user_name; ?></a></li>
                                    <li><a>Username: <?=$user_username; ?></a></li>
                                    <li><a>Email: <?=$user_username; ?></a></li>
                                   <li class="divider"></li>
                                   <li><a href="system/AJAX/logout.php"><i class="icon-off"></i>  Logout</a></li>
                                </ul>
                          </li>
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
    <script src="assets/js/typeahead.js"></script>
	
    <!--PLUGINS -->
    <script src="plugins/summernote/summernote.min.js"></script>
    <link href="plugins/summernote/summernote.css" rel="stylesheet">

    <script src="plugins/nested/jquery.mjs.nestedSortable.js"></script>
    <link href="plugins/nested/style.css" rel="stylesheet">

    <script src="plugins/notify/bootstrap-notify.js"></script>
    <link href="plugins/notify/bootstrap-notify.css" rel="stylesheet">
    <link href="plugins/notify/alert-notification-animations.css" rel="stylesheet">

    <script>
    (function(w,d,s,g,js,fs){
      g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
      js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
      js.src='https://apis.google.com/js/platform.js';
      fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
    }(window,document,'script'));
    </script>
	<script>
		var TABLE_ID = 'ga:60994977';
		var CLIENT_ID = '1052648626176-0kpbhvqvhi3nuaalftdkmhoq39jojscs.apps.googleusercontent.com';
	</script>
	<script src="plugins/google/scripts.js"></script>

	<script>
		var first = "<?=$activepage?>";
	</script>
	<script src="assets/js/scripts.js"></script>
	
	<? $load->modal(); ?>

  </body>
</html>
