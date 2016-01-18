<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" style="position:absolute;overflow:scroll;">
    <div class="modal-dialog" style="width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <span class="type"></span> Editor</h4>
            </div>
            <div class="modal-body">
                    <!--Start PAGE Editor-->
                    <form id="update" class="page">
                        <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input required class="form-control input-lg" type="text" placeholder="page title" name="title" id="title">
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
                                            <input required type='text' id='url' name='url' class="form-control" placeholder='url' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for='template'>Template</label>
                                        <select required id='template' name='template' placeholder='Title' class="form-control" id="template">
                                            <?php foreach(glob($_SERVER['DOCUMENT_ROOT'].'/templates/*.php') as $template){
                                                    echo "<option>" . pathinfo($template, PATHINFO_FILENAME) . "</option>";
                                            } ?>
                                        </select>
                                    </div>

                                    <hr />
                                    <button class="btn btn-primary btn-lg editSave btn-success pull-right" id="updateTrue" data-loading-text="Saving..." data-type="page"><i class="fa fa-check"></i> Save</button>
                                </div>
                            </div>
                          <input type='hidden' id='ub' name='ub' value="<?=$_SESSION['adminid'];?>" />
                        <input type='hidden' class='type' name='type' value="page"/>
                        <input type='hidden' id='id' name='id'  />
                    </form>
                    <!--End PAGE Editor-->
                    <!--Start BLOCK Editor-->
                    <form id="update" class="block">
                        <label for='title'>Title</label>
                        <input required type='text' id='title' name='title' placeholder='Title' />
                        <label for='blockedit'>Content</label>
                        <div class="wysiwyg" id="blockedit" name="content"></div>
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
        </div>
    </div>
</div>
			