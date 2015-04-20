<?php showNavBar(); ?>
<?php
function retornaValores($table, $id_column, $label_column, $filtro='', &$retorno){
	$sql = new DBSqlSelecione;
	$sql->setEntidade($table);
	$sql->addColuna($id_column);
	$sql->addColuna($label_column);
	try {
		$conexao = DBConexao::open();
		$resultado = $conexao->query($sql->getInstrucao());
		$retorno = $resultado->fetchAll(PDO::FETCH_ASSOC);
		return (true);
	} catch(PDOException $error){
		print_r($error->getMessage());
		return (false);
	}
}

function loadEditor($fileName, &$html){
	$JSONContent = file_get_contents($fileName);
	$EditorConfig = json_decode($JSONContent);

	$sql = new DBSqlSelecione;
	$sql->setEntidade($EditorConfig->table);
	foreach($EditorConfig->columns AS $Key=>$Val){
		$sql->addColuna($Key);
	}
	try{
		$html = '<table class="table table-striped">';
		$html.= '<thead>';
		$html.= '<tr>';
		foreach($EditorConfig->columns AS $Key=>$Val){
			if($Val->visible==true){
				$html.= '<th>'.$Val->label.'</th>';
			}
		}
		$html.= '<th>&nbsp;</th>';
		$html.= '</tr>';
		$html.= '</thead>';
		$html.= '<tbody>';

		$conexao = DBConexao::open();
		$resultado = $conexao->query($sql->getInstrucao());
		$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
		foreach($dados AS $ROW){
			$html.= '<tr>';
			foreach($EditorConfig->columns AS $Key=>$Val){
				if($Val->visible==true){
					$html.= '<td>'.utf8_encode($ROW[$Key]).'</td>';
				}
			}
			$html.= '<td>';
			$html.= '<button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Editar</button> ';
			$html.= '<button type="button" class="btn btn-xs btn-danger">Excluir</button> ';
			$html.= '</td>';
			$html.= '</tr>';
		}

		$html.= '</tbody>';
		$html.= '</table>';
		$html.= '<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
		$html.= '<form method="post" class="form-horizontal" role="form">';
		$html.= '<div class="modal-dialog modal-lg"><div class="modal-content">';
		$html.= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">Editar</h4></div>';
		$html.= '<div class="modal-body">';
		foreach($EditorConfig->columns AS $Key=>$Val){
			if($Val->editable==true){
				switch($Val->datatype){
					case 'search':
					case 'email':
					case 'url':
					case 'tel':
					case 'number':
					case 'range':
					case 'date':
					case 'month':
					case 'week':
					case 'time':
					case 'datetime':
					case 'datetime-local':
					case 'color':
					case 'text':
						$html.= '<div class="form-group">';
						$html.= '<label for="input'.$Key.'" class="col-sm-2 control-label">'.$Val->label.'</label>';
						$html.= '<div class="col-sm-10">';
						$html.= '<input type="'.$Val->datatype.'" class="form-control" id="input'.$Key.'" placeholder="'.$Val->label.'">';
						$html.= '</div>';
						$html.= '</div>';
						break;
					case 'select':
						$html.= '<div class="form-group">';
						$html.= '<label for="input'.$Key.'" class="col-sm-2 control-label">'.$Val->label.'</label>';
						$html.= '<div class="col-sm-10">';
						$html.= '<select class="form-control">';
						if(retornaValores($Val->datasource->table, $Val->datasource->id_column, $Val->datasource->label_column, '', $retorno)){
							foreach($retorno as $item){
								$html.= '<option value="'.utf8_encode($item[$Val->datasource->id_column]).'">'.utf8_encode($item[$Val->datasource->label_column]).'</option>';
							}
						}
						$html.= '</select>';
						$html.= '</div>';
						$html.= '</div>';
						break;
					case 'checkbox':
						$html.= '<div class="form-group">';
						$html.= '<div class="col-sm-offset-2 col-sm-10">';
						$html.= '<div class="checkbox">';
						$html.= '<label for="input'.$Key.'"><input id="input'.$Key.'" type="checkbox"> '.$Val->label.'</label>';
						$html.= '</div>';
						$html.= '</div>';
						$html.= '</div>';
						break;
				}
			}
		}
		$html.- '</div>';
		$html.= '<div class="modal-footer"><button type="submit" class="btn btn-success">Salvar</button><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button></div>';
		$html.= '</div></div>';
		$html.= '</form>';
		$html.= '</div>';

		return (true);
	} catch(PDOException $error){
		print_r($error->getMessage());
		return (false);
	}
}

if(!loadEditor('menu.json', $html)) die('Erro ao carregar editor!');
echo $html;
?>
