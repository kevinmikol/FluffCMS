<? if($user_role > 1){ ?>
<div class="row-fluid">
	<div class="span12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#blockcurrent" data-toggle="tab"><i class="icon-list"></i> Current Blocks</a></li>
			<? if($user_role > 2){ ?><li><a href="#blockcreate" data-toggle="tab"><i class="icon-plus-sign"></i> New Block</a></li><? } ?>
		</ul>
		<div class="tab-content">
		<? if($user_role > 2){ ?>
			<div class="tab-pane" id="blockcreate">
			 	<section id="blockcreate">
					<form class="create" data-type="block">
						<label for='title'>Title</label>
					 	<input required type='text' id='title' name='title' placeholder='Title'>
					 	<label for='role'>Content</label>
						<textarea class="ckeditor" id="blockcontent" name="content"></textarea>
						<input type='hidden' id='type' name='type' value="block" />
						<br />
						<button type='submit' class='btn btn-success pull-right'><i class="icon-plus-sign"></i> Create Block</button>
					</form>
				</section>
			</div>
			<? } ?>
			<div class="tab-pane active" id="blockcurrent">
				<section id="blocktable">
					<table class="table table-hover table-striped" id="block-table">
					<tr>
						<th>Block ID</th>
						<th>Title</th>
						<? if($user_role > 3){ ?><th>Object Usage Code</th><? } ?>
						<th>Actions</th>
						<th></th>
					</tr>
					<?php
					$blocks = $db->prepare("SELECT * FROM cms_blocks");
					$blocks->execute();
					$blocks = $blocks->fetchAll();
		
					foreach($blocks as $info){
						echo "<tr id='".$info['id']."'><td>"; 
						echo $info['id'];
						echo "</td><td>";
						echo $info['title'];
						echo "</td><td>";
						if($user_role > 3){
							echo '<input type="text" readonly value="$Block->load('.$info['id'].');" />';
                            echo "</td><td>";	
						}			
						?><button class="btn btn-warning" onClick="edit('block', '<?=$info['id']?>')"><i class="icon-edit"></i> Edit</button>
						<? if($user_role > 2){ ?><a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="block" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="icon-trash"></i> Delete</a><? } ?>
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