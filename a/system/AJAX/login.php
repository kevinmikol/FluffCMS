<?php
require($_SERVER['DOCUMENT_ROOT'].'/config.php');
$db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

$username = $_POST['username'];
$password = $_POST['password'];

$encryptedPassword = crypt($password,$salt);

$loginresult = $db->prepare("SELECT * FROM cms_users WHERE username = :username AND password = :password");
$loginresult->bindParam(":username", $username);
$loginresult->bindParam(":password", $encryptedPassword);
$loginresult->execute();
$row = $loginresult->fetch();

if($loginresult->rowCount() > 0){
    session_start();
    $_SESSION['adminrole'] = $row['role'];
    
    if($_SESSION['adminrole'] > 0){
        $_SESSION['siteadmin'] = microtime();
        $_SESSION['adminid'] = $row["id"];
        $_SESSION['adminname'] = $row["name"];
        $_SESSION['adminusername'] = $row["username"];
        $_SESSION['adminemail'] = $row["email"];

        $loginresult = $db->prepare("UPDATE cms_users SET last_login = now() WHERE id = :id");
        $loginresult->bindParam(":id", $_SESSION['adminid']);
        $loginresult->execute();

        echo 'true';
    }else{
        echo "false";
    }
}else{
	  echo 'false';
	}
?>
