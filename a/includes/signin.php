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
<title>Login | <?=$title;?></title>

<style type="text/css">
html{
	height:100%;
	width:100%;
	background: black url('https://unsplash.it/1200/1000/?random') no-repeat center center fixed; 
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