<? if($user_role > 3){

//Autofill
$stmturl = $db->prepare('SELECT url FROM cms_navigation');
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
	    $thisref = &$refs[ $data['item_id'] ];
	    $thisref['parent_id'] = $data['parent_id'];
	    $thisref['item_id'] = $data['item_id'];
	    $thisref['text'] = $data['text'];
	    $thisref['url'] = $data['url'];
	    $thisref['target'] = $data['target'];
		$thisref['type'] = $data['type'];
	    if ($data['parent_id'] == 0){
	        $list[ $data['item_id'] ] = &$thisref;
	    }
	    else{
	        $refs[ $data['parent_id'] ]['children'][ $data['item_id'] ] = &$thisref;
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
	        $html .= '<li id="list_'.$v['item_id'].'" data-url="'.$v['url'].'">
	        			<div><span>'.$v['text'].'</span>'.$ex.'
	        				<a style="color:#da4f49" data-id="'.$v['item_id'].'" data-title="'.$v['text'].'" data-type="link" class="deleteButton"><i class="icon-trash pull-right"></i></a>
	        				<a style="color:#faa732" data-id="'.$v['item_id'].'" class="navitemedit"><i class="icon-edit pull-right"></i></a>
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
<div class="row-fluid">
	<div class="span4 well">
		<h3>Add Link</h3>
		<form id="navadd">
			<label>Link Text</label>
				<input required type="text" name='text' id="navtext" placeholder="About Us" />
			<br />
			<label>Link Type</label>
			<label class="radio">
			  <input type="radio" name="linktype" class="local" value="0" checked>
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
				<input required type='text' name='url' id="navurl" class="linkurl navurl span5" placeholder='URL' pattern="[^!@#$%&*():|{}.,<> ]*" autocomplete="off">
			</div>
			<label>Target</label>
			<select required id="target" name="target">
				<option value="_self">Default</option>
				<option value="_blank">New Window/Tab</option>
				<option value="_top">Frame Top</option>
				<option value="_parent">Frame Parent</option>
			</select>
			<br /><br />
			<label>Attributes</label>
				<input type="text" name='attr' id="navattr" placeholder='class="icon icon-home" id="about"' />
			<br />
			<br />
			<button type="submit" class="btn btn-info" data-loading-text="adding..."><i class="icon-plus-sign"></i> Add To Menu</button>
		</form>
	</div>
	<div class="span4 offset1">
		<? navigation(); ?>
	</div>
	<div class="offset1 span2 pull-right muted">
		<p>Drag items to reorder.</p>
		<div class="well">
			<h5>Key:</h5>
			<p><span style="color:#faa732"><i class="icon-edit"></i></span> Edit</p>
			<p><span style="color:#da4f49"><i class="icon-trash"></i></span> Delete</p>
			<p><i style="color:#49afcd" class="icon-external-link"></i> External Link</p>
		</div>
	</div>
</div>
<? } ?>