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
 $dmsg = "Why you're up at an odd hour!";

$greetings = array("Aloha","Ahoy","Bonjour","G'day","Hello","Hey","Hi","Hola","Howdy","Salutations","Sup","What's up","Yo"); ?>

<? if($_SESSION['adminrole'] > 1){ ?>
      <div class="row">
		  <div class="jumbotron col-md-4">
			<h2><?=$greetings[array_rand($greetings)]?> <?=$_SESSION['adminname'];?>!<br /><small><?=$dmsg?></small></h2>
			<p>This is the dashboard. All of your website statistics will be reported here.</p>
            <small>Server Time: <?=date("F j, Y g:i a [T]");?></small>
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
          <h2><i class="fa fa-globe"></i> Locations</h2>
          <div id="metros"></div>
        </div>
      </div>
<? }else{ ?>
	   <div class="row">
		  <div class="jumbotron col-md-8">
		  	<h2>Welcome to FluffCMS!</h2>
			<h1><?=$dmsg;?> <?=$_SESSION['adminname'];?>!</h1>
		  </div>
	</div>
<? } ?>