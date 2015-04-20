<?php
/**
 * Função para fazer auto include da classe
 * 
 * @param string $ClassName nome da classe a ser carregada
 * @return boolean
 */
function __autoload($ClassName){
	$ClassFile = $ClassName.'.class.php';
	$ClassFilePath = implode(DIRECTORY_SEPARATOR, array(classesPath, $ClassFile));
	if(file_exists($ClassFilePath)){
		try {
			require_once($ClassFilePath);
			return true;
		} catch (Exception $e) {
			systemDebug($e->getMessage());
			die('Erro ao inicial Classe "'.$ClassName.'"!');
			return false;
		}
	}
}

/**
 * Função para dobugar e ou logar erros
 * 
 * @param string/array $message conteúdo da mensagem
 */
function systemDebug($message){
	echo '<pre class="debugScreen">' . date("Y-m-d H:i:s") . "\t";
	if(is_array($message)){
		for($i=0;$i<count($message);$i++){
			if($i!=0) echo "\n                   \t";
			echo $message[$i];
		}
	} else {
		echo $message;
	}
	echo '</pre>';
}

function getFormValue($campo){
	$valor = $_POST[$campo];
	return $valor;
}

/**
 * Funcção para formatar valores de moeda
 * 
 * @param int/decimal $valor valor a ser formatado
 * @param number $valorFormatado
 * @return boolean
 */
