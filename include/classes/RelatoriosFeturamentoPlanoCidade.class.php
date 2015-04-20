<?php
Class RelatoriosFeturamentoPlanoCidade {
	var $cob_cobrancas_datavencimentoInicial;
	var $cob_cobrancas_datavencimentoFinal;
	var $cob_cobrancas_modo;
	var $cli_enderecos_sis_cidades_codcidade;
	var $cob_cobrancaitens_especie;
	var $fin_contascorrentes_codcontacorrente;

	function pesquisar(&$arrPesquisar){
		$criterio = new DBCriterio;
		$criterio->add(new DBFiltroLivre("fin_cobrancascliente.cli_clientes_codcliente = cli_clientes.codcliente"));
		$criterio->add(new DBFiltroLivre("fin_cobrancascliente.fin_tiposcobranca_codtiposcobranca = fin_tiposcobranca.codtiposcobranca"));
		$criterio->add(new DBFiltroLivre("fin_tiposcobranca.fin_contascorrentes_codcontacorrente = fin_contascorrentes.codcontacorrente"));
		$criterio->add(new DBFiltroLivre("fin_cobrancascliente.cli_enderecos_codendereco = cli_enderecos.codendereco"));
		$criterio->add(new DBFiltroLivre("cli_enderecos.sis_cidades_codcidade = sis_cidades.codcidade"));
		$criterio->add(new DBFiltroLivre("cob_cobrancas.codcliente = cli_clientes.codcliente"));
		$criterio->add(new DBFiltroLivre("cob_cobrancas.codcobrancacliente = fin_cobrancascliente.codcobrancascliente"));
		$criterio->add(new DBFiltroLivre("cob_cobrancas.codcobranca = cob_cobrancaitens.cob_cobrancas_codcobranca"));

		if(strlen($this->cob_cobrancas_datavencimentoInicial) AND strlen($this->cob_cobrancas_datavencimentoFinal)){
			$criterio->add(new DBFiltro("cob_cobrancas.datavencimento", ">=", $this->cob_cobrancas_datavencimentoInicial));
			$criterio->add(new DBFiltro("cob_cobrancas.datavencimento", "<=", $this->cob_cobrancas_datavencimentoFinal));
		}
		if(strlen($this->cob_cobrancas_modo)){
			$criterio->add(new DBFiltro("cob_cobrancas.modo", "=", $this->cob_cobrancas_modo));
		}
		if(strlen($this->cli_enderecos_sis_cidades_codcidade)){
			$criterio->add(new DBFiltro("cli_enderecos_sis_cidades.codcidade", "=", $this->cli_enderecos_sis_cidades_codcidade));
		}
		if(strlen($this->fin_contascorrentes_codcontacorrente)){
			$criterio->add(new DBFiltro("fin_contascorrentes.codcontacorrente", "=", $this->fin_contascorrentes_codcontacorrente));
		}

		$sql = new DBSqlSelecione;
		$sql->setEntidade("`cli_clientes`, `cli_enderecos`, `fin_cobrancascliente`, `sis_cidades`, `fin_tiposcobranca`, `cob_cobrancas`, fin_contascorrentes, `cob_cobrancaitens` LEFT JOIN `plan_planos` ON `plan_planos`.`codplano` = `cob_cobrancaitens`.`coditem` AND `cob_cobrancaitens`.`especie` = 0");
		$sql->addColuna('cli_clientes.nome AS "cliente_nome"');
		$sql->addColuna('cob_cobrancas.modo AS "cob_cobrancas_modo"');
		$sql->addColuna('sis_cidades.nome AS "sis_cidades_nome"');
		$sql->addColuna('cob_cobrancas.datavencimento AS "cob_cobrancas_datavencimento"');
		$sql->addColuna('cob_cobrancas.valorcobranca AS "cob_cobrancas_valorcobranca"');
		$sql->addColuna("CASE WHEN cob_cobrancaitens.especie = '11' THEN 'Telefonia: Utilização adicional' WHEN plan_planos.descricao IS NULL AND cob_cobrancaitens.coditem = 0 THEN 'Informação Manual' WHEN plan_planos.descricao IS NOT NULL AND cob_cobrancaitens.coditem > 0 THEN plan_planos.descricao ELSE cob_cobrancaitens.descricao END AS 'especie'");
		$sql->addColuna('cob_cobrancaitens.especie AS "cob_cobrancaitens_especie"');
		$sql->addColuna('cob_cobrancaitens.valor AS "cob_cobrancaitens_valor"');
		$sql->addColuna('IF (fin_contascorrentes.descricao IS NULL, CONCAT("Conta: ", fin_contascorrentes.numero), fin_contascorrentes.descricao) AS "fin_contascorrentes_agencia"');
		$sql->addColuna('fin_contascorrentes.codcontacorrente AS "fin_contascorrentes_codcontacorrente"');
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
