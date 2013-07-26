<?
  $bg = array(          $baseurl.'assets/img/bg/1.jpg', $baseurl.'assets/img/bg/2.jpg', $baseurl.'assets/img/bg/3.jpg', $baseurl.'assets/img/bg/4.jpg',
						$baseurl.'assets/img/bg/5.jpg', $baseurl.'assets/img/bg/6.jpg', $baseurl.'assets/img/bg/7.jpg', $baseurl.'assets/img/bg/8.jpg',
						$baseurl.'assets/img/bg/9.jpg', $baseurl.'assets/img/bg/10.jpg', $baseurl.'assets/img/bg/11.jpg', $baseurl.'assets/img/bg/12.jpg',
						$baseurl.'assets/img/bg/13.jpg'  ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Apple iOS and Android stuff (do not remove) -->
<meta name="apple-mobile-web-app-capable" content="no" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1" />
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


<link rel="stylesheet" type="text/css" href="assets/css/login.css" media="screen" />
<title>Login | <? echo $sitetitle ?></title>

<style type="text/css">
html{
	height:100%;
	width:100%;
	background: black url('<?php echo $selectedBg ?>') no-repeat center center fixed; 
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}
</style>
</head>

<body>
<div class="loading"><div class="loader"></div></div>
    <div id="login-wrapper">
	<img src="assets/img/logo.png" class="logo" />
        <form class="login" id="login">
				    <p>
				        <label for="login">username</label>
				        <input type="text" name="username" placeholder="username" required>
				    </p>
				    <p>
				        <label for="password">password</label>
				        <input type="password" name='password' placeholder="password" required> 
				    </p>

				    <p>
				        <input type="submit" name="submit" value="login">
				    </p>       
				</form>
    </div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

	<script type="text/javascript" src="assets/js/login.js"></script>


</body>
</html>