<?php
    class post{
        function fetchAll(){
            global $db, $sitetitle, $baseurl;

            //Load from Database
            $fetch_posts = $db->prepare("SELECT * FROM cms_posts");
            $fetch_posts->execute();
            $the_posts = $fetch_posts->fetch(PDO::FETCH_OBJ);
            
            //return the object
            return $the_posts;
        }
    }
?>
