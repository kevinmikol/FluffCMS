<? if($user_role > 0){ ?>
<div class="row-fluid">
	<div class="span12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#postcurrent" data-toggle="tab"><i class="icon-list"></i> Current Posts</a></li>
			<li><a href="#postcreate" data-toggle="tab"><i class="icon-plus-sign"></i> New Post</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="postcreate">
                  <section id="postcreate">
                    <form class="create" data-type="page">
                            <label for='title'>Title</label>
                              <input required type='text' id='title' name='title' placeholder='Title'>
                            <label for='url'>Smart URL</label>
                            <div class='controls input-prepend'>
                                <span class="add-on"><? echo $baseurl; ?></span>
                                <input required type='text' id='url' name='url' class="input-small" placeholder='URL' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
                            </div>
                            <label for='cb'>Created By</label>
                            <select id='cb' name='cb' value="<?=$user_name; ?>">
                            <?php
                                $usernames = $db->prepare("SELECT username, id FROM cms_users");
                                $usernames->execute();
                                $usernames = $usernames->fetchAll();
                                foreach($usernames as $user){ ?>
                                    <option value="<?=$user['id']?>"><?=$user['username']?></option>
                            <?  } ?>
                            </select>
                            <label for='content'>Content</label>
                              <textarea class="ckeditor" id="pagecontent" name="content"></textarea>
                             <input type='hidden' id='type' name='type' value="post" />
                          <br/>
                          <br/>
                          <button type='submit' class='btn btn-success pull-right'><i class="icon-plus-sign"></i> Create Post</button>
                        </form>
                </section>
		  </div>
		  <div class="tab-pane active" id="postcurrent">
			<section id="posttable">
				<table class="table table-hover table-striped" id="post-table">
				<tr>
					<th>Post ID</th>
					<th>URL</th>
					<th>Title</th>
					<th>Created By</th>
					<th>Actions</th>
				</tr>
				<?php
				$page = $db->prepare("SELECT * FROM cms_posts");
				$page->execute();
				$page = $page->fetchAll();
	
				foreach($page as $info){
                    
                    switch($status){
                        case 0:
                            $status = "draft";
                            break;
                        case 1:
                            $status = "published";
                            break;
                    }
                    
					echo "<tr id='".$info['id']."'><td>"; 
					echo $info['id'];
					echo "</td><td>"; 
					echo $info['url'];
					echo "</td><td>"; 
					echo $info['title']." <small class='label'>".$status."</small>";
					echo "</td><td>"; 
					echo $info['cb'];
					echo "</td><td>";
					?><a class="btn btn-info" href="<?=$baseurl.$info['url'];?>" target="_blank"><i class="icon-external-link"></i> View</a>
					<button class="btn btn-warning" onClick="edit('post', '<?=$info['id']?>')"><i class="icon-edit"></i> Edit</button>
					<a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="post" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="icon-trash"></i> Delete</a>
					</td>
				<?} 
				?>
				</table>
			 </section>
		  </div>
		</div>
	</div>
</div>
<? } ?>