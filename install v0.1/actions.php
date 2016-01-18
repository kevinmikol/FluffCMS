<?

$configFile = "../config.php";
$fileHandle = fopen($configFile, 'w') or die("can't open file");
echo "Config file created<br />";

$stringData = "<?php";
fwrite($fileHandle, $stringData."\n");
echo "Edit file.<br />";

//Database Information
$stringData = '//Database Information';
fwrite($fileHandle, $stringData."\n");

$stringData = '$'.'dbhost = "'.$_POST['dbhost'].'";';
echo "Write dbhost: ".$_POST['dbhost']."<br />";
fwrite($fileHandle, $stringData."\n");

$stringData = '$'.'dbname = "'.$_POST['dbname'].'";';
echo "Write dbname: ".$_POST['dbname']."<br />";
fwrite($fileHandle, $stringData."\n");

$stringData = '$'.'dbuser = "'.$_POST['dbuser'].'";';
echo "Write dbuser: ".$_POST['dbuser']."<br />";
fwrite($fileHandle, $stringData."\n");

$stringData = '$'.'dbpass = "'.$_POST['dbpass'].'";';
echo "Write dbpass: ****************<br />";
fwrite($fileHandle, $stringData."\n");

//Site Information
$stringData = '//Site Information';
fwrite($fileHandle, $stringData."\n");

$stringData = '$'.'baseurl = "'.$_POST['baseurl'].'"; //With ending "/"';
echo "Write baseurl: ".$_POST['baseurl']."<br />";
fwrite($fileHandle, $stringData."\n");

$stringData = '$'.'title = "'.$_POST['sitetitle'].'";';
echo "Write title: ".$_POST['sitetitle']."<br />";
fwrite($fileHandle, $stringData."\n");

//Security Settings
$stringData = '//Security Settings';
fwrite($fileHandle, $stringData."\n");

$stringData = '$'.'salt = "'.$_POST['salt'].'";';
echo "Write salt: ".addslashes($_POST['salt'])."<br />";
fwrite($fileHandle, $stringData."\n");

$stringData = '?>';
echo "End file.";
fwrite($fileHandle, $stringData."\n");

fclose($fileHandle);

require($configFile);

$db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

$db->query("CREATE TABLE cms_pages(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
`created_timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 title VARCHAR(200),
 url VARCHAR(200),
 content TEXT,
 cb VARCHAR(200)
 )");  
 
$db->query("CREATE TABLE cms_navigation(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
`created_timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 parent_id VARCHAR(100),
 depth INT,
 `left` INT,
 `right` INT,
 `text` VARCHAR(200),
 url VARCHAR(200),
 target VARCHAR(200),
 attr VARCHAR(200),
 type TINYINT
 )");
 
$db->query("CREATE TABLE cms_blocks(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
`created_timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 title VARCHAR(100),
 content TEXT
 )");
 
$db->query("CREATE TABLE cms_users(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
`created_timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 role INT,
 name VARCHAR(200),
 username VARCHAR(200),
 password VARCHAR(200)
 )");

$db->query("INSERT INTO cms_users (name, username, password) VALUES ('".$_POST['admin_name']."','".$_POST['admin_username']."','".crypt($_POST['admin_password'],$salt)."')");
?>