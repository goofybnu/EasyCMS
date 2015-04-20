<?php
Class RelatoriosSuporteAnalitico {
	var $dataInicial;
	var $dataFinal;
	var $classe;
	var $categoria;
	var $situacao;

	function pesquisar(&$arrPesquisar){
		$criterio = new DBCriterio;

		$criterio->add(new DBFiltroLivre("sup.codcategoria = cat.codcategoria"));
		$criterio->add(new DBFiltroLivre("sup.sup_classes_codclasse = cla.codclasse"));
		$criterio->add(new DBFiltroLivre("sup.sup_situacoes_codsituacao = sit.codsituacao"));

		if(strlen($this->dataInicial) AND strlen($this->dataFinal)){
			$criterio->add(new DBFiltro('sup.datacadastro', ">=", $this->dataInicial));
			$criterio->add(new DBFiltro('sup.datacadastro', "<=", $this->dataFinal));
		}

		if(isset($this->classe) AND count($this->classe)>0){
			$criterio->add(new DBFiltroLivre('sup.sup_classes_codclasse IN ('.implode(',',$this->classe).')'));
		}

		if(isset($this->categoria) AND count($this->categoria)>0){
			$criterio->add(new DBFiltroLivre('sup.sup_classes_codclasse IN ('.implode(',',$this->categoria).')'));
		}

		if(isset($this->situacao) AND count($this->situacao)>0){
			$criterio->add(new DBFiltroLivre('sup.sup_situacoes_codsituacao IN ('.implode(',',$this->situacao).')'));
		}

		$sql = new DBSqlSelecione;
		$sql->setEntidade('sup_suportes sup, sup_classes cla, sup_categorias cat, sup_situacoes sit');

		$criterio->setPropriedade('group', 'cla.descricao, cat.descricao, sit.descricao');
		$sql->addColuna("cla.descricao AS 'classe'");
		$sql->addColuna("cat.descricao AS 'categoria'");
		$sql->addColuna("sit.descricao AS 'situacao'");
		$sql->addColuna("COUNT(*) AS 'total'");

		$sql->setCriterio($criterio);
		try{
			$conexao = RelatoriosDBConexao::open();
			$resultado = $conexao->query($sql->getInstrucao());
			$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);
			$arrPesquisar = $dados;
			return (true);
		} catch(PDOException $error){
			print_r($error->getMessage());
			return (false);
		}
	}
}
