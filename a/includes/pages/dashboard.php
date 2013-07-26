<?	$lastYearDate = date("F d, Y", strtotime(date("F d, Y", strtotime(date("F d, Y"))) . " - 1 year"));
	$lastMonthDate = date("F d, Y", strtotime(date("F d, Y", strtotime(date("F d, Y"))) . " - 1 month"));

$t=date("H");
$t = $t-1;
if ($t<"12" && $t>"4")
  {
  $dmsg = "Good morning";
  }
else if ($t>="12" && $t<"17")
  {
  $dmsg = "Good afternoon";
  }
else if ($t>"17" && $t<"23")
  {
  $dmsg = "Good evening";
  }
 else
 {
 $dmsg = "<h3>Why you're up at an odd hour!</h3><br /><h2>Hello";
 }
?>

<? if($user_role > 1){ ?>
      <div class="row-fluid">
		  <div class="hero-unit span4">
			<h2><?=$dmsg;?> <?=$user_name;?>!</h2>
			<p>Welcome to FluffCMS!</p>
			<p>This is the dashboard. All of your website statistics will be reported here.</p>
		  </div>
		  <div class="span8">
				<h2><i class="icon-bar-chart"></i> Visitors</h2>
				<p><?=$lastMonthDate." - ".date("F d, Y")?>
			 <div id='lastthirty'><div class="loader"></div></div>
			 			 <button id="authorize-button" style="visibility: hidden" class="btn btn-danger">
				Authorize Analytics</button>
		  </div>
	</div>

      <div class="row-fluid">
        <div class="span4">
          <h2><i class="icon-globe"></i> Browsers</h2>
		  <p>Since <?=$lastYearDate?></p>
          <div id="browsers"><div class="loader"></div></div>
        </div>
        <div class="span4">
          <h2><i class="icon-share"></i> Sources</h2>
		  <p>Since <?=$lastYearDate?></p>
          <div id="sources"><div class="loader"></div></div>
       </div>
        <div class="span4">
          <h2><i class="icon-desktop"></i> Operating System</h2>
		  <p>Since <?=$lastYearDate?></p>
          <div id="os"><div class="loader"></div></div>
        </div>
      </div>
<? }else{ ?>
	   <div class="row-fluid">
		  <div class="hero-unit span8">
		  	<h2>Welcome to FluffCMS!</h2>
			<h1><?=$dmsg;?> <?=$user_name;?>!</h1>
		  </div>
	</div>
<? } ?>