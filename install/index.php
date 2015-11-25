<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Install FluffCMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../a/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-setup {
        max-width: 500px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-setup .form-setup-heading,
      .form-setup .checkbox {
        margin-bottom: 10px;
      }
      .form-setup input[type="text"],
      .form-setup input[type="password"],
      .form-setup button {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/system/admin/assets/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-setup form-inline" method="post" action="actions.php">
        <img src="../a/assets/img/logo.png" width="500" /><h2 style="text-align:center;margin-bottom:40px;" class="form-setup-heading muted">System Installation</h2>
        <hr />
        <h3 class="muted">Database Information</h3>
        <div class="row-fluid">
        	<div class="controls controls-row">
	        	<input required type="text" class="input-block-level span6" placeholder="Database Host" name="dbhost">
	        	<input required type="text" class="input-block-level span6" placeholder="Database Name" name="dbname">
        	</div>
        	<div class="controls controls-row">
	        	<input required type="text" class="input-block-level span6" placeholder="Database User" name="dbuser">
	        	<input required type="password" class="input-block-level span6" placeholder="Database Password" name="dbpass">
        	</div>
        </div>
        <h3 class="muted">Site Information</h3>
        <div class="row-fluid">
	        <input required type="text" class="input-block-level span12" placeholder="Base URL - http://google.com/" pattern="https?://.+" name="baseurl">
	        <input required type="text" class="input-block-level span12" placeholder="Site Title" name="sitetitle">
        </div>
        <h3 class="muted">Admin Information</h3>
        <div class="row-fluid">
	        <input type="text" class="input-block-level span12" placeholder="Administrator's Name" name="admin_name">
        	<div class="controls controls-row">
	        	<input required type="text" class="input-block-level span6" placeholder="Admin Username" name="admin_username">
	        	<input required type="password" class="input-block-level span6" placeholder="Admin Password" name="admin_password">
        	</div>
        </div>
        <h3 class="muted">SALT Key - Security Key</h3>
		<div class="input-append">
		  <input required class="saltkey" id="appendedInputButton" type="text" name="salt">
		  <button class="btn gensalt" type="button">Generate New</button>
		</div>
        <button class="btn btn-large btn-primary pull-right" type="submit">Install</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="../a/assets/js/bootstrap.js"></script>
    
    <script>
	function randomString(len) {
		  // Just an array of the characters we want in our random string
		  var chrs = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
		              'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
		              '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!', '@', '#', '$', '%', '&'];
		 
		  // Check that a length has been supplied and if not default to 32
		  len = (isNaN(len)) ? 32 : len;
		 
		  // The following section shuffles the array just to further randomise the output
		  var tmp, current, top = chrs.length; 
		  if(top)
		  {
		    while(--top) 
		    { 
		      current = Math.floor(Math.random() * (top + 1)); 
		      tmp = chrs[current]; 
		      chrs[current] = chrs[top]; 
		      chrs[top] = tmp; 
		    }
		  }
		 
		  // Just a holder for our random string
		  var randomStr = '';
		 
		  // Loop through the required number of characters grabbing one at random from the array each time
		  for(i=0;i<len;i++) 
		  {
		    randomStr = randomStr + chrs[Math.floor(Math.random()*chrs.length)];
		  }
		 
		  // Return our random string
		  return randomStr;
		}
		$('.gensalt').click(function(){
			$('.saltkey').attr('value', randomString(20));
		});
    </script>
  </body>
</html>
