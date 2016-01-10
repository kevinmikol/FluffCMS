<?php if($user_role > 1){ ?>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#pagecurrent" data-toggle="tab"><i class="icon-list"></i> Current Pages</a></li>
			<?php if($user_role > 2){ ?><li><a href="#pagecreate" data-toggle="tab"><i class="icon-plus-sign"></i> New Page</a></li><?php } ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="pagecreate">
			   <?php if($user_role > 2){ ?>
					  <section id="pagecreate">
						<form class="create" data-type="page">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input required class="form-control input-lg" type="text" placeholder="page title">
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
                                        <label for='template'>Template</label>
                                        <select required id='template' name='template' placeholder='Title' class="form-control">
                                            <?php foreach(glob($_SERVER['DOCUMENT_ROOT'].'/templates/*.php') as $template){
                                                    echo "<option>" . pathinfo($template, PATHINFO_FILENAME) . "</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <button type='submit' class='btn btn-success btn-lg pull-right'><i class="icon-plus-sign"></i> Create Page</button>
                                </div>
                            </div>
                          <input type='hidden' id='cb' name='cb' value="<?=$user_id;
			?>" />
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
                                    <?php if($user_role > 2){ ?><a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="page" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="fa fa-trash"></i></a><?php } ?>
                                    <a class="btn btn-info" href="<?=$baseurl.$info['url'];
			?>" target="_blank"><i class="fa fa-external-link"></i></a>
                                </td>
                                <td><h4><?=$info['title']?> <small><?=$info['template']?></small></h4></td>
                                <td><?="/".$info['url']?></td>
                                <td><?=humanDate($info['updated'])?></td>
                                <td><?=humanDate($info['created'])?> <small>by <?=$info['cb'];?></small></td>
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