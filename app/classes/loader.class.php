<?php
class loader{
    public function module($name) {

        $file = "app/classes/".$name.".class.php";

        if (file_exists($file)) {
            include_once($file);
        }else{
            echo "Class '".$name."' not found at '".$file."'.";
        }
 
        return new $name();
    }
}
?>