<?php
    session_start();

    if(isset($_SESSION['siteadmin'])){
        unset($_SESSION['adminid']);
        unset($_SESSION['adminname']);
        unset($_SESSION['adminusername']);
        unset($_SESSION['siteadmin']);

        session_destroy();
    }
	
    echo '<meta http-equiv="refresh" content="0; url='.$baseurl.'a">';
    die;
?>