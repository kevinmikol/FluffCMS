<?php
require('../common.php');

$name  = '';
$type  = '';
$size  = '';
$error = '';

function compress_image($source_url, $destination_url, $quality, $newwidth, $newheight){
    
    $info = getimagesize($source_url);
    
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);
    else if ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);
    else if ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);
        
    list($width, $height) = $info;
    
    if($width > $height && $newheight < $height){
        $newheight = $height / ($width / $newwidth);
    } else if ($width < $height && $newwidth < $width) {
        $newwidth = $width / ($height / $newheight);    
    } else {
        $newwidth = $width;
        $newheight = $height;
    }
    
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    imagealphablending($thumb, false);
    imagesavealpha($thumb, true);  

//    $source = imagecreatefrompng($fileName);
    imagealphablending($image, true);

    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    imagepng($thumb, $destination_url, $quality);
    
    return $destination_url;
}

if($_FILES){
	foreach ($_FILES as $file){
	    if(($file["type"] == "image/gif") || ($file["type"] == "image/jpeg") || ($file["type"] == "image/png") || ($file["type"] == "image/pjpeg")) {
            $file["name"] = strtolower(str_replace(array(" ", "-"), "_", $file["name"]));
            
            $url = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
           
            if(file_exists($url.$file["name"])){
                $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
                $name = str_replace(".".$ext, '' , $file["name"]);

                $file['name'] = $name."_".microtime().".".$ext;
            }
            
	        $filename = compress_image($file["tmp_name"], $url.$file['name'], 8, 800, 800);
            
            echo '/uploads/'.$file["name"];
	    }else{
            echo 'fail';
        }
	}
}
?>