function formataMoeda($valor, &$valorFormatado){
	try {
		$valorFormatado = number_format($valor, 2, ',', '.');
		return true;
	} catch (Exception $e) {
		systemDebug($e->getMessage());
		return false;
	}
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
	return gmdate("H:i:s", $tempo);
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

function converteParaURL($texto){
	$texto = strtr($texto, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_");
	$texto = strtolower($texto);
	$texto = preg_replace('/[^a-z0-9_]/','',$texto);
	$texto = preg_replace('/[_]+/','_',$texto);
	return $texto;
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

/**
 * Função para retornar todas as unidades cadastradas no erp
 */
function retornaUnidades(){
	$sql = new DBSqlSelecione;
	$sql->setEntidade('sis_unidades');
	$sql->addColuna('id');
	$sql->addColuna('unidade');
	$sql->addColuna('sigla');
	$sql->addColuna('situacao');
	$sql->addColuna('url_bemtevi');
	$sql->addColuna('url_daloinfo');
	$sql->addColuna('db_host');
	$sql->addColuna('db_user');
	$sql->addColuna('db_pass');
	$sql->addColuna('db_base');
	$sql->addColuna('acesso_host');
	$sql->addColuna('acesso_user');
	$sql->addColuna('acesso_pass');
	$sql->addColuna('acesso_tipo');
	try {
		$conexao = DBConexao::open();
		$resultado = $conexao->query($sql->getInstrucao());
		$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
		$unidades = array();
		foreach($dados as $unidade){
			$unidades[$unidade['id']] = $unidade;
		}
		return $unidades;
	} catch(PDOException $e){
		systemDebug($e->getMessage());
		return false;
	}
}

/**
 * Retorna a lista de privilégios de uma unidade
 */
function retornaListaPrivilegios($unidadeID){
	$unidades 		= retornaUnidades();
	$servidor 		= $unidades[$unidadeID]['db_host'];
	$usuario 		= $unidades[$unidadeID]['db_user'];
	$senha 			= $unidades[$unidadeID]['db_pass'];
	$bancoDeDados 	= $unidades[$unidadeID]['db_base'];

	$sql = new DBSqlSelecione;
	$sql->setEntidade('sis_grupos');
	$sql->addColuna('codgrupo');
	$sql->addColuna('nome');

	$criterio = new DBCriterio;
	$criterio->setPropriedade('order', 'nome');
	$sql->setCriterio($criterio);

	try {
		$conexao = DBConexao::openCustom($servidor, $usuario, $senha, $bancoDeDados);
		$resultado = $conexao->query($sql->getInstrucao());
		$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
		$privilegios = array();
		foreach($dados as $item){
			$privilegios[$item['codgrupo']] = array($item['codgrupo'],$item['nome']);
		}
		return $privilegios;
	} catch(PDOException $e){
		systemDebug($e->getMessage());
		return false;
	}
}

/**
 * Retorna a lista de departamentos de uma unidade
 */
function retornaListaDepartamentos($unidadeID){
	$unidades 		= retornaUnidades();
	$servidor 		= $unidades[$unidadeID]['db_host'];
	$usuario 		= $unidades[$unidadeID]['db_user'];
	$senha 			= $unidades[$unidadeID]['db_pass'];
	$bancoDeDados 	= $unidades[$unidadeID]['db_base'];

	$sql = new DBSqlSelecione;
	$sql->setEntidade('sis_departamentos');
	$sql->addColuna('codigo');
	$sql->addColuna('nome');

	$criterio = new DBCriterio;
	$criterio->setPropriedade('order', 'nome');
	$sql->setCriterio($criterio);

	try {
		$conexao = DBConexao::openCustom($servidor, $usuario, $senha, $bancoDeDados);
		$resultado = $conexao->query($sql->getInstrucao());
		$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
		$privilegios = array();
		foreach($dados as $item){
			$privilegios[$item['codigo']] = array($item['codigo'],$item['nome']);
		}
		return $privilegios;
	} catch(PDOException $e){
		systemDebug($e->getMessage());
		return false;
	}
}

/**
 * Retorna a lista de usuários de uma unidade
 */
function retornaUsuarios($unidadeID=false){
	$unidades 		= retornaUnidades();
	$usuarios 		= array();

	$sql = new DBSqlSelecione;
	$sql->setEntidade('sis_usuarios');
	$sql->addColuna('codusuario');
	$sql->addColuna('usuario');
	$sql->addColuna('nome');

	$criterio = new DBCriterio;
	$criterio->add(new DBFiltro('situacao', '=', '0'));
	$criterio->setPropriedade('order', 'nome');
	$sql->setCriterio($criterio);

	try {
		if($unidadeID==false){
			foreach($unidades AS $unidade){
				$unidadeID 		= $unidade['id'];
				$servidor 		= $unidade['db_host'];
				$usuario 		= $unidade['db_user'];
				$senha 			= $unidade['db_pass'];
				$bancoDeDados 	= $unidade['db_base'];
				$conexao 		= DBConexao::openCustom($servidor, $usuario, $senha, $bancoDeDados);
				$resultado 		= $conexao->query($sql->getInstrucao());
				$dados 			= $resultado->fetchAll(PDO::FETCH_ASSOC);
				$privilegios 	= array();
				foreach($dados as $item){
					$usuarios[$unidadeID][$item['codusuario']] = array(
						'id'=>$item['codusuario'],
						'text'=>$item['nome'],
						'subtext'=>$item['usuario']
					);
				}
			}
		} else {
			$servidor 		= $unidades[$unidadeID]['db_host'];
			$usuario 		= $unidades[$unidadeID]['db_user'];
			$senha 			= $unidades[$unidadeID]['db_pass'];
			$bancoDeDados 	= $unidades[$unidadeID]['db_base'];
			$conexao 		= DBConexao::openCustom($servidor, $usuario, $senha, $bancoDeDados);
			$resultado 		= $conexao->query($sql->getInstrucao());
			$dados 			= $resultado->fetchAll(PDO::FETCH_ASSOC);
			$privilegios 	= array();
			foreach($dados as $item){
				$usuarios[$item['codusuario']] = array(
					'id'=>$item['codusuario'],
					'text'=>$item['nome'],
					'subtext'=>$item['usuario']
				);
			}
		}
		return $usuarios;
	} catch(PDOException $e){
		systemDebug($e->getMessage());
		return false;
	}
}

/**
 * Função para montar o bootstrap select
 * 
 * @param string $name nome que será atribuído ao name e id do select
 * @param string $table tabela onde deverá ser feito o select 
 * @param string $colVal nome da coluna que contém o valor do item
 * @param string $colText nome da coluna que contém o texto o item
 * @param boolean $liveSearch ativa ou não o live search no select
 * @param boolean $multiSelect ativa ou não a multipla seleção
 * @param string/array $filtro filtro(s) a serem aplicados no select
 *                       Ex1.: "col1='val1'"
 *                       Ex2.: array("col1='val1'","cold2='val2'")
 * @param string $colOrder coluna de ordenação
 * @param array $customConn array contendo os dados de conexao customizada
 * 							array(
 * 								'host'=>'localhost',
 * 								'user'=>'usuario',
 * 								'pass'=>'senha',
 * 								'base'=>'basededados'
 * 							);
 */
function montaSelect($name, $table, $colVal, $colText, $liveSearch=true, $multiSelect=false, $filtro=false, $colOrder=false, $customConn=false){
	$sql = new DBSqlSelecione;
	$sql->setEntidade($table);
	$sql->addColuna($colVal);
	$sql->addColuna($colText);
	$criterio = new DBCriterio;
	if($filtro){
		if(is_array($filtro)){
			foreach($filtro as $filtroItem){
				$criterio->add(new DBFiltroLivre($filtroItem));
			}
		} else {
			$criterio->add(new DBFiltroLivre($filtro));
		}
	}
	if($colOrder){
		$criterio->setPropriedade('order', $colOrder);
	} else {
		$criterio->setPropriedade('order', $colText);
	}
	$sql->setCriterio($criterio);
	try {
		if(is_array($customConn)){
			$conexao = DBConexao::openCustom($customConn['host'], $customConn['user'], $customConn['pass'], $customConn['base']);
		} else {
			$conexao = DBConexao::open();
		}
		$conexao->query("SET NAMES UTF8");
		$resultado = $conexao->query($sql->getInstrucao());
		$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
		$html = '<select id="'.$name.'" name="'.$name.'" class="selectpicker"  data-width="100%"';
		if($liveSearch) $html.= ' data-live-search="true"';
		if($multiSelect) $html.= ' multiple';
		$html.= '>';
		if(count($dados)>0){
			foreach($dados as $item){
				$html.= '<option value="'.$item[$colVal].'">'.$item[$colText].'</option>';
			}
		}
		$html.= '</select>';
		return $html;
	} catch(PDOException $error){
		print_r($error->getMessage());
	}
}