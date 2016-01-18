<?php
    class navigation{
        function load(){
            global $db;

                //Make some arrays
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
                    $thisref['attr'] = $data['attr'];
                    if ($data['parent_id'] == 0){
                        $list[ $data['id'] ] = &$thisref;
                    }else{
                        $refs[ $data['parent_id'] ]['children'][ $data['id'] ] = &$thisref;
                    }
                }
                function create_list($arr){
                $html = "\n<ul>\n";
                    foreach ($arr as $key=>$v) {
                        $html .= '<li data-id="'.$v['id'].'"><a '.$v['attr'].' href="'.$v['url'].'" target="'.$v['target'].'">'.$v['text'].'</a>';
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