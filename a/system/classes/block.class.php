<?
class block{
	function create($title, $content){
		global $db;
		$create_block = $db->prepare("INSERT INTO cms_blocks (title, content, created) VALUES (:title, :content, now())");
		$create_block->bindParam(':title', $title);
		$create_block->bindParam(':content', $content);
		$create_block->execute();
	}
	function edit($id){
		global $db;
		$edit_block = $db->prepare("SELECT * FROM cms_blocks WHERE id = :id");
		$edit_block->bindParam(':id', $id);
		$edit_block->execute();
		$array = $edit_block->fetch(PDO::FETCH_OBJ);
		return json_encode($array);
	}
	function update($title, $content, $id){
		global $db;
		$update_block = $db->prepare("UPDATE cms_blocks SET title = :title, content = :content WHERE id = :id");
		$update_block->bindParam(':id', $id);
		$update_block->bindParam(':title', $title);
		$update_block->bindParam(':content', $content);
		$update_block->execute();
	}
	function delete($id){
		global $db;
		$delete_block = $db->prepare("DELETE FROM cms_blocks WHERE id = :id");
		$delete_block->bindParam(':id', $id);
		$delete_block->execute();
	}
}
?>