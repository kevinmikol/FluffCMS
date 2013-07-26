<? if($user_role > 3){ ?>
<div class="row-fluid">
	<div class="span12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#usercurrent" data-toggle="tab"><i class="icon-list"></i> Current Users</a></li>
			<li><a href="#usercreate" data-toggle="tab"><i class="icon-plus-sign"></i> New User</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="usercreate">
			  <div id="usercreate" class="span5">
				<form class="create" data-type="user">
					<label for='name'>Name</label>
					<input required type='text' id='name' name='name' placeholder='Full Name'>
					<label for='username'>Username</label>
					<input required type='text' id='username' name='username' placeholder='Username'>
					<label for='password'>Password</label>
					<input required type='password' id='password' name='password' placeholder='Password'>
					<label for='role'>Role</label>
					  <select id="role" name="role">
						<option value="0">Bystander</option>
						<option value="1">Blogger</option>
						<option value="2">Content Editor</option>
						<option value="3">Content Creator</option>
						<option value="4">Minute Admin</option>
						<option value="5">Super Admin</option>
					  </select>
					  <input type='hidden' id='type' name='type' value="user" />
					  <br />
					  <br />
					  <button type='submit' class='btn btn-success'><i class="icon-plus-sign"></i> Create User</button>
				</form>
			</div>
			<div class="span3 pull-right well muted">
				<p><strong>Bystander</strong> only CMS viewing</p>
				<p><strong>Blogger</strong> only blog access</p>
				<p><strong>Content Editor</strong> page/block editing</p>
				<p><strong>Content Creator</strong> page/block creation</p>
				<p><strong>Minute Admin</strong> user management</p>
				<p><strong>Super Admin</strong> everything</p>
			</div>
		</div>
		<div class="tab-pane active" id="usercurrent">
			<section id="usertable">
				<table class="table table-hover table-striped" id="user-table">
				<tr>
					<th>User ID</th>
					<th>Username</th>
					<th>Name</th>
					<th>Role</th>
					<th>Actions</th>
				</tr>
				<?php
				function role($num){ 
				  if($num == 0){
					  echo "Bystander";
				  }else if($num == 1){
					  echo "Content Editor";
				  }else if($num == 2){
					  echo "Minute Admin";
				  }else if($num == 3){
					  echo "Super Admin";
				  }
				}

				$users = $db->prepare("SELECT * FROM cms_users");
				$users->execute();
				$users = $users->fetchAll();
		
				foreach($users as $info){
					if($user_role !== 5 AND $info['role'] == 5){continue;}
					echo "<tr id='".$info['id']."'><td>"; 
					echo $info['id'];
					echo "</td><td>";
					echo $info['username'];
					echo "</td><td>";
					echo $info['name'];
					echo "</td><td>"; 
					role($info['role']);
					echo "</td><td>"; 					
					?><button class="btn btn-warning" onClick="edit('user', '<?=$info['id']?>')"><i class="icon-edit"></i> Edit</button>
					  <a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="user" data-id="<?=$info['id']?>" data-title="<?=$info['username']?>"><i class="icon-trash"></i> Delete</a>
					</td>
				<?} 
				?>
				</table>
			 </section>
		 </div>
	</div>
</div>
<? } ?>