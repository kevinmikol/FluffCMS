<?php
class load{
    function page(){
        global $db, $_SESSION, $baseurl;
		foreach (glob("includes/pages/*.php") as $filename){
			$strip = array("includes/pages/", ".php");
			$clean = str_replace($strip, "", $filename);
			$divn = $clean;
			
			echo "<section data-page='". $divn."' style='display:none;'>";
			include $filename;
			echo "</section>";
		}
	}
	 function modal(){
        global $db, $_SESSION, $baseurl;
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