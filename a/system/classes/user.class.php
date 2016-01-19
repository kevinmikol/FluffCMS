<?
class user{
	function create($name, $username, $role, $pw, $email){
		global $db, $salt;
		$enpass = crypt($pw,$salt);
		$create_user = $db->prepare("INSERT INTO cms_users (name, username, role, password, created, email) VALUES (:name, :username, :role, :password, now(), :email)");
		$create_user->bindParam(':name', $name);
		$create_user->bindParam(':username', $username);
		$create_user->bindParam(':role', $role);
		$create_user->bindParam(':password', $enpass);
        $create_user->bindParam(':email', $email);
		$create_user->execute();
	}
	function edit($id){
		global $db;
		$edit_user = $db->prepare("SELECT * FROM cms_users WHERE id = :id");
		$edit_user->bindParam(':id', $id);
		$edit_user->execute();
		$array = $edit_user->fetch(PDO::FETCH_OBJ);
        unset($array->password);
        unset($array->auth);
		return json_encode($array);
	}
	function update($id, $role, $name, $username, $email){
		global $db;
		$update_user = $db->prepare("UPDATE cms_users SET role = :role, name = :name, username = :username, email = :email WHERE id = :id");
		$update_user->bindParam(':id', $id);
		$update_user->bindParam(':role', $role);
		$update_user->bindParam(':name', $name);
		$update_user->bindParam(':username', $username);
        $update_user->bindParam(':email', $email);
		$update_user->execute();
	}
	function delete($id){
		global $db;
		$delete_user = $db->prepare("DELETE FROM cms_users WHERE id = :id");
		$delete_user->bindParam(':id', $id);
		$delete_user->execute();
	}
    function resetPW($auth, $password){
        global $db, $salt;
		$enpass = crypt($password,$salt);
		$update_user = $db->prepare("UPDATE cms_users SET password = :password WHERE auth = :auth");
		$update_user->bindParam(':auth', $auth);
        $update_user->bindParam(':password', $enpass);
		$update_user->execute();
	}
    function updatePW($id, $password){
        global $db, $salt;
		$enpass = crypt($password,$salt);
		$update_user = $db->prepare("UPDATE cms_users SET password = :password WHERE id = :id");
		$update_user->bindParam(':id', $id);
        $update_user->bindParam(':password', $enpass);
		$update_user->execute();
	}
}
?>