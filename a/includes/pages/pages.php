<?php if($_SESSION['adminrole'] > 1){ ?>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#pagecurrent" data-toggle="tab"><i class="icon-list"></i> Current Pages</a></li>
			<?php if($_SESSION['adminrole'] > 2){ ?><li><a href="#pagecreate" data-toggle="tab"><i class="icon-plus-sign"></i> New Page</a></li><?php } ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="pagecreate">
			   <?php if($_SESSION['adminrole'] > 2){ ?>
					  <section id="pagecreate">
						<form class="create" data-type="page">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input required class="form-control input-lg" type="text" placeholder="page title" name="title" data-url-target="newPageURL" id="title">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control wysiwyg" name="content" id="content"></div>
                                        <textarea name="htmlcontent" id="htmlcontent" style="display:none;"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for='url'>URL</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><?=$baseurl?></div>
                                            <input required type='text' id='url' name='url' class="form-control newPageURL" placeholder='url' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for='template'>Template</label>
                                        <select required id='template' name='template' placeholder='Title' class="form-control">
                                            <?php foreach(glob($_SERVER['DOCUMENT_ROOT'].'/templates/*.php') as $template){
                                                    echo "<option>" . pathinfo($template, PATHINFO_FILENAME) . "</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for='featuredImage'>Featured Image</label>
                                        <div class="image-box">
                                            <a class="btn btn-sm btn-danger deleteImage"><i class="fa fa-trash"></i></a>
                                            <img id="newPagePreview" src="#" alt="your image">
                                            <input type='file' class="theImage" data-target="newPagePreview" id="file" name="featuredImage" style="display:none;" data-loading-text="Uploading..."/>
                                            <a class="btn btn-info btn-upload">Upload Image</a>
                                            <input type="hidden" name="featuredImage" class="imgurl" id="featuredImage" />
                                        </div>
                                    </div>
                                    <hr />
                                    <button type='submit' class='btn btn-success btn-lg pull-right'><i class="fa fa-plus-circle"></i> Create Page</button>
                                </div>
                            </div>
                          <input type='hidden' id='cb' name='cb' value="<?=$_SESSION['adminid'];?>" />
                          <input type='hidden' id='type' name='type' value="page" />
				        </form>
					</section>
				<?php } ?>
		  </div>
		  <div class="tab-pane active" id="pagecurrent">
			<section id="pagetable">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover table-striped" id="page-table">
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Last Updated</th>
                            <th>Created</th>
                        </tr>
                        <?php
                            $page = $db->prepare("SELECT * FROM cms_pages");
                            $page->execute();
                            $page = $page->fetchAll();
                            foreach($page as $info){ ?>
                            <tr id="<?=$info['id']?>">
                                <td>
                                    <button class="btn btn-warning" onClick="edit('page', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                                    <?php if($_SESSION['adminrole'] > 2){ ?><a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="page" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="fa fa-trash"></i></a><?php } ?>
                                    <a class="btn btn-info" href="<?=$baseurl.$info['url'];
			?>" target="_blank"><i class="fa fa-external-link"></i></a>
                                </td>
                                <td><h4><?=$info['title']?> <small><?=$info['template']?></small></h4></td>
                                <td><?="/".$info['url']?></td>
                                <td><?=humanDate($info['updated'])?> <small>by <?=humanName($info['ub']);?></small></td>
                                <td><?=humanDate($info['created'])?> <small>by <?=humanName($info['cb']);?></small></td>
                            </tr>
                        <?php } ?>
                        </table>
                    </div>
                </div>
			 </section>
		  </div>
		</div>
	</div>
</div>
<?php } ?>