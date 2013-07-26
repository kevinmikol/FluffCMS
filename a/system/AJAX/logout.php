<?php
session_start();
if(isset($_SESSION['siteadmin']))
    unset($_SESSION['adminid']);
    unset($_SESSION['adminname']);
    unset($_SESSION['adminusername']);
    unset($_SESSION['siteadmin']);
	
	session_destroy();
	
    echo "<script type='text/javascript'>window.location = '../../../admin'</script>";
	?>