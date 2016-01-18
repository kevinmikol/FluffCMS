<? if($user_role > 3){ ?>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#usercurrent" data-toggle="tab"><i class="icon-list"></i> Current Users</a></li>
			<li><a href="#usercreate" data-toggle="tab"><i class="icon-plus-sign"></i> New User</a></li>
		</ul>
		<div class="tab-content">
            <div class="tab-pane" id="usercreate">
                <section>
                    <div id="usercreate">
                        <form class="create" data-type="user">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input required type='text' id='name' name='name' placeholder='Full Name' class="form-control input-lg">
                                    </div>
                                    <div class="form-group">
                                        <input required type='email' id='email' name='email' placeholder='Email' class="form-control input-lg">
                                    </div>
                                    <div class="form-group">
                                        <input required type='text' id='username' name='username' placeholder='Username' class="form-control input-lg">
                                    </div>
                                    <div class="form-group">
                                        <input required type='password' id='password' name='password' placeholder='Password' class="form-control input-lg">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="well">
                                        <p><strong>Bystander</strong> only CMS viewing</p>
                                        <p><strong>Blogger</strong> only blog access</p>
                                        <p><strong>Content Editor</strong> page/block editing</p>
                                        <p><strong>Content Creator</strong> page/block creation</p>
                                        <p><strong>Minute Admin</strong> user management</p>
                                        <p><strong>Super Admin</strong> everything</p>
                                    </div>
                                    <div class="form-group">
                                        <label for='role'>Role</label>
                                        <select id="role" name="role" class="form-control">
                                            <option value="0">Bystander</option>
                                            <option value="1">Blogger</option>
                                            <option value="2">Content Editor</option>
                                            <option value="3">Content Creator</option>
                                            <option value="4">Minute Admin</option>
                                            <option value="5">Super Admin</option>
                                        </select>
                                    </div>
                                    <input type='hidden' id='type' name='type' value="user" />
                                    <input type='hidden' id='cb' name='cb' value="<?=$user_id;?>" />
                                    <button type='submit' class='btn btn-success btn-large'><i class="fa fa-plus"></i> Create User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <div class="tab-pane active" id="usercurrent">
                <section id="usertable">
                    <table class="table table-hover table-striped" id="user-table">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Last Login</th>
                    </tr>
                    <?php

                    $users = $db->prepare("SELECT * FROM cms_users");
                    $users->execute();
                    $users = $users->fetchAll();

                    foreach($users as $info){
                        echo $user_role !== '5';
                        if($user_role !== '5' AND $info['role'] == '5'){continue;} ?>

                        <tr id="<?=$info['id'];?>">
                            <td>
                                <button class="btn btn-warning" onClick="edit('user', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                                <a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="user" data-id="<?=$info['id']?>" data-title="<?=$info['username']?>"><i class="fa fa-trash"></i></a>
                            </td>
                            <td><h4><?=$info['name'];?> <small><?=humanRole($info['role']);?></small></h4></td>
                            <td><?=$info['username'];?></td>
                            <td><?=humanDate($info['last_login'])?></td>
                        </tr>
                    <? } ?>
                    </table>
                 </section>
             </div>
        </div>
	</div>
</div>
<? } ?>