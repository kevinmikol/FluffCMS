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
$count = $loginresult->rowCount();
$usercheck = $loginresult->fetchAll();

if($count){
		foreach( $usercheck as $row ) {
			$user_id = $row["id"];
			$user_name = $row["name"];
			$user_username = $row["username"];
			$user_role = $row["role"];
        }
    
		if($user_role > 0){
			session_start();
			$_SESSION['siteadmin'] = microtime();
			$_SESSION['adminid'] = $user_id;
			$_SESSION['adminname'] = $user_name;
			$_SESSION['adminusername'] = $user_username;
			$_SESSION['adminrole'] = $user_role;
            
            $loginresult = $db->prepare("UPDATE cms_users SET last_login = now() WHERE id = :id");
            $loginresult->bindParam(":id", $user_id);
            $loginresult->execute();
            
			echo 'true';
		}else{
			echo "false";
		}
}else{
	  echo 'false';
	}
?>
