<?php
class block{
    function load($id){
		global $db;
		
		//Load from Database
		$load_block = $db->prepare("SELECT * FROM cms_blocks WHERE id = :id LIMIT 1");
		$load_block->bindParam(':id', $id);
		$load_block->execute();
		$theBlock = $load_block->fetch(PDO::FETCH_OBJ);
		
        return $theBlock;
    }
}
?>
