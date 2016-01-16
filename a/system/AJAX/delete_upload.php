<?php

require('../common.php');

if($_POST['imgsrc']){
    return unlink($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$_POST['imgsrc']);
}

?>