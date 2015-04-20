<?php
Class RelatoriosRecargasCliente {
	var $cob_cobrancas_datavencimentoInicial;
	var $cob_cobrancas_datavencimentoFinal;
	var $cli_clientes_pessoafisica;
	var $cli_clientes_situacao;
	var $cli_enderecos_sis_cidades_codcidade;
	var $cli_clientes_codusuarioresponsavel;
	var $fin_contascorrentes_codcontacorrente;
	var $filtroData;
	var $cob_modo;
	var $forma_de_pagamento;

	function pesquisar(&$arrPesquisar){
		$criterio = new DBCriterio;
		$criterio->add(new DBFiltroLivre("cob.situacao = 0"));

		if(strlen($this->cob_cobrancas_datavencimentoInicial) AND strlen($this->cob_cobrancas_datavencimentoFinal)){
			$criterio->add(new DBFiltro($this->filtroData, ">=", $this->cob_cobrancas_datavencimentoInicial));
			$criterio->add(new DBFiltro($this->filtroData, "<=", $this->cob_cobrancas_datavencimentoFinal));
		}
		if(strlen($this->cli_clientes_pessoafisica)){
			$criterio->add(new DBFiltro("c.pessoafisica", "=", $this->cli_clientes_pessoafisica));
		}
		if(strlen($this->cli_enderecos_sis_cidades_codcidade)){
			$criterio->add(new DBFiltroLivre("(ev.sis_cidades_codcidade='".$this->cli_enderecos_sis_cidades_codcidade."' OR e.sis_cidades_codcidade='".$this->cli_enderecos_sis_cidades_codcidade."')"));
		}
		$criterio->add(new DBFiltro("cob.modo", "=", 5));
		$criterio->add(new DBFiltroLivre("pag.codcobranca IS NOT NULL"));

		$sql = new DBSqlSelecione;
		$sql->setEntidade("cob_cobrancas cob LEFT JOIN cli_clientes c ON c.codcliente = cob.codcliente LEFT JOIN fin_cobrancasclienterecargavoip fcv ON fcv.codcliente = cob.codcliente AND fcv.codcobrancacliente = cob.codcobrancacliente AND cob.modo = 5 LEFT JOIN cli_enderecos ev ON ev.codendereco = fcv.codendereco LEFT JOIN cob_pagamentos pag ON pag.codcobranca = cob.codcobranca");

		$criterio->setPropriedade('group', "c.codcliente");
		$sql->addColuna("c.nome AS 'cli_clientes_nome'");
		$sql->addColuna("CASE c.pessoafisica WHEN 1 THEN 'PF' ELSE 'PJ' END AS 'cli_clientes_pessoafisica'");
		$sql->addColuna("ev.sis_cidades_codcidade AS 'cli_enderecos_sis_cidades_codcidade'");
		$sql->addColuna("COUNT(*) AS tot_recargas");
		$sql->addColuna('REPLACE(REPLACE(FORMAT((SUM(cob.valorcobranca)/COUNT(*)),2), \',\', \'\'), \',\', \'.\') AS "med_recargas"');
		$sql->addColuna('REPLACE(REPLACE(FORMAT(SUM(cob.valorcobranca),2), \',\', \'\'), \',\', \'.\') AS "tot_recaregado"');

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
