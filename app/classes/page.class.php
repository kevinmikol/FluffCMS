<?php
    class page{
        function init($url){
            global $db, $sitetitle, $baseurl;

            //Load from Database
            $load_page = $db->prepare("SELECT * FROM cms_pages WHERE url = :url LIMIT 1");
            $load_page->bindParam(':url', $url);
            $load_page->execute();
            $page_count = $load_page->rowCount();
            $currentpage = $load_page->fetch(PDO::FETCH_OBJ);

            //if nothing found
            if($page_count == 0 && $url !== "404")
                return 404;

            //set site title
            $currentpage->sitetitle = $currentpage->title.' &#183; '.$sitetitle;

            //return the object
            return $currentpage;
        }
    }
?>
