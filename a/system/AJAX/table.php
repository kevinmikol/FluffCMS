<?php 
    require('../common.php');
    
    $type = $_POST['type'];
    $selected = $_POST['selected'];

    switch($type){
        case "pages":
            $page = $db->prepare("SELECT * FROM cms_pages");
            $page->execute();
            
            if($page->rowCount() == 0){ ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="well" style="text-align:center;">
                        <h2>Aw! No pages found.</h2>
                        <br />
                        <h4>Why not create one?</h4>
                        <a class="btn btn-info btn-lg" onClick="$('a[href=#pagecreate]').trigger('click');"><i class="fa fa-plus-circle"></i> New Page</a>
                    </div>
                </div>
            <? }else{
                $page = $page->fetchAll(); ?>
                <table class="table table-hover table-striped" id="page-table">
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th class="hidden-xs">URL</th>
                        <th class="hidden-sm hidden-xs">Last Updated</th>
                    </tr>
                    <? foreach($page as $info){ ?>
                        <tr id="<?=$info['id']?>"<?if($selected == $info['id']){?> class="warning"<?}?>>
                            <td>
                                <button class="btn btn-warning" onClick="edit('page', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                                <?php if($_SESSION['adminrole'] > 2){ ?><a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="page" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="fa fa-trash"></i></a><?php } ?>
                                <a class="btn btn-info" href="<?=$baseurl.$info['url'];
        ?>" target="_blank"><i class="fa fa-external-link"></i></a>
                            </td>
                            <td><h4><?=$info['title']?> <small><?=$info['template']?></small></h4></td>
                            <td class="hidden-xs"><?="/".$info['url']?></td>
                            <td class="hidden-sm hidden-xs"><?if(humanDate($info['updated']) !== null){echo humanDate($info['updated'])?> <small>by <?=humanName($info['ub']);?></small><? } ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <? }
            break;
        case "blocks":
            $stmt = $db->prepare("SELECT * FROM cms_blocks");
            $stmt->execute();
            
            if($stmt->rowCount() == 0){ ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="well" style="text-align:center;">
                        <h2>Darn! No blocks found.</h2>
                        <br />
                        <h4>Why not create one?</h4>
                        <a class="btn btn-info btn-lg" onClick="$('a[href=#blockcreate]').trigger('click');"><i class="fa fa-plus-circle"></i> New Block</a>
                    </div>
                </div>
            <? }else{
                $blocks = $stmt->fetchAll(); ?>
                <table class="table table-hover table-striped" id="block-table">
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Title</th>
                        <? if($_SESSION['adminrole'] > 3){ ?><th class="hidden-sm hidden-xs">Object Usage Code</th><? } ?>
                        <th class="hidden-sm hidden-xs">Last Updated</th>
                    </tr>
                    <? foreach($blocks as $info){?>
                        <tr id="<?=$info['id']?>"<?if($selected == $info['id']){?> class="warning"<?}?>>
                            <td>
                                <button class="btn btn-warning" onClick="edit('block', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                                <? if($_SESSION['adminrole'] > 2){ ?><a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="block" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="fa fa-trash"></i></a><? } ?>
                            </td>
                            <td><?=$info['id']?></td>
                            <td><h4><?=$info['title']?></h4></td>
                            <? if($_SESSION['adminrole'] > 3){ ?><td class="hidden-sm hidden-xs"><input type="text" readonly value="$Block->load('<?=$info['id']?>');" /></td><? } ?>
                            <td class="hidden-sm hidden-xs"><?if(humanDate($info['updated']) !== null){echo humanDate($info['updated'])?> <small>by <?=humanName($info['ub']);?></small><? } ?></td>
                    <? } ?>
                </table>
            <? }
            break;
        case "users":
            $users = $db->prepare("SELECT * FROM cms_users");
            $users->execute();

            if($users->rowCount() == 0){ ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="well" style="text-align:center;">
                        <h2>Uhh..No Users found.</h2>
                        <br />
                        <h4>Not sure how you did that one.</h4>
                        <a class="btn btn-info btn-lg" onClick="$('a[href=#usercreate]').trigger('click');"><i class="fa fa-plus-circle"></i> New User</a>
                    </div>
                </div>
            <? }else{ ?>
                <table class="table table-hover table-striped" id="user-table">
                    <tr>
                        <th></th>
                        <th class="hidden-xs"></th>
                        <th>Name</th>
                        <th class="hidden-sm hidden-xs">Email</th>
                        <th class="hidden-sm hidden-xs">Username</th>
                        <th class="hidden-md hidden-sm hidden-xs">Last Login</th>
                    </tr>
                    <?php
                    $users = $users->fetchAll();

                    foreach($users as $info){
                        echo $_SESSION['adminrole'] !== '5';
                        if($_SESSION['adminrole'] !== '5' AND $info['role'] == '5'){continue;} ?>

                        <tr id="<?=$info['id']?>"<?if($selected == $info['id']){?> class="warning"<?}?>>
                            <td>
                                <button class="btn btn-warning" onClick="edit('user', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                                <a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="user" data-id="<?=$info['id']?>" data-title="<?=$info['username']?>"><i class="fa fa-trash"></i></a>
                            </td>
                            <td class="hidden-xs"><a href="#" data-toggle="modal" data-target="#gravatarModal"><img src="<?=getGravatar($info['email'], 40);?>" class="img-thumbnail img-circle" /></a></td>
                            <td><h4><?=$info['name'];?> <small><?=humanRole($info['role']);?></small></h4></td>
                            <td class="hidden-sm hidden-xs"><a href="mailto:<?=$info['email'];?>"><?=$info['email'];?></a></td>
                            <td class="hidden-sm hidden-xs"><?=$info['username'];?></td>
                            <td class="hidden-md hidden-sm hidden-xs"><?=humanDate($info['last_login'])?></td>
                        </tr>
                    <? } ?>
                </table>
            <? } ?>
        <? break;
        case "posts":
            $posts = $db->prepare("SELECT * FROM cms_posts");
            $posts->execute();
            
            if($posts->rowCount() == 0){ ?>
                <div class="col-md-6 col-md-offset-3">
                    <div class="well" style="text-align:center;">
                        <h2>Shoot! No posts found.</h2>
                        <br />
                        <h4>Why not create one?</h4>
                        <a class="btn btn-info btn-lg" onClick="$('a[href=#postcreate]').trigger('click');"><i class="fa fa-plus-circle"></i> New Post</a>
                    </div>
                </div>
            <? }else{
                $posts = $posts->fetchAll();?>
                <table class="table table-hover table-striped" id="post-table">
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th class="hidden-xs">URL</th>
                        <th class="hidden-sm hidden-xs">Created</th>
                    </tr>
                    <? foreach($posts as $info){

                        switch($info['status']){
                            case 0:
                                $status = "draft";
                                break;
                            case 1:
                                $status = "published";
                                break;
                        }?>

                        <tr id="<?=$info['id']?>"<?if($selected == $info['id']){?> class="warning"<?}?>>
                            <td>
                                <button class="btn btn-warning" onClick="edit('post', '<?=$info['id']?>')"><i class="fa fa-edit"></i></button>
                                <a href="#deleteModal" role="button" class="btn deleteButton btn-danger" data-toggle="modal" data-type="post" data-id="<?=$info['id']?>" data-title="<?=$info['title']?>"><i class="fa fa-trash"></i></a>
                                <a class="btn btn-info" href="<?=$baseurl.$info['url'];?>" target="_blank"><i class="fa fa-external-link"></i></a>
                            </td>
                            <td><h4><?=$info['title']?> <small><?=$status?></small></h4></td>
                            <td class="hidden-xs"><?=$info['url']?></td>
                            <td class="hidden-sm hidden-xs"><?=humanDate($info['created'])?> <small>by <?=humanName($info['cb']);?></small></td>
                        </tr>
                    <? } ?>
                </table>
               <? }
            break;
    }

?>