<? if($_SESSION['adminrole'] > 0){ ?>
<div class="row">
	<div class="col-md-12">
        <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a href="#postcurrent" data-toggle="tab" onClick="loadTable('posts', null);"><i class="fa fa-list"></i> Current Posts</a></li>
            <li><a href="#postcreate" data-toggle="tab"><i class="fa fa-plus-circle"></i> New Post</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="postcreate">
                  <section id="postcreate">
                    <form class="create" data-type="post">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input required class="form-control input-lg" type="text" placeholder="post title" name="title" data-url-target="newPostURL">
                                </div>
                                <div class="form-control wysiwyg" name="content" id="content"></div>
                                    <textarea name="htmlcontent" id="htmlcontent" style="display:none;"></textarea>
                                </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for='url'>URL</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><?=$baseurl?></div>
                                        <input required type='text' id='url' name='url' class="form-control newPostURL" placeholder='url' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for='featuredImage'>Featured Image</label>
                                    <div class="image-box">
                                        <a class="btn btn-sm btn-danger deleteImage"><i class="fa fa-trash"></i></a>
                                        <img id="newPostPreview" src="#" alt="your image">
                                        <input type='file' class="theImage" data-target="newPostPreview" id="file" name="featuredImage" style="display:none;" data-loading-text="Uploading..."/>
                                        <a class="btn btn-info btn-upload">Upload Image</a>
                                        <input type="hidden" name="featuredImage" class="imgurl" id="featuredImage" />
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
            <section id="posts-table"></section>
          </div>
        </div>
    </div>
</div>
<? } ?>