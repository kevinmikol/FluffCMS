<?
class block{
	function create($title, $content, $cb){
		global $db;
        echo $content;
		$create_block = $db->prepare("INSERT INTO cms_blocks (title, content, created, cb) VALUES (:title, :content, now(), :cb)");
		$create_block->bindParam(':title', $title);
		$create_block->bindParam(':content', $content);
        $create_block->bindParam(':cb', $cb);
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
	function update($id, $title, $content, $ub){
		global $db;
		$update_block = $db->prepare("UPDATE cms_blocks SET title = :title, content = :content, ub = :ub WHERE id = :id");
		$update_block->bindParam(':id', $id);
		$update_block->bindParam(':title', $title);
		$update_block->bindParam(':content', $content);
        $update_block->bindParam(':ub', $ub);
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