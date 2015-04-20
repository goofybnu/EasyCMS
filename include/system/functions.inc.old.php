<?php
/**
 * Função para carregar automaticamente as classes
 *
 * @param $ClassName Nome da classe a ser carregada
 * @return Boolean
 **/
function __autoload($ClassName){
	if(file_exists(implode(DIRECTORY_SEPARATOR, array(classesPath,$ClassName.'.class.php')))){
		include_once(implode(DIRECTORY_SEPARATOR, array(classesPath,$ClassName.'.class.php')));
		return true;
	}
	return false;
}

/**
 * Função para adicionar um CSS adicional
 */
function addCSS($fileName){
	global $customCSS;
	$customCSS[] = $fileName;
}

/**
 * Função para retornar HTML de inclusão dos CSS adicionais
 */
function showCSS(){
	global $customCSS;
	$html = '';
	if(count($customCSS)>0){
		foreach($customCSS as $cssFile){
			$html.= "\t" . '<link href="' . baseURL . '/css/' . $cssFile . '" rel="stylesheet">' . "\n";
		}
	}
	return $html;
}

/**
 * Função para adicionar um JS adicional
 */
function addJS($fileName){
	global $customJS;
	$customJS[] = $fileName;
}

/**
 * Função para retornar HTML de inclusão dos JS adicionais
 */
function showJS(){
	global $customJS;
	$html = '';
	if(count($customJS)>0){
		foreach($customJS as $jsFile){
			$html.= "\t" . '<script src="' . baseURL . '/js/' . $jsFile . '"></script>' . "\n";
		}
	}
	return $html;
}

function getFormValue($campo){
	$valor = $_POST[$campo];
	return $valor;
}

function navBarContaSubItems($dados, $id=0){
	$total = 0;
	foreach($dados as $item){
		if($item['subid']==$id){
			$total+=1;
		}
	}
	return $total;
}

function montaNavBar($dados, $subid=0){
	$aut = SYSLogin::instanciar();
	$usuario = $aut->retornar();
	$adminUsr = ($usuario->tipo!='ADMIN') ? false : true;

	$html = '';
	if($subid==0){
		$html.= '<ul class="nav navbar-nav">'."\n";
	} else {
		$html.= '<ul class="dropdown-menu">'."\n";
	}
	foreach($dados as $item){
		$url = $item['url'];
		$possuiAcesso = false;
		if($usuario->tipo!='ADMIN'){
			foreach($usuario->permissoes AS $permItem){
				if(strpos($url, $permItem) !== false) {
					$possuiAcesso = true;
				}
			}
		} else {
			$possuiAcesso = true;
		}
		//if($possuiAcesso == true){
			if($item['subid']==$subid){
				if(navBarContaSubItems($dados, $item['id'])>0){
					if($subid==0){
						$html.= '<li class="menu-item dropdown">';
						$html.= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
						if($item['icon']!='') $html.= '<span class="glyphicon glyphicon-'.$item['icon'].'"></span> ';
						$html.= $item['nome'];
						$html.= ' <b class="caret"></b></a>'."\n";
					} else {
						$html.= '<li class="menu-item dropdown dropdown-submenu">'."\n";
						$html.= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
						if($item['icon']!='') $html.= '<span class="glyphicon glyphicon-'.$item['icon'].'"></span> ';
						$html.= $item['nome'];
						$html.= '</a>'."\n";
					}
					$html.= montaNavBar($dados, $item['id']);
					$html.= '</li>'."\n";
				} else {
					if($subid==0){
						$html.= '<li>';
					} else {
						$html.= '<li class="menu-item ">'."\n";
					}
					$html.= '<a href="' . baseURL . $item['url'] . '">';
					if($item['icon']!='') $html.= '<span class="glyphicon glyphicon-'.$item['icon'].'"></span> ';
					$html.= $item['nome'];
					$html.= '</a>'."\n";
					$html.= '</li>'."\n";
				}
			}
		//}
	}
	if($subid==0){
		$html.= '</ul>'."\n";
		$html.= '<ul class="nav navbar-nav navbar-right"><li><a href="/logout/"><span class="glyphicon glyphicon-remove"></span> Sair</a></li></ul>'."\n";
	} else {
		$html.= '</ul>'."\n";
	}

	return $html;
}

