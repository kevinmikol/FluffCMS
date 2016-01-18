<?php
date_default_timezone_set('UTC');
require($_SERVER['DOCUMENT_ROOT'].'/config.php');
$db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

function getDomain($url){
    return parse_url($url)['host'];
}

if($_POST['email']){
    $email = $_POST['email'];

    $stmt = $db->prepare("SELECT id FROM cms_users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $id = $stmt->fetch()[0];

        $auth = sha1(microtime(true).mt_rand(10000,90000));
        $stmt = $db->prepare("UPDATE cms_users SET auth = :auth WHERE id = :id");
        $stmt->bindParam(":auth", $auth);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        require('mailer.php');

        $message = "Greetings!<br /><br />We noticed you needed a password reset. Just click the link below and follow the steps to get back into the fun.<br /><br /><a href='".$baseurl."a/includes/reset.php?auth=".$auth."'>Reset my password</a><br /><br />Best of luck!<br /><b>".$title."</b>";

        $m = sendEmail($email, "Password Reset <noreply@".getDomain($baseurl).">", "Password Reset", $message);
        
        $auth = null;

        if($m)
            $success = "Please check your email for reset instructions.";
        else
            $error = "Email failed. Please contact your system administrator.";
    }else{
        $error = "No user was found with the given email address.";
    }
}else if($_GET['auth']){
    $auth = $_GET['auth'];
    
    $stmt = $db->prepare("SELECT id FROM cms_users WHERE auth = :auth");
    $stmt->bindParam(':auth', $auth);
    $stmt->execute();

    if($stmt->rowCount() == 0){
        $error = "Invalid password reset link.";
        $auth = null;
    }
}else if($_POST['auth']){
    require('../system/classes/user.class.php');
	$user = new user();
	$user->updatePW($_POST['auth'], $_POST['password']);
    
    $success = "Password Reset!";
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Password Reset</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Kevin Mikolajczak">

        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet">

        <link href="../assets/css/style.css" rel="stylesheet">
        <style type="text/css">
            body{
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
        <div class="loader"><img src="../assets/img/ripple.svg" /></div>
        <div class="container">
            <div class="row center">
                <div class="col-md-6 col-md-offset-3">
                    <img src="../assets/img/logo.png" class="img-responsive"  style="margin:20% 0 10% 0;" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form class="well" action="reset.php" method="post">
                        <?php if($error){?><div class="alert alert-danger" role="alert"><b>Uhoh!</b> <?=$error?></div><? } ?>
                        <?php if($success){?><div class="alert alert-success" role="alert"><b>Yippee!</b> <?=$success?></div><? } ?>
                        <?php if(!$success AND !$auth){?>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Your Email" class="form-control input-lg" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary pull-right">Reset</button>
                            </div>
                        <? }else if($auth){ ?>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Your New Password" class="form-control input-lg" />
                                <input type="hidden" name="auth" value="<?=$_GET['auth']?>"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary pull-right">Update</button>
                            </div>
                        <? } ?>
                        <hr />
                        <a href="/a"><i class="fa fa-arrow-circle-o-left"></i> Return to Login</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script>
        $(window).load(function(){
            $(".container").fadeIn();
            $(".loader").fadeOut();
        });
    </script>
    
</html>