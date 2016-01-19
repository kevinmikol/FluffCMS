<?
class link{
	function create($text, $url, $target, $linktype, $attr){
		global $db;
		$link_create = $db->prepare("INSERT INTO cms_navigation (url,text,target,type,attr,created) VALUES (:url,:text,:target,:type,:attr,now())");
		$link_create->bindParam(':text', $text);
		$link_create->bindParam(':url', $url);
		$link_create->bindParam(':target', $target);
		$link_create->bindParam(':type', $linktype);
		$link_create->bindParam(':attr', $attr);
		$link_create->execute();
	}
	function edit($id){
		global $db;
		$link_edit = $db->prepare("SELECT * FROM cms_navigation WHERE id = :id");
		$link_edit->bindParam(':id', $id);
		$link_edit->execute();
		$array = $link_edit->fetch(PDO::FETCH_OBJ);
		return json_encode($array);
	}
	function update($id, $role, $name, $username){
		global $db;
		$link_update = $db->prepare("UPDATE cms_navigation SET text = :text, url = :url, type = :type, target = :target, attr = :attr WHERE id = :id");
		$link_update->bindParam(':id', $id);
		$link_update->bindParam(':target', $_POST['target']);
		$link_update->bindParam(':text', $_POST['text']);
		$link_update->bindParam(':url', $_POST['url']);
		$link_update->bindParam(':type', $_POST['linktype']);
		$link_update->bindParam(':attr', $_POST['attr']);
		$link_update->execute();
	}
	function delete($id){
		global $db;
		$delete_link = $db->prepare("DELETE FROM cms_navigation WHERE id = :id");
		$delete_link->bindParam(':id', $id);
		$delete_link->execute();
	}
}
?>