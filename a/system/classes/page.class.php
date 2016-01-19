<?
class page{
	function create($title, $url, $template, $content, $cb, $template, $image){
		global $db;
		$create_page = $db->prepare("INSERT INTO cms_pages (title, url, template, content, cb, created, image) VALUES (:title, :url, :template, :content, :cb, now(), :image)");
		$create_page->bindParam(':title', $title);
		$create_page->bindParam(':url', $url);
        $create_page->bindParam(':template', $template);
		$create_page->bindParam(':content', $content);
		$create_page->bindParam(':cb', $cb);
        $create_page->bindParam(':image', $image);
		$create_page->execute();
	}
	function edit($id){
		global $db;
		$edit_page = $db->prepare("SELECT * FROM cms_pages WHERE id = :id");
		$edit_page->bindParam(':id', $id);
		$edit_page->execute();
		$array = $edit_page->fetch(PDO::FETCH_OBJ);
        return json_encode($array);
	}
	function update($title, $url, $content, $id, $ub, $template, $image){
		global $db;
		$update_page = $db->prepare("UPDATE cms_pages SET title = :title, url = :url, content = :content, ub = :ub, template = :template, image = :image WHERE id = :id");
		$update_page->bindParam(':id', $id);
		$update_page->bindParam(':title', $title);
		$update_page->bindParam(':url', $url);
		$update_page->bindParam(':content', $content);
        $update_page->bindParam(':ub', $ub);
        $update_page->bindParam(':template', $template);
        $update_page->bindParam(':image', $image);
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