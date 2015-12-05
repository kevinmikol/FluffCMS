<? if($user_role > 1){ ?>
<div class="row-fluid">
	<div class="span12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#pagecurrent" data-toggle="tab"><i class="icon-list"></i> Current Pages</a></li>
			<? if($user_role > 2){ ?><li><a href="#pagecreate" data-toggle="tab"><i class="icon-plus-sign"></i> New Page</a></li><? } ?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane" id="pagecreate">
			   <? if($user_role > 2){ ?>
					  <section id="pagecreate">
						<form class="create" data-type="page">
								<label for='title'>Title</label>
								  <input required type='text' id='title' name='title' placeholder='Title'>
                                <label for='title'>Template</label>
								    <select required id='template' name='template' placeholder='Title'>
                                        <?php foreach(glob($_SERVER['DOCUMENT_ROOT'].'/templates/*') as $template){  
                                            echo "<option>" . pathinfo($template, PATHINFO_FILENAME) . "</option>";      
                                        } ?>
                                    </select>
								<label for='url'>Page URL</label>
								<div class='controls input-prepend'>
									<span class="add-on"><? echo $baseurl; ?></span>
									<input required type='text' id='url' name='url' class="input-small" placeholder='URL' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
								</div>
								<label for='content'>Content</label>
								  <textarea class="ckeditor" id="pagecontent" name="content"></textarea>
							  <input type='hidden' id='cb' name='cb' value="<?=$user_id; ?>" />
							  <input type='hidden' id='type' name='type' value="page" />
							  <br/>
							  <br/>
							  <button type='submit' class='btn btn-success pull-right'><i class="icon-plus-sign"></i> Create Page</button>
							</form>
					</section>
				<? } ?>
		  </div>
		  <div class="tab-pane active" id="pagecurrent">
			<section id="pagetable">
				<table class="table table-hover table-striped" id="page-table">
				<tr>
					<th>Page ID</th>
					<th>URL</th>
					<th>Title</th>
					<th>Created By</th>
					<th>Actions</th>
				</tr>
				<?php
				$page = $db->prepare("SELECT * FROM cms_pages");
				$page->execute();
				$page = $page->fetchAll();
	
				foreach($page as $info){
					echo "<tr id='".$info['id']."'><td>"; 
					echo $info['id'];
					echo "</td><td>"; 
					echo $info['url'];
					echo "</td><td>"; 
					echo $info['title']." <small class='label'>".$info['template']."</small>";
					echo "</td><td>"; 
					echo $info['cb'];
					echo "</td><td>";
					?><a class="btn btn-info" href="<?=$baseurl.$info['url'];?>" target="_blank"><i class="icon-external-link"></i> View</a>
					<button class="btn btn-warning" onClick="edit('page', '<?=$info['id']?>')"><i class="icon-edit"></i> Edit</button>
					<? if($user_role > 2){ ?><a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="page" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="icon-trash"></i> Delete</a><? } ?>
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