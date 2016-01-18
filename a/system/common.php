<?php

    session_start();

    date_default_timezone_set('America/Chicago');

    if(!isset($_SESSION['siteadmin'])){
        require('includes/signin.php');
        die;
    }else{
        $_SESSION['adminname'] = $_SESSION['adminname'];
        $_SESSION['adminrole'] = $_SESSION['adminrole'];
        $_SESSION['adminusername'] = $_SESSION['adminusername'];
        $_SESSION['adminid'] = $_SESSION['adminid'];
    }

    require($_SERVER['DOCUMENT_ROOT'].'/config.php');

    //Set Database
    $db = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);

    function humanDate($input){
        $time = strtotime($input);
        if($time == 0)
            return null;
        else
            return date("F j, Y g:i a [T]", $time);
    }

    function humanRole($int){
        switch($int){
            case 0:
                return "Bystander";
            case 1:
                return "Blogger";
            case 2:
                return "Editor";
            case 3:
                return "Creator";
            case 4:
                return "Admin";
            case 5:
                return "Super";
            default:
                return null;
        }
    }

    function humanName($id){
        global $db;
        $stmt = $db->prepare('SELECT `name` FROM `cms_users` WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $name = $stmt->fetch()[0];
        if($name == null)
            return "unknown";
        else
            return $name;
    }

    function getDomain($url){
        return parse_url($url)['host'];
    }

    function getGravatar( $email, $s = 80, $d = 'identicon', $r = 'g', $img = false, $atts = array() ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

?>