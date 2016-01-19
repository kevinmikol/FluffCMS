<? if($_SESSION['adminrole'] > 3){

//Autofill
$stmturl = $db->prepare('SELECT url FROM cms_pages');
$stmturl->execute();
$urls = $stmturl->fetchAll();

echo "<script> var urls = [";

foreach($urls as $row){
	echo '"'.$row['url'].'",';
}

echo "] </script>";

function navigation(){
	global $db;
	$refs = array();
	$list = array();
	
	$stmt = $db->prepare('SELECT * FROM cms_navigation ORDER BY `right`');
	$stmt->execute();
	
	while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
	    $thisref = &$refs[ $data['id'] ];
	    $thisref['parent_id'] = $data['parent_id'];
	    $thisref['id'] = $data['id'];
	    $thisref['text'] = $data['text'];
	    $thisref['url'] = $data['url'];
	    $thisref['target'] = $data['target'];
		$thisref['type'] = $data['type'];
	    if ($data['parent_id'] == 0){
	        $list[ $data['id'] ] = &$thisref;
	    }
	    else{
	        $refs[ $data['parent_id'] ]['children'][ $data['id'] ] = &$thisref;
	    }
	}
	$first = true;
	function create_list( $arr ){
	/* print_r($arr); */
	global $first;
	    if($first !== false){
			$html = "\n<ol class='navigationEdit'>\n";
			$first = false;
		}else{
			$html = "\n<ol>\n";
			}
	    foreach ($arr as $key=>$v) {
	    	if($v['type'] == "1"){$ex = '  <i style="color:#49afcd" class="icon-external-link"></i>';}
	        $html .= '<li id="list_'.$v['id'].'" data-url="'.$v['url'].'">
	        			<div><span>'.$v['text'].'</span>'.$ex.'
	        				<a style="color:#da4f49" data-id="'.$v['id'].'" data-title="'.$v['text'].'" data-type="link" class="deleteButton"><i class="fa fa-trash pull-right"></i></a>
	        				<a style="color:#faa732" data-id="'.$v['id'].'" class="navitemedit"><i class="fa fa-edit pull-right"></i></a>
	        			</div>';
	        if (array_key_exists('children', $v)){
	            $html .= "";
	            $html .= create_list($v['children']);
	            $html .= "</li>\n";
	        }
	        else{}
	        $ex = "";
	    }
	    $html .= "</ol>\n";
	    return $html;
	}
	echo create_list($list); 
}
?>
<div class="row">
    <div class="col-md-7">
		<? navigation(); ?>
	</div>
	<div class="col-md-4 col-md-offset-1">
        <div class="well">
            <h3>Add Link</h3>
            <form id="navadd">
                <div class="form-group">
                    <label>Link Text</label>
                    <input class="form-control" required type="text" name='text' id="navtext" placeholder="About Us" />
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
                        <input required type='text' name='url' class="form-control navurl" placeholder='url' pattern="[^!@#$%&*()|{}.,<> ]*" autocomplete="off">
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
                    <input type="text" name='attr' id="navattr" placeholder='class="icon icon-home" id="about"' class="form-control" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info addLink" data-loading-text="adding..."><i class="fa fa-plus-circle"></i> Add To Menu</button>
                </div>
            </div>
		</form>
	</div>
</div>
<? } ?>