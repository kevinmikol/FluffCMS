<?
$t=date("H");
$t = $t-1;
if ($t<"12" && $t>"4")
  $dmsg = "Good morning";
else if ($t>="12" && $t<"17")
  $dmsg = "Good afternoon";
else if ($t>"17" && $t<"23")
  $dmsg = "Good evening";
else
 $dmsg = "<h3>Why you're up at an odd hour!</h3><br /><h2>Hello";
?>

<? if($user_role > 1){ ?>
      <div class="row">
		  <div class="jumbotron col-md-4">
			<h2><?=$dmsg;?> <?=$user_name;?>!</h2>
			<p>Welcome to FluffCMS!</p>
			<p>This is the dashboard. All of your website statistics will be reported here.</p>
            <div id="authorize-button"></div>
		  </div>
		  <div class="col-md-8">
              <h2><i class="fa fa-bar-chart"></i> Visitors</h2>
              <div id="visitors"></div>
		  </div>
	</div>

      <div class="row">
        <div class="col-md-4">
          <h2><i class="fa fa-desktop"></i> Browsers</h2>
          <div id="browsers"></div>
        </div>
        <div class="col-md-4">
          <h2><i class="fa fa-share"></i> Sources</h2>
          <div id="sources"></div>
       </div>
        <div class="col-md-4">
          <h2><i class="fa fa-globe"></i> Metro Areas</h2>
          <div id="metros"></div>
        </div>
      </div>
<? }else{ ?>
	   <div class="row">
		  <div class="jumbotron col-md-8">
		  	<h2>Welcome to FluffCMS!</h2>
			<h1><?=$dmsg;?> <?=$user_name;?>!</h1>
		  </div>
	</div>
<? } ?>