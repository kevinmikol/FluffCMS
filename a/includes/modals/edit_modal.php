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
                                    <input required class="form-control input-lg" type="text" placeholder="page title" id="title" name="title">
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
                                        <img id="editPagePreview" src="#" alt="your image">
                                        <input type='file' class="theImage" data-target="editPagePreview" id="file" name="featuredImage" style="display:none;" data-loading-text="Uploading..."/>
                                        <a class="btn btn-info btn-upload">Upload Image</a>
                                        <input type="hidden" name="featuredImage" id="featuredImage" class="imgurl" />
                                    </div>
                                </div>
                                <hr />
                                <button class="btn btn-primary btn-lg editSave pull-right" id="updateTrue" data-loading-text="Saving..." data-type="page"><i class="fa fa-floppy-o"></i> Update Page</button>
                            </div>
                        </div>
                      <input type='hidden' id='ub' name='ub' value="<?=$_SESSION['adminid'];?>" />
                    <input type='hidden' class='type' name='type' value="page"/>
                    <input type='hidden' id='id' name='id'  />
                </form>
                <!--End PAGE Editor-->
                <!--Start BLOCK Editor-->
                <form id="update" class="block">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input required class="form-control input-lg" type="text" placeholder="block title" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <div class="form-control wysiwyg" name="content" id="content"></div>
                                <textarea name="htmlcontent" id="htmlcontent" style="display:none;"></textarea>
                            </div>
                            <hr />
                            <input type='hidden' id='type' name='type' value="block" />
                            <input type='hidden' id='id' name='id' />
                            <input type='hidden' id='ub' name='ub' value="<?=$_SESSION['adminid'];?>" />
                            <button class="btn btn-primary btn-lg editSave pull-right" id="updateTrue" data-loading-text="Saving..." data-type="block"><i class="fa fa-floppy-o"></i> Update Block</button>
                        </div>
                    </div>
                </form>
                <!--End BLOCK Editor-->
                <!--Start USER Editor-->
                <form id="update" class="user">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><i class="fa fa-info-circle"></i> User Information</h4>
                                    <div class="form-group">
                                        <input required type='text' id='name' name='name' placeholder='Full Name' class="form-control input-lg">
                                    </div>
                                    <div class="form-group">
                                        <input required type='email' id='email' name='email' placeholder='Email' class="form-control input-lg">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-6">
                                    <h4><i class="fa fa-user-secret"></i> Login Credentials</h4>
                                    <div class="form-group">
                                        <input required type='text' id='username' name='username' placeholder='Username' class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type='password' id='newPW' name='newPW' placeholder='New Password' class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4><i class="fa fa-suitcase"></i> User Role</h4>
                                    <div class="form-group">
                                        <select id="role" name="role" class="form-control">
                                            <option value="0">Bystander</option>
                                            <option value="1">Blogger</option>
                                            <option value="2">Content Editor</option>
                                            <option value="3">Content Creator</option>
                                            <option value="4">Minute Admin</option>
                                            <option value="5">Super Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="well">
                                <p><strong>Bystander</strong> read access</p>
                                <p><strong>Blogger</strong> posting ability</p>
                                <p><strong>Editor</strong> content editing</p>
                                <p><strong>Content Creator</strong> content creation</p>
                                <p><strong>Admin</strong> mostly everything</p>
                                <p><strong>Super</strong> the whole shabang</p>
                            </div>
                            <hr />
                            <input type='hidden' id='type' name='type' value="user" />
                            <input type='hidden' id='ub' name='ub' value="<?=$_SESSION['adminid'];?>" />
                            <input type='hidden' id='id' name='id' />
                            <button class="btn btn-primary btn-lg editSave pull-right" id="updateTrue" data-loading-text="Saving..." data-type="user"><i class="fa fa-floppy-o"></i> Update User</button>
                        </div>
                    </div>
                </form>
                <!--End USER Editor-->
                <!--Start NAVIGATION Editor-->
                <form id="update" class="navigation">
                    <div class="form-group">
                        <label>Link Text</label>
                        <input class="form-control" required type="text" name='text' id="text" placeholder="About Us" />
                    </div>
                    <div class="form-group">
                        <label>Link Type</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="linktype" class="local" value="0" checked>
                            Local Link
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="linktype" class="external" value="1">
                                External Link
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for='url'>Link URL</label>
                        <div class="navaddurl input-group">
                            <div class="input-group-addon"><?=$baseurl?></div>
                            <input required type='text' name='url' id="url" class="form-control navurl" placeholder='url' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Target</label>
                        <select required id="target" name="target" class="form-control">
                            <option value="_self">Default</option>
                            <option value="_blank">New Window/Tab</option>
                            <option value="_top">Frame Top</option>
                            <option value="_parent">Frame Parent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Attributes</label>
                        <input type="text" name='attr' id="attr" placeholder='class="icon icon-home" id="about"' class="form-control" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg editSave pull-right" id="updateTrue" data-loading-text="Saving..." data-type="link"><i class="fa fa-floppy-o"></i> Update Link</button><br /><br />
                    </div>
                    <input type='hidden' class='type' name='type' value="link" />
                    <input type='hidden' name='id' id='id' />
                </form>
                <!--End NAVIGATION Editor-->
                <!--Start POST Editor-->
                <form id="update" class="post">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input required class="form-control input-lg" type="text" placeholder="post title" name="title" id="title">
                            </div>
                            <div class="form-control wysiwyg" name="content" id="content"></div>
                            <textarea name="htmlcontent" id="htmlcontent" style="display:none;"></textarea>
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
                                    <a class="btn btn-sm btn-danger deleteImage"><i class="fa fa-trash"></i></a>
                                    <img id="editPostPreview" src="#" alt="your image">
                                    <input type='file' class="theImage" data-target="editPostPreview" id="file" name="featuredImage" style="display:none;" data-loading-text="Uploading..."/>
                                    <a class="btn btn-info btn-upload">Upload Image</a>
                                    <input type="hidden" name="featuredImage" class="imgurl" id="featuredImage" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Published</option>
                                    <option value="0">Draft</option>
                                </select>
                            </div>
                            <hr />
                            <button class="btn btn-primary btn-lg editSave pull-right" id="updateTrue" data-loading-text="Saving..." data-type="post"><i class="fa fa-floppy-o"></i> Update Post</button><br /><br />
                        </div>
                    </div>
                    <input type='hidden' id='ub' name='ub' value="<?=$_SESSION['adminid'];?>" />
                    <input type='hidden' id='type' name='type' value="post" />
                    <input type='hidden' id='id' name='id' />
                </form>
                <!--End POST Editor-->
            </div>
        </div>
    </div>
</div>