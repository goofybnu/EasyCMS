<?php
Class RelatoriosFaturamentoMensal {
	var $cob_cobrancas_datavencimentoInicial;
	var $cob_cobrancas_datavencimentoFinal;
	var $cli_clientes_pessoafisica;
	var $cob_cobrancas_modo;
	var $cob_cobrancas_cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca;
	var $cli_clientes_codrevenda;

	function pesquisar(&$arrPesquisar){
		$criterio = new DBCriterio;
		$criterio->add(new DBFiltroLivre("cob_cobrancas.situacao = 0"));
		$criterio->add(new DBFiltroLivre("cli_clientes.codcliente = cob_cobrancas.codcliente"));

		if(strlen($this->cob_cobrancas_datavencimentoInicial) AND strlen($this->cob_cobrancas_datavencimentoFinal)){
			$criterio->add(new DBFiltro("cob_cobrancas.datavencimento", ">=", $this->cob_cobrancas_datavencimentoInicial));
			$criterio->add(new DBFiltro("cob_cobrancas.datavencimento", "<=", $this->cob_cobrancas_datavencimentoFinal));
		}
		if(strlen($this->cob_cobrancas_modo)){
			$criterio->add(new DBFiltro("cob_cobrancas.modo", "=", $this->cob_cobrancas_modo));
		}
		if(strlen($this->cli_clientes_pessoafisica)){
			$criterio->add(new DBFiltro("cli_clientes.pessoafisica", "=", $this->cli_clientes_pessoafisica));
		}

		if(strlen($this->cob_cobrancas_cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca)){
			$criterio->add(new DBFiltroLivre("cob_cobrancas.cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca IN (".$this->cob_cobrancas_cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca.")"));
		}

		if(strlen($this->cli_clientes_codrevenda)){
			$criterio->add(new DBFiltroLivre("cli_clientes.codrevenda IN (".$this->cli_clientes_codrevenda.")"));
		}

		$grp = "MONTH(`cob_cobrancas`.`datavencimento`), YEAR(`cob_cobrancas`.`datavencimento`), `cli_clientes`.`pessoafisica`, `cob_cobrancas`.`modo`";
		if(strlen($this->cob_cobrancas_cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca)){
			$grp.= ", cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca";
		}

		if(strlen($this->cli_clientes_codrevenda)){
			$grp.= ", cli_clientes_codrevenda";
		}

		$criterio->setPropriedade('group', $grp);

		$criterio->setPropriedade('order', "YEAR(  `cob_cobrancas`.`datavencimento`  ) DESC, MONTH(  `cob_cobrancas`.`datavencimento`  ) DESC");

		$sql = new DBSqlSelecione;
		$sql->setEntidade("cob_cobrancas, cli_clientes");
		$sql->addColuna('DATE_FORMAT(cob_cobrancas.datavencimento,"%m/%Y") AS "vencimento"');
		$sql->addColuna('REPLACE(REPLACE(FORMAT(SUM(cob_cobrancas.valorcobranca), 2), \',\', \'\'), \',\', \'.\') AS "val_cobranca"');
		$sql->addColuna('COUNT(*) AS tot_cobrancas');
		$sql->addColuna('REPLACE(REPLACE(FORMAT((SUM(cob_cobrancas.valorcobranca)/COUNT(*)),2), \',\', \'\'), \',\', \'.\') AS "ticket"');
		$sql->addColuna("CASE cli_clientes.pessoafisica WHEN 1 THEN 'PF' ELSE 'PJ' END AS 'cli_clientes_pessoafisica'");
		$sql->addColuna("cob_cobrancas.modo AS 'cob_cobrancas_modo'");
		$sql->addColuna("'' AS 'cob_cobrancas_cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca'");
		$sql->addColuna("'' AS 'cli_clientes_codrevenda'");
		//$sql->addColuna("cob_cobrancas.cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca AS cob_cobrancas_cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca");
		//$sql->addColuna("cli_clientes.codrevenda AS cli_clientes_codrevenda");


//ORDER BY YEAR(  `cob_cobrancas`.`datavencimento`  ) DESC, MONTH(  `cob_cobrancas`.`datavencimento`  ) DESC

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
