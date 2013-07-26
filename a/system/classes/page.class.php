<?
class page{
	function create($title, $url, $content, $cb){
		global $db;
		$create_page = $db->prepare("INSERT INTO cms_pages (title, url, content, cb) VALUES (:title, :url, :content, :cb)");
		$create_page->bindParam(':title', $title);
		$create_page->bindParam(':url', $url);
		$create_page->bindParam(':content', $content);
		$create_page->bindParam(':cb', $cb);
		$create_page->execute();
	}
	function edit($id){
		global $db;
		$edit_page = $db->prepare("SELECT * FROM cms_pages WHERE id = :id");
		$edit_page->bindParam(':id', $id);
		$edit_page->execute();
		$array = $edit_page->fetch(PDO::FETCH_OBJ);		echo json_encode($array);
	}
	function update($title, $url, $content, $id){
		global $db;
		$update_page = $db->prepare("UPDATE cms_pages SET title = :title, url = :url, content = :content WHERE id = :id");
		$update_page->bindParam(':id', $id);
		$update_page->bindParam(':title', $title);
		$update_page->bindParam(':url', $url);
		$update_page->bindParam(':content', $content);
		$update_page->execute();
	}
	function delete($id){
		global $db;
		$delete_page = $db->prepare("DELETE FROM cms_pages WHERE id = :id");
		$delete_page->bindParam(':id', $id);
		$delete_page->execute();
	}
}
?>