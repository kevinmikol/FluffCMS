<?php
require($_SERVER['DOCUMENT_ROOT'].'/config.php');
$db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

$email = "me@kevinmikol.com";

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
}
?>