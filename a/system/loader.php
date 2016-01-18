<?php
class load{
    function page(){
        global $db, $user_name, $user_role, $user_username, $user_id, $baseurl;
		foreach (glob("includes/pages/*.php") as $filename){
			$strip = array("includes/pages/", ".php");
			$clean = str_replace($strip, "", $filename);
			$divn = $clean;
			
			echo "<section id='". $divn."' style='display:none;'>";
			include $filename;
			echo "</section>";
		}
	}
	 function modal(){
        global $db, $user_name, $user_role, $user_username, $user_id, $baseurl;
		foreach (glob("includes/modals/*.php") as $filename){
			$strip = array("includes/modals/", ".php");
			$clean = str_replace($strip, "", $filename);
			$divn = $clean;
			
			echo "<div id='". $divn."'>";
			include $filename;
			echo "</div>";
		}
	}

}
?>