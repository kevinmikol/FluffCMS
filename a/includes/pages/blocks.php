<? if($_SESSION['adminrole'] > 1){ ?>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs" id="tabs">
			<li class="active"><a href="#blockcurrent" data-toggle="tab" onClick="loadTable('blocks', null);"><i class="fa fa-list"></i> Current Blocks</a></li>
			<? if($_SESSION['adminrole'] > 2){ ?><li><a href="#blockcreate" data-toggle="tab"><i class="fa fa-plus-circle"></i> New Block</a></li><? } ?>
		</ul>
		<div class="tab-content">
		<? if($_SESSION['adminrole'] > 2){ ?>
			<div class="tab-pane" id="blockcreate">
			 	<section id="blockcreate">
					<form class="create" data-type="block">
						<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required class="form-control input-lg" type="text" placeholder="block title" name="title" id="title">
                                </div>
                                <div class="form-group">
                                    <div class="form-control wysiwyg" name="content" id="content"></div>
                                    <textarea name="htmlcontent" id="htmlcontent" style="display:none;"></textarea>
                                </div>
                                <input type='hidden' id='type' name='type' value="block" />
                                <input type='hidden' id='cb' name='cb' value="<?=$_SESSION['adminid'];?>" />
                                <button type='submit' class='btn btn-lg btn-success pull-right'><i class="fa fa-plus-circle"></i> Create Block</button>
                            </div>
                        </div>
                    </form>
				</section>
			</div>
			<? } ?>
			<div class="tab-pane active" id="blockcurrent">
				<section id="blocks-table"></section>
			</div>
		</div>
	</div>
</div>
<? } ?>