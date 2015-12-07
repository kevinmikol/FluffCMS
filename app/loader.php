<?php

    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require('classes/loader.class.php');

    //Set Database
    $db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);
    
    //Begin loader object
    $load = new loader();
    
    //Load class "page"
    $Page = $load->module('page');
    
        //The class of page has a lot of functions as seen below which help the correct page load.

        //Get URL
        $CurrentURL = ltrim($_GET['url'], "/");
        
        //Process the URL to detect anything special
        if($CurrentURL !== NULL) $parts = explode("/", $CurrentURL);
        if(isset($SpecialURLs[$parts[0]]))
            $CurrentURL = $SpecialURLs[$parts[0]];
        
        //Initalize the page
        $CurrentPage = $Page->init($CurrentURL);

        //If it's a 404 page, redirect it
        if($CurrentPage == 404)
            echo '<meta http-equiv="refresh" content="0; url='.$baseurl.'404">';

    //Load additional Modules
    $Block = $load->module('block');
    $Post = $load->module('post');
    $Navigation = $load->module('navigation');

?>