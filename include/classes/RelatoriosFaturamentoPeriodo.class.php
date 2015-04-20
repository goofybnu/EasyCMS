<?php
Class RelatoriosFaturamentoPeriodo {
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
	var $datahoracadastroInicial;
	var $datahoracadastroFinal;

	function pesquisar(&$arrPesquisar){
		$criterio = new DBCriterio;
		$criterio->add(new DBFiltroLivre("cob.situacao = 0"));

		if(strlen($this->datahoracadastroInicial) AND strlen($this->datahoracadastroFinal)){
			$criterio->add(new DBFiltro('c.datahoracadastro', ">=", $this->datahoracadastroInicial));
			$criterio->add(new DBFiltro('c.datahoracadastro', "<=", $this->datahoracadastroFinal));
		}
		if(strlen($this->cob_cobrancas_datavencimentoInicial) AND strlen($this->cob_cobrancas_datavencimentoFinal)){
			$criterio->add(new DBFiltro($this->filtroData, ">=", $this->cob_cobrancas_datavencimentoInicial));
			$criterio->add(new DBFiltro($this->filtroData, "<=", $this->cob_cobrancas_datavencimentoFinal));
		}
		if(strlen($this->cli_clientes_pessoafisica)){
			$criterio->add(new DBFiltro("c.pessoafisica", "=", $this->cli_clientes_pessoafisica));
		}
		if(strlen($this->cli_clientes_situacao)){
			$criterio->add(new DBFiltro("c.situacao", "=", $this->cli_clientes_situacao));
		}
		if(strlen($this->cli_enderecos_sis_cidades_codcidade)){
			$criterio->add(new DBFiltroLivre("(ev.sis_cidades_codcidade='".$this->cli_enderecos_sis_cidades_codcidade."' OR e.sis_cidades_codcidade='".$this->cli_enderecos_sis_cidades_codcidade."')"));
		}
		if(strlen($this->cob_modo)){
			$criterio->add(new DBFiltro("cob.modo", "=", $this->cob_modo));
		}
		if(strlen($this->cli_clientes_codusuarioresponsavel)){
			$criterio->add(new DBFiltro("c.codusuarioresponsavel", "=", $this->cli_clientes_codusuarioresponsavel));
		}
		if(strlen($this->fin_contascorrentes_codcontacorrente)){
			$criterio->add(new DBFiltroLivre("(cc.codcontacorrente='".$this->fin_contascorrentes_codcontacorrente."' OR ccv.codcontacorrente='".$this->fin_contascorrentes_codcontacorrente."')"));
		}
		if(strlen($this->cli_clientes_codusuarioresponsavel)){
			$criterio->add(new DBFiltro("pag.formapagamento", "=", $this->forma_de_pagamento));
		}

		$sql = new DBSqlSelecione;
		$sql->setEntidade("
	cob_cobrancas cob
	LEFT JOIN cli_clientes c 						ON c.codcliente = cob.codcliente
	LEFT JOIN fin_cobrancascliente fc 				ON fc.cli_clientes_codcliente = cob.codcliente AND fc.codcobrancascliente = cob.codcobrancacliente AND cob.modo <> 5
	LEFT JOIN fin_cobrancasclienterecargavoip fcv 	ON fcv.codcliente = cob.codcliente AND fcv.codcobrancacliente = cob.codcobrancacliente AND cob.modo = 5
	LEFT JOIN fin_tiposcobranca t 					ON t.codtiposcobranca = fc.fin_tiposcobranca_codtiposcobranca
	LEFT JOIN fin_tiposcobranca tv 					ON tv.codtiposcobranca = fcv.codtipocobranca
	LEFT JOIN fin_contascorrentes cc 				ON cc.codcontacorrente = t.fin_contascorrentes_codcontacorrente
	LEFT JOIN fin_contascorrentes ccv 				ON ccv.codcontacorrente = tv.fin_contascorrentes_codcontacorrente
	LEFT JOIN cli_enderecos e 						ON e.codendereco = fc.cli_enderecos_codendereco
	LEFT JOIN cli_enderecos ev 						ON ev.codendereco = fcv.codendereco
	LEFT JOIN cob_pagamentos pag 					ON pag.codcobranca = cob.codcobranca
");
		$sql->addColuna("c.nome AS 'cli_clientes_nome'");
		$sql->addColuna("CASE c.pessoafisica WHEN 1 THEN 'PF' ELSE 'PJ' END AS 'cli_clientes_pessoafisica'");
		$sql->addColuna("CASE c.situacao WHEN 0 THEN 'Ativo' WHEN 1 THEN 'Arquivado' WHEN 2 THEN 'Bloqueado'  WHEN 3 THEN 'Pendente' WHEN 4 THEN 'Manutencao' WHEN 5 THEN 'Bloqueado para Protesto' WHEN 6 THEN 'Viabilidade Negada' WHEN 7 THEN 'Prospecção' END AS 'cli_clientes_situacao'");
		$sql->addColuna("IF(cob.`modo`=5, ev.sis_cidades_codcidade, e.sis_cidades_codcidade) AS 'cli_enderecos_sis_cidades_codcidade'");
		$sql->addColuna("c.codusuarioresponsavel AS 'cli_clientes_codusuarioresponsavel'");
		//$sql->addColuna("t.descricao AS 'fin_tiposcobranca_descricao'");
		$sql->addColuna("IF(cob.modo=5, tv.descricao, t.descricao )AS 'fin_tiposcobranca_descricao'");
		$sql->addColuna("cob.datavencimento AS 'cob_cobrancas_datavencimento'");
		$sql->addColuna("IFNULL(pag.datapagamento, '') AS 'datapagamento'");
		$sql->addColuna("REPLACE(REPLACE(FORMAT(cob.valorcobranca, 2), ',', ''), ',', '.') AS 'cob_cobrancas_valorcobranca'");
		$sql->addColuna("IFNULL(pag.valor, '') AS 'valorpago'");
		$sql->addColuna("IF (pag.datapagamento IS NULL, IF (cob.datavencimento <= NOW(), 'Atrasado','Não Pago'), 'Pago') AS 'situacao'");
		$sql->addColuna("IF(cob.`modo`=5, (IF (ccv.descricao IS NULL, CONCAT('Conta: ', ccv.numero), ccv.descricao)), (IF (cc.descricao IS NULL, CONCAT('Conta: ', cc.numero), cc.descricao))) AS 'fin_contascorrentes_agencia'");
		$sql->addColuna("IF(cob.`modo`=5, ccv.codcontacorrente, cc.codcontacorrente) AS 'fin_contascorrentes_codcontacorrente'");
		$sql->addColuna("CASE pag.formapagamento WHEN NULL THEN '' WHEN '0' THEN 'Arquivo de remessa' WHEN '1' THEN 'Pagamento manual' ELSE 'Outros' END AS 'forma_de_pagamento'");
		$sql->addColuna("cob.modo as cob_modo");
		$sql->addColuna("c.datahoracadastro as 'cli_clientes_datahoracadastro'");

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
