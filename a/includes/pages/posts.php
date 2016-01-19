<? if($_SESSION['adminrole'] > 0){ ?>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#postcurrent" data-toggle="tab"><i class="fa fa-list"></i> Current Posts</a></li>
			<li><a href="#postcreate" data-toggle="tab"><i class="fa fa-plus-circle"></i> New Post</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="postcreate">
                  <section id="postcreate">
                    <form class="create" data-type="post">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required class="form-control input-lg" type="text" placeholder="post title" name="title">
                                </div>
                                <div class="form-group">
                                    <div class="form-control wysiwyg"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for='url'>URL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><?=$baseurl?></div>
                                        <input required type='text' id='url' name='url' class="form-control" placeholder='url' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for='featuredImage'>Featured Image</label>
                                    <div class="image-box">
                                        <img id="newPagePreview" src="#" alt="your image">
                                        <input type='file' class="theImage" data-target="newPagePreview" style="display:none;" name="featuredImage"/>
                                        <a class="btn btn-info btn-upload">Upload Image</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1">Published</option>
                                        <option value="0">Draft</option>
                                    </select>
                                </div>
                                <hr />
                                <button type='submit' class='btn btn-success btn-lg pull-right'><i class="fa fa-plus-circle"></i> Create Post</button>
                            </div>
                        </div>
                      <input type='hidden' id='cb' name='cb' value="<?=$_SESSION['adminid'];?>" />
                      <input type='hidden' id='type' name='type' value="post" />
                    </form>
                </section>
		  </div>
		  <div class="tab-pane active" id="postcurrent">
			<section id="posttable">
				<table class="table table-hover table-striped" id="post-table">
				<tr>
					<th></th>
                    <th>Title</th>
					<th>URL</th>
					<th>Last Updated</th>
                    <th>Created</th>
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
                    }?>
                    
					<tr id="<?=$info['id']?>">
                        <td>
                            <button class="btn btn-warning" onClick="edit('post', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                            <a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="post" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="fa fa-trash"></i></a>
                            <a class="btn btn-info" href="<?=$baseurl.$info['url'];?>" target="_blank"><i class="fa fa-external-link"></i></a>
                        </td>
                        <td><h4><?=$info['title']?> <small><?=$status?></small></h4></td>
                        <td><?=$info['url']?></td>
                        <td><?=humanDate($info['updated'])?> <small>by <?=humanName($info['ub']);?></small></td>
                        <td><?=humanDate($info['created'])?> <small>by <?=humanName($info['cb']);?></small></td>
                    </tr>
				<?} ?>
				</table>
			 </section>
		  </div>
		</div>
	</div>
</div>
<? } ?>