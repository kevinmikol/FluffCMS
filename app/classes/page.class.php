<?php
class page{
	function init(){
		global $db, $sitetitle, $baseurl;
		
		//Get URL and Know the Currrent Page
        $request = parse_url($_SERVER['REQUEST_URI']);
		$path = $request["path"];
		$result = trim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $path), '/');
		$result = explode('/', $result);
		$max_level = 2;
		while ($max_level < count($result)) {
			unset($result[0]);
		}
		$url = implode('/', $result);
		if($url == NULL){$url = "home";}

		//Load from Database
		$load_page = $db->prepare("SELECT * FROM cms_pages WHERE url = :url LIMIT 1");
		$load_page->bindParam(':url', $url);
		$load_page->execute();
		$page_count = $load_page->rowCount();
		$currentpage = $load_page->fetch(PDO::FETCH_OBJ);
		
		if($page_count == 0 && $url !== "404"){echo '<meta http-equiv="refresh" content="0; url='.$baseurl.'404">';die;}

		$currentpage->sitetitle = $currentpage->title.' &#183; '.$sitetitle;
        
		return $currentpage;
	}
    function navigation(){
		global $db;

			//Make some arrays
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
			    $thisref['attr'] = $data['attr'];
			    if ($data['parent_id'] == 0){
			        $list[ $data['item_id'] ] = &$thisref;
			    }else{
			        $refs[ $data['parent_id'] ]['children'][ $data['item_id'] ] = &$thisref;
			    }
			}
			function create_list($arr){
			$html = "\n<ul>\n";
			    foreach ($arr as $key=>$v) {
			        $html .= '<li data-id="'.$v['item_id'].'"><a '.$v['attr'].' href="'.$v['url'].'" target="'.$v['target'].'">'.$v['text'].'</a>';
			        if (array_key_exists('children', $v)){
			            $html .= "";
			            $html .= create_list($v['children']);
			            $html .= "</li>\n";
			        }else{}
			    }
			    $html .= "</ul>\n";
			    return $html;
			}
			return create_list($list);
    }
}
?>