function showNavBar(){
	$navBarTitle = 'ERP Unifique';

	$sql = new DBSqlSelecione;
	$sql->setEntidade('sis_menu');
	$sql->addColuna('id');
	$sql->addColuna('subid');
	$sql->addColuna('icon');
	$sql->addColuna('nome');
	$sql->addColuna('url');
	$sql->addColuna('target');

	$criterio = new DBCriterio;
	$criterio->add(new DBFiltro('ativo', '=', '1'));
	$criterio->setPropriedade('order', 'nome');
	$sql->setCriterio($criterio);

	try {
		$conexao = DBConexao::open();
		$conexao->query("SET NAMES 'utf8'");
		$resultado = $conexao->query($sql->getInstrucao());
		$navBarItems = $resultado->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $error){
		print_r($error->getMessage());
		return false;
	}

	$html = '<style type="text/css"> body { padding-top:60px !important; } </style>';
	$html.= '<div class="navbar navbar-default navbar-fixed-top no-print" role="navigation">';
	$html.= '	<div class="container">';
	$html.= '		<div class="navbar-header">';
	$html.= '			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Navegação</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>';
	$html.= '			<a class="navbar-brand" href="'.baseURL.'"><img alt="'.$navBarTitle.'" src="/images/logo.png" height="40" /></a>';
	$html.= '		</div>';
	$html.= '		<div class="collapse navbar-collapse">';

	$html.= montaNavBar($navBarItems, 0);

	$html.= '		</div>';
	$html.= '	</div>';
	$html.= '</div>';

	echo $html;
}

function formataMoeda($valor){
	//$valor = str_replace(',','',$valor);
	$valor = number_format($valor, 2, ',', '.');
	return 'R$ ' . $valor;
}

function conectaDBERP(&$dbConn){
	/*
	try {
		$dbConn = new PDO("mysql:host=localhost;port=3306;dbname=erp", 'root', 'qaswed999');
		$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbConn->query("SET NAMES UTF8");
		return true;
	} catch(PDOException $error){
		print_r($error->getMessage());
		return false;
	}
	*/
	if($dbConn = @mysql_connect('localhost','root','qaswed999')){
		mysql_select_db('erp', $dbConn);
		mysql_query("SET NAMES 'utf8'", $dbConn);
		return true;
	} else {
		return false;
	}
}
/*
function retornaUnidades(){
	$unidades = array();
	if(conectaDBERP($dbConn)){
			$SQL0 = "SELECT * FROM `erp`.`sis_unidades` ORDER BY `unidade` ASC;";
			$RES0 = $dbConn->query($SQL0);
			if($RES0){
				$unidades = array();
				$dados = $RES0->fetchAll(PDO::FETCH_ASSOC);
				foreach($dados AS $ROW0){
					$unidades[$ROW0['id']] = $ROW0;
				}
			} else {
				return false;
			}
	} else {
		return false;
	}
	return $unidades;
}
*/
function retornaUnidades(){
	$unidades = array();
	if(conectaDBERP($dbConn)){
			$SQL0 = "SELECT * FROM `erp`.`sis_unidades` ORDER BY `unidade` ASC;";
			$RES0 = mysql_query($SQL0, $dbConn);
			if($RES0){
				$unidades = array();
				while($ROW0 = mysql_fetch_assoc($RES0)){
					$unidades[$ROW0['id']] = $ROW0;
				}
			} else {
				return false;
			}
	} else {
		return false;
	}
	return $unidades;
}

