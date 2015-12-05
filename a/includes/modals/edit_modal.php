	<!-- Editor Modal -->
	<div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<div id="myModalLabel">
			<h3><i class="icon-edit"></i> <span class="type"></span>  Editor - <span class="title"></span></h3>
		</div>
	  </div>
	  <div class="modal-body">
			<!--Start PAGE Editor-->
			<form id="update" class="page">
				<label for='title'>Title</label>
			 	<input required type='text' id='title' name='title' placeholder='Title' />
			 	<label for='url'>Page URL</label>
				<div class='controls input-prepend'>
				<span class="add-on"><? echo $baseurl; ?></span>
			  	<input required type='text' id='url' name='url' placeholder='URL' class="span2" />
			  	</div>
				<label for='pageedit'>Content</label>
				<textarea class="ckeditor" id="pageedit" name="content"></textarea>
				<input type='hidden' class='type' name='type' value="page"/>
				<input type='hidden' id='id' name='id'  />
			</form>
			<!--End PAGE Editor-->
			<!--Start BLOCK Editor-->
			<form id="update" class="block">
				<label for='title'>Title</label>
				<input required type='text' id='title' name='title' placeholder='Title' />
				<label for='blockedit'>Content</label>
				<textarea class="ckeditor" id="blockedit" name="content"></textarea>
				<input type='hidden' class='type' name='type'  value="block" />
				<input type='hidden' id='id' name='id'  />
			</form>
			<!--End BLOCK Editor-->
			<!--Start USER Editor-->
			<form id="update" class="user">
				<label for='name'>Name</label>
				<input required type='text' id='name' name='name' placeholder='Full Name'>
				<label for='username'>Username</label>
				<input required type='text' id='username' name='username' placeholder='Username'>
				<label for='role'>Role</label>
				  <select id="role" name="role">
						<option value="0">Bystander</option>
						<option value="1">Blogger</option>
						<option value="2">Content Editor</option>
						<option value="3">Content Creator</option>
						<option value="4">Minute Admin</option>
						<option value="5">Super Admin</option>
				  </select>
				<input type='hidden' class='type' name='type' value="user" />
			</form>
			<!--End USER Editor-->
			<!--Start NAVIGATION Editor-->
			<form id="update" class="navigation">
				<label>Link Text</label>
					<input required type="text" name='text' class="text navtext" id="editnavtext" placeholder="About Us" />
				<br />
				<br />
				<label>Link Type</label>
				<label class="radio">
				  <input type="radio" name="linktype" class="local" value="0">
				  Local Link
				</label>
				<label class="radio">
				  <input type="radio" name="linktype" class="external" value="1">
				  External Link
				</label>
				<br />
				<label>Link URL</label>
				<div class='input-prepend navaddurl' style="margin-bottom:20px;">
					<span class="add-on"><?=$baseurl ?></span>
					<input required type='text' name='url' id="navurl" class="navurl linkurl" placeholder='URL' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
				</div>
				<label>Target</label>
				<select required id="target" name="target">
					<option value="_self">Default</option>
					<option value="_blank">New Window/Tab</option>
					<option value="_top">Frame Top</option>
					<option value="_parent">Frame Parent</option>
				</select>
				<label>Attributes</label>
				<input type="text" name='attr' id="navattr" placeholder='class="icon icon-home" id="about"' />
				<input type='hidden' class='type' name='type' />
				<input type='hidden' name='id' class='id' />
			</form>
			<!--End NAVIGATION Editor-->
            <!--Start POST Editor-->
			<form id="update" class="post">
				n/a
			</form>
			<!--End PAGE Editor-->
	  </div>
	  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button class="btn btn-primary editSave btn-success" id="updateTrue" data-loading-text="Saving..."><i class="icon-check"></i> Save</button>
	  </div>
	</div>
			