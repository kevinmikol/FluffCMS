<?
class user{
	function create($name, $username, $role, $pw){
		global $db, $salt;
		$enpass = crypt($pw,$salt);
		$create_user = $db->prepare("INSERT INTO cms_users (name, username, role, password) VALUES (:name, :username, :role, :password)");
		$create_user->bindParam(':name', $name);
		$create_user->bindParam(':username', $username);
		$create_user->bindParam(':role', $role);
		$create_user->bindParam(':password', $enpass);
		$create_user->execute();
	}
	function edit($id){
		global $db;
		$edit_user = $db->prepare("SELECT * FROM cms_pages WHERE id = :id");
		$edit_user->bindParam(':id', $id);
		$edit_user->execute();
		$array = $edit_user->fetch(PDO::FETCH_OBJ);
		echo json_encode($array);
	}
	function update($id, $role, $name, $username){
		global $db;
		$update_user = $db->prepare("UPDATE cms_users SET role = :role, name = :name, username = :username WHERE id = :id");
		$update_user->bindParam(':id', $id);
		$update_user->bindParam(':role', $role);
		$update_user->bindParam(':name', $name);
		$update_user->bindParam(':username', $username);
		$update_user->execute();
	}
	function delete($id){
		global $db;
		$delete_user = $db->prepare("DELETE FROM cms_pages WHERE id = :id");
		$delete_user->bindParam(':id', $id);
		$delete_user->execute();
	}
}
?>