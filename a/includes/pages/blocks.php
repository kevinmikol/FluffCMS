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
						<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required class="form-control input-lg" type="text" placeholder="block title" name="title">
                                </div>
                                <div class="form-group">
                                    <div class="form-control wysiwyg"></div>
                                </div>
                                <input type='hidden' id='type' name='type' value="block" />
                                <button type='submit' class='btn btn-lg btn-success pull-right'><i class="fa fa-plus"></i> Create Block</button>
                            </div>
                        </div>
                    </form>
				</section>
			</div>
			<? } ?>
			<div class="tab-pane active" id="blockcurrent">
				<section id="blocktable">
					<table class="table table-hover table-striped" id="block-table">
					<tr>
                        <th></th>
						<th>Title</th>
                        <th>ID</th>
						<? if($user_role > 3){ ?><th>Object Usage Code</th><? } ?>
						<th>Last Updated</th>
                        <th>Created</th>
					</tr>
					<?php
					$blocks = $db->prepare("SELECT * FROM cms_blocks");
					$blocks->execute();
					$blocks = $blocks->fetchAll();
		
					foreach($blocks as $info){?>
						<tr id="<?=$info['id']?>">
                            <td>
                                <button class="btn btn-warning" onClick="edit('block', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                                <? if($user_role > 2){ ?><a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="block" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="fa fa-trash"></i></a><? } ?>
                            </td>
                            <td><h4><?=$info['title']?></h4></td>
                            <td><?=$info['id']?></td>
                            <? if($user_role > 3){ ?><td><input type="text" readonly value="$Block->load('<?=$info['id']?>');" /></td><? } ?>
                            <td><?=humanDate($info['updated'])?> <small>by <?=humanName($info['ub']);?></small></td>
                            <td><?=humanDate($info['created'])?> <small>by <?=humanName($info['cb']);?></small></td>
                            
					<? } ?>
					</table>
				 </section>
			</div>
		</div>
	</div>
</div>
<? } ?>