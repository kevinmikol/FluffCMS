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
	function update($id, $target, $text, $url, $type, $attr){
		global $db;
		$link_update = $db->prepare("UPDATE cms_navigation SET text = :text, url = :url, type = :type, target = :target, attr = :attr WHERE id = :id");
		$link_update->bindParam(':id', $id);
		$link_update->bindParam(':target', $target);
		$link_update->bindParam(':text', $text);
		$link_update->bindParam(':url', $url);
		$link_update->bindParam(':type', $type);
		$link_update->bindParam(':attr', $attr);
		$link_update->execute();
	}
	function delete($id){
		global $db;
		$delete_link = $db->prepare("DELETE FROM cms_navigation WHERE id = :id");
		$delete_link->bindParam(':id', $id);
		$delete_link->execute();
	}
    function reorder($list){
        foreach ($list as $value) {
            $navigation = $db->prepare("UPDATE cms_navigation SET `parent_id` = :parent_id, `depth` = :depth, `left` = :left, `right` = :right WHERE `id` = :id");
            $navigation->bindParam(':id', $value['id']);
            $navigation->bindParam(':parent_id', $value['parent_id']);
            $navigation->bindParam(':depth', $value['depth']);
            $navigation->bindParam(':left', $value['left']);
            $navigation->bindParam(':right', $value['right']);
            $navigation->execute();
        }
    }
}
?>