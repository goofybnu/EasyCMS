<?php
Class RelatoriosFaturamentoNF {
	var $cob_cobrancas_datavencimentoInicial;
	var $cob_cobrancas_datavencimentoFinal;
	var $cob_cobrancas_dataPgtoInicial;
	var $cob_cobrancas_dataPgtoFinal;
	var $nf_tipo;
	var $nf_situacao;
	var $cob_pagamentos_codcontacorrente;

	function pesquisar(&$arrPesquisar){
		$criterio = new DBCriterio;
		//$criterio->add(new DBFiltroLivre("cob_notasfiscais.situacao = 0"));

		if(strlen($this->cob_cobrancas_datavencimentoInicial) AND strlen($this->cob_cobrancas_datavencimentoFinal)){
			$criterio->add(new DBFiltro("cob_notasfiscais.dataemissao", ">=", $this->cob_cobrancas_datavencimentoInicial));
			$criterio->add(new DBFiltro("cob_notasfiscais.dataemissao", "<=", $this->cob_cobrancas_datavencimentoFinal));
		}

		if(strlen($this->cob_cobrancas_dataPgtoInicial) AND strlen($this->cob_cobrancas_dataPgtoFinal)){
			$criterio->add(new DBFiltro("cob_pagamentos.datacredito", ">=", $this->cob_cobrancas_dataPgtoInicial));
			$criterio->add(new DBFiltro("cob_pagamentos.datacredito", "<=", $this->cob_cobrancas_dataPgtoFinal));
			$criterio->add(new DBFiltroLivre("cob_pagamentos.datacredito IS NOT NULL"));
		}

		if(strlen($this->nf_tipo)){
			$criterio->add(new DBFiltro("cob_notasfiscais.codtiponotafiscal", "=", $this->nf_tipo));
		}

		if(strlen($this->nf_situacao)){
			$criterio->add(new DBFiltro("cob_notasfiscais.situacao", "=", $this->nf_situacao));
		}

		if(isset($this->cob_pagamentos_codcontacorrente) AND count($this->cob_pagamentos_codcontacorrente)>0){
			$criterio->add(new DBFiltroLivre('cob_pagamentos.codcontacorrente IN ('.implode(',',$this->cob_pagamentos_codcontacorrente).')'));
		}

		$criterio->setPropriedade('group', 'cob_notasfiscais.codnotafiscal');
		$criterio->setPropriedade('order', "cob_notasfiscais.numero ASC");

		$sql = new DBSqlSelecione;
		$sql->setEntidade("
			cob_notasfiscais 
			LEFT JOIN cob_cobrancas ON cob_cobrancas.codcobranca = cob_notasfiscais.codcobranca 
			LEFT JOIN cob_pagamentos ON cob_pagamentos.codcobranca = cob_notasfiscais.codcobranca 
			");
		$sql->addColuna('`cob_notasfiscais`.`numero` AS "nf_numero"');
		$sql->addColuna('`cob_notasfiscais`.`codtiponotafiscal` AS "nf_tipo"');
		$sql->addColuna('DATE_FORMAT(`cob_notasfiscais`.`dataemissao`, \'%d/%m/%Y\') AS "nf_emissao"');
		$sql->addColuna('`cob_notasfiscais`.`nomecliente` AS "cliente"');
		$sql->addColuna('REPLACE(REPLACE(FORMAT(`cob_notasfiscais`.`valor`, 2), \',\', \'\'), \',\', \'.\') AS "nf_valor"');
		$sql->addColuna('`cob_notasfiscais`.`situacao` AS "nf_situacao"');
		$sql->addColuna("IFNULL(DATE_FORMAT(`cob_cobrancas`.`datavencimento`, '%d/%m/%Y'), 'Sem cobrança') AS 'data_vencimento'");
		$sql->addColuna("IFNULL(`cob_cobrancas`.`valorcobranca`, '') AS 'valor_cobranca'");
		$sql->addColuna("IFNULL(DATE_FORMAT(`cob_pagamentos`.`datacredito`, '%d/%m/%Y'), 'Não pago') AS 'data_credito'");
		$sql->addColuna("IFNULL(`cob_pagamentos`.`valor`, '') AS 'valor_pago'");
		$sql->addColuna("REPLACE(REPLACE(FORMAT(SUM(IFNULL(cob_notasfiscais.valorbasecalculoicms, '0')), 2), ',', ''), ',', '.') AS 'base_calculo'");
		$sql->addColuna("REPLACE(REPLACE(FORMAT(SUM(IFNULL(cob_notasfiscais.valoricms, '0')), 2), ',', ''), ',', '.' ) AS 'icms'");
		$sql->addColuna('`cob_pagamentos`.`codcontacorrente` AS "cob_pagamentos_codcontacorrente"');
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

