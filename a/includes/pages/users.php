<? if($_SESSION['adminrole'] > 3){ ?>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#usercurrent" data-toggle="tab" onClick="loadTable('users', null);"><i class="fa fa-list"></i> Current Users</a></li>
			<li><a href="#usercreate" data-toggle="tab"><i class="fa fa-plus-circle"></i> New User</a></li>
		</ul>
		<div class="tab-content">
            <div class="tab-pane" id="usercreate">
                <section>
                    <div id="usercreate">
                        <form class="create" data-type="user">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><i class="fa fa-info-circle"></i> User Information</h4>
                                            <div class="form-group">
                                                <input required type='text' id='name' name='name' placeholder='Full Name' class="form-control input-lg">
                                            </div>
                                            <div class="form-group">
                                                <input required type='email' id='email' name='email' placeholder='Email' class="form-control input-lg">
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4><i class="fa fa-user-secret"></i> Login Credentials</h4>
                                            <div class="form-group">
                                                <input required type='text' id='username' name='username' placeholder='Username' class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input required type='password' id='password' name='password' placeholder='Password' class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h4><i class="fa fa-suitcase"></i> User Role</h4>
                                            <div class="form-group">
                                                <select id="role" name="role" class="form-control">
                                                    <option value="0">Bystander</option>
                                                    <option value="1">Blogger</option>
                                                    <option value="2">Content Editor</option>
                                                    <option value="3">Content Creator</option>
                                                    <option value="4">Minute Admin</option>
                                                    <option value="5">Super Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="well">
                                        <p><strong>Bystander</strong> read access</p>
                                        <p><strong>Blogger</strong> posting ability</p>
                                        <p><strong>Editor</strong> content editing</p>
                                        <p><strong>Content Creator</strong> content creation</p>
                                        <p><strong>Admin</strong> mostly everything</p>
                                        <p><strong>Super</strong> the whole shabang</p>
                                    </div>
                                    <hr />
                                    <input type='hidden' id='type' name='type' value="user" />
                                    <input type='hidden' id='cb' name='cb' value="<?=$_SESSION['adminid'];?>" />
                                    <button type='submit' class='btn btn-success btn-lg pull-right'><i class="fa fa-plus-circle"></i> Create User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <div class="tab-pane active" id="usercurrent">
                <section id="users-table"></section>
             </div>
        </div>
	</div>
</div>
<? } ?>