function retornaListaPrivilegios($unidadeID){
	$privilegios = array();
	if(conectaDBERP($dbConn)){
		$SQL0 = "SELECT * FROM `erp`.`sis_unidades` WHERE `id`='{$unidadeID}' LIMIT 1;";
		$RES0 = mysql_query($SQL0, $dbConn);
		if($RES0){
			$dados = mysql_fetch_assoc($RES0);
			if($dbConn1 = mysql_connect($dados['db_host'], $dados['db_user'], $dados['db_pass'])){
				mysql_query("SET NAMES 'utf8'", $dbConn1);
				mysql_select_db($dados['db_base'], $dbConn1);
				$SQL1 = "SELECT codgrupo, nome FROM `{$dados['db_base']}`.`sis_grupos` ORDER BY `nome` ASC;";
				$RES1 = mysql_query($SQL1, $dbConn1);
				if(!$RES1) echo mysql_error($dbConn1);
				while($ROW1 = mysql_fetch_assoc($RES1)){
					$privilegios[] = array($ROW1['codgrupo'],$ROW1['nome']);
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
		return $privilegios;
	} else {
		return false;
	}
}

function retornaListaDepartamentos($unidadeID){
	$privilegios = array();
	if(conectaDBERP($dbConn)){
		$SQL0 = "SELECT * FROM `erp`.`sis_unidades` WHERE `id`='{$unidadeID}' LIMIT 1;";
		$RES0 = mysql_query($SQL0, $dbConn);
		if($RES0){
			$dados = mysql_fetch_assoc($RES0);
			if($dbConn1 = mysql_connect($dados['db_host'], $dados['db_user'], $dados['db_pass'])){
				mysql_query("SET NAMES 'utf8'", $dbConn1);
				mysql_select_db($dados['db_base'], $dbConn1);
				$SQL1 = "SELECT codigo, nome FROM `{$dados['db_base']}`.`sis_departamentos` ORDER BY `nome` ASC;";
				$RES1 = mysql_query($SQL1, $dbConn1);
				if(!$RES1) echo mysql_error($dbConn1);
				while($ROW1 = mysql_fetch_assoc($RES1)){
					$privilegios[] = array($ROW1['codigo'],$ROW1['nome']);
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
		return $privilegios;
	} else {
		return false;
	}
}

function retornaUsuarios($unidadeID=false){
	$usuarios = array();
	$unidades = retornaUnidades();
	if($unidadeID!=false){
		$unidade = $unidades[$unidadeID];
		if($dbConn1 = mysql_connect($unidade['db_host'], $unidade['db_user'], $unidade['db_pass'])){
			mysql_select_db($unidade['db_base'], $dbConn1);
			mysql_query("SET NAMES 'utf8'", $dbConn1);
			$SQL0 = "SELECT * FROM `{$unidade['db_base']}`.`sis_usuarios` WHERE situacao='0' ORDER BY nome ASC;";
			$RES0 = mysql_query($SQL0, $dbConn1);
			$NUM0 = mysql_num_rows($RES0);
			if($NUM0>0){
				while($ROW0 = mysql_fetch_assoc($RES0)){
					$usuarios[] = array(
						'id'=>$ROW0['codusuario'],
						'text'=>$ROW0['nome'],
						'subtext'=>$ROW0['usuario']
					);
				}
			}
		}
	} else {
		foreach($unidades as $unidade){
			if($dbConn1 = mysql_connect($unidade['db_host'], $unidade['db_user'], $unidade['db_pass'])){
				mysql_select_db($unidade['db_base'], $dbConn1);
				mysql_query("SET NAMES 'utf8'", $dbConn1);
				$SQL0 = "SELECT * FROM `{$unidade['db_base']}`.`sis_usuarios`;";
				$RES0 = mysql_query($SQL0, $dbConn1);
				$NUM0 = mysql_num_rows($RES0);
				if($NUM0>0){
					while($ROW0 = mysql_fetch_assoc($RES0)){
						$usuarios[$unidade['id']][$ROW0['codusuario']] = array(
							'id'=>$ROW0['codusuario'],
							'text'=>$ROW0['nome'],
							'subtext'=>$ROW0['usuario']
						);
					}
				}
			}
		}
	}
	return $usuarios;
}

function retornaTodosUsuarios(){
	$usuarios = array();
	$unidades = retornaUnidades();
	foreach($unidades as $unidade){
		if($dbConn1 = mysql_connect($unidade['db_host'], $unidade['db_user'], $unidade['db_pass'])){
			mysql_select_db($unidade['db_base'], $dbConn1);
			mysql_query("SET NAMES 'utf8'", $dbConn1);
			$SQL0 = "SELECT * FROM `{$unidade['db_base']}`.`sis_usuarios`;";
			$RES0 = mysql_query($SQL0, $dbConn1);
			$NUM0 = mysql_num_rows($RES0);
			if($NUM0>0){
				while($ROW0 = mysql_fetch_assoc($RES0)){
					$usuarios[] = $ROW0['usuario'];
				}
			}
		}
	}
	$usuarios = array_unique($usuarios);
	natcasesort($usuarios);
	return $usuarios;
}

function formataDataHora($dataHora){
	if(($timestamp = strtotime($dataHora)) !== false AND $timestamp > 0){
		return date('d/m/Y H:i:s', $timestamp);
	} else {
		return '';
	}
}

function tempoDecorrido($dataHoraInicial, $dataHoraFinal){
	$timestampInicial = strtotime($dataHoraInicial);
	$timestampFinal = strtotime($dataHoraFinal);
	if(
		$timestampFinal > $timestampInicial 
		AND $timestampInicial !== false 
		AND $timestampInicial > 0 
		AND $timestampFinal !== false 
		AND $timestampFinal > 0
	){
		$diferenca = $timestampFinal - $timestampInicial;
		return gmdate("H:i:s", $diferenca);
	} else {
		return '';
	}
}

function secondsToTime($tempo){
	//return $tempo;
	return gmdate("H:i:s", $tempo);
}

/**
 * Função para retornar os dados solicitados em JSON
 */
function retornaJSON($dados, $campos){
	// Criando array que receberá os dados
	$arrayDados = array();

	// Criando array apenas com os dados solicitados
	foreach($dados as $itemKey=>$itemVal){
		foreach($campos as $campo){
			$arrayDados[$itemKey][$campo['campo']] = $itemVal[$campo['campo']];
		}
	}

	// Removendo duplicatas
	//$arrayDados = array_map("unserialize", array_unique(array_map("serialize", $arrayDados)));

	// Corrigindo charset
	$arrayDados = utf8_converter($arrayDados);

	// Retornando dados
	return json_encode($arrayDados);
}



function utf8_converter($array){
	array_walk_recursive($array, function(&$item, $key){
		if(!mb_detect_encoding($item, 'utf-8', true)){
			$item = utf8_encode($item);
		}
	});
	return $array;
}

/**
 * Função para corrigir o charset de string e ou array
 */
function correctEncoding($data, $encode) {
	if(is_array($data)){
		foreach($data as $key=>$item){
			$data[$key] = correctEncoding($item, $encode);
		}
	} else if(is_string($data)) {
		$currentEncoding = mb_detect_encoding($data, 'auto');
		$data = iconv($currentEncoding, $encode, $data);
	}
	return $data;
}

function formataSource($dados){
	$retorno = '[';
	$temp = array();
	foreach($dados as $key=>$val){
		$temp[] ='{"id":"'.$key.'", "value":"'.$val.'"}';
	}
	$retorno.= implode(',', $temp);
	$retorno.= ']';
	return $retorno;
}

function converteParaURL($texto){
	$texto = strtr($texto, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_");
	$texto = strtolower($texto);
	$texto = preg_replace('/[^a-z0-9_]/','',$texto);
	$texto = preg_replace('/[_]+/','_',$texto);
	return $texto;
}
