<?php
function showAdmBar(){
	if(file_exists(implode(DIRECTORY_SEPARATOR, array(includePath,'system','adm_navbar.php')))){
		include_once(implode(DIRECTORY_SEPARATOR, array(includePath,'system','adm_navbar.php')));
		return true;
	}
	return false;
}

function montaSelect($itens, $selected=NULL, $indexado=true){
	$html = '';
	if(is_array($itens)){
		foreach($itens as $item){
			if($indexado){
				$html.= '<option value="'.$item[0].'"';
				if(in_array($item[0], $selected)) $html.= ' selected';
				$html.= '>'.$item[1].'</option>';
			} else {
				$html.= '<option value="'.$item.'"';
				if(in_array($item, $selected)) $html.= ' selected';
				$html.= '>'.$item.'</option>';
			}
		}
	}
	return $html;
}

