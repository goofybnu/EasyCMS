<?php
Class RelatoriosFiltros {
	function retornaValoresCampos($tabela, $chave, $valor, $filtro, &$dados){
		$sql = new DBSqlSelecione;
		$sql->setEntidade($tabela);
		if($filtro){
			$criterio = new DBCriterio;
			if(is_array($filtro)){
				foreach($filtro as $tempFiltro)
				$criterio->add(new DBFiltroLivre($tempFiltro));
			} else {
				$criterio->add(new DBFiltroLivre($filtro));
			}
			$sql->setCriterio($criterio);
		}
		if($chave){
			$sql->addColuna($chave);
			$sql->addColuna($valor);
		} else {
			$sql->addColuna('DISTINCT('.$valor.')');
		}
		try{
			$conexao = RelatoriosDBConexao::open();
			$resultado = $conexao->query($sql->getInstrucao());
			$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
			return (true);
		} catch(PDOException $error){
			print_r($error->getMessage());
			return (false);
		}
	}
}
