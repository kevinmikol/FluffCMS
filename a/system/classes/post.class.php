<?
class post{
	function create($title, $url, $content, $cb, $image, $status){
		global $db;
		$create_post = $db->prepare("INSERT INTO cms_posts (title, url, content, cb, created, image, status) VALUES (:title, :url, :content, :cb, now(), :image, :status)");
		$create_post->bindParam(':title', $title);
		$create_post->bindParam(':url', $url);
		$create_post->bindParam(':content', $content);
		$create_post->bindParam(':cb', $cb);
        $create_post->bindParam(':image', $image);
        $create_post->bindParam(':status', $status);
		$create_post->execute();
	}
	function edit($id){
		global $db;
		$edit_post = $db->prepare("SELECT * FROM cms_posts WHERE id = :id");
		$edit_post->bindParam(':id', $id);
		$edit_post->execute();
		$array = $edit_post->fetch(PDO::FETCH_OBJ);
        return json_encode($array);
	}
	function update($title, $url, $content, $id, $ub, $image, $status){
		global $db;
		$update_post = $db->prepare("UPDATE cms_posts SET title = :title, url = :url, content = :content, ub = :ub, image = :image, status = :status WHERE id = :id");
		$update_post->bindParam(':id', $id);
		$update_post->bindParam(':title', $title);
		$update_post->bindParam(':url', $url);
		$update_post->bindParam(':content', $content);
        $update_post->bindParam(':ub', $ub);
        $update_post->bindParam(':status', $status);
        $update_post->bindParam(':image', $image);
		$update_post->execute();
	}
	function delete($id){
		global $db;
		$delete_post = $db->prepare("DELETE FROM cms_posts WHERE id = :id");
		$delete_post->bindParam(':id', $id);
		$delete_post->execute();
	}
}
?>