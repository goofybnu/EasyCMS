<?php
Class RelatoriosVendasConsultor {
	var $cli_clientes_codcliente;
	var $cli_clientes_nome;
	var $cli_clientes_cpfcnpj;
	var $cli_clientes_inscricaoestadual;
	var $cli_clientes_pessoafisica;
	var $cli_clientes_razaosocial;
	var $cli_clientes_datahoracadastro;
	var $cli_clientes_datahoracadastroInicio;
	var $cli_clientes_datahoracadastroFinal;
	var $cli_clientes_rg;
	var $cli_clientes_datanascimento;
	var $cli_clientes_nomemae;
	var $cli_clientes_nomepai;
	var $cli_clientes_codusuarioresponsavel;
	var $cli_clientes_obs;
	var $cli_clientes_datacontrato;
	var $cli_clientes_dataativacao;
	var $cli_clientes_datacabeamento;
	var $cli_clientes_situacao;
	var $cli_clientes_codsituacaogrupo;
	var $cli_clientes_contato;
	var $cli_clientes_centralassinantestatus;
	var $cli_clientes_inscricaomunicipal;
	var $cli_clientes_centralassinantelogin;
	var $cli_clientes_centralassinantesenha;
	var $cli_clientes_informacaocontabil;
	var $cli_clientes_logarapenasusuariocentralassinante;
	var $cli_clientes_nomefantasia;
	var $cli_clientes_profissao;
	var $cli_clientes_estadocivil;
	var $cli_clientes_codcidadenaturalidade;
	var $cli_clientes_codpaisnacionalidade;
	var $cli_clientes_bloquearautomaticamenteseinadimplente;
	var $cli_clientes_codusuariocadastro;
	var $cli_clientes_dataentregacontrato;
	var $cli_clientes_pessoaspodemsolicitarsuportes;
	var $cli_clientes_rgorgaoemissor;
	var $cli_clientes_codrevenda;
	var $cli_clientes_dataultimaatualizacaodadoscadastrais;
	var $cli_clientes_proprietario;
	var $cli_clientes_proprietariocpf;
	var $cli_clientes_spc;
	var $cli_clientes_codramoatividade;
	var $cli_clientes_codIntegradorERP;
	var $cli_clientes_observacaoSerasa;
	var $cli_clientes_codholding;
	var $cli_clientes_autonomo;
	var $cli_enderecos_codendereco;
	var $cli_enderecos_cli_clientes_codcliente;
	var $cli_enderecos_sis_cidades_sis_estados_codestado;
	var $cli_enderecos_sis_cidades_codcidade;
	var $cli_enderecos_bairro;
	var $cli_enderecos_rua;
	var $cli_enderecos_cep;
	var $cli_enderecos_complemento;
	var $cli_enderecos_caixapostal;
	var $cli_enderecos_codpredio;
	var $cli_enderecos_ssid;
	var $cli_enderecos_codcep;
	var $cli_enderecos_obs;
	var $cli_enderecos_removido;
	var $cli_enderecos_latitude;
	var $cli_enderecos_longitude;
	var $cli_enderecos_tipoendereco;
	var $fin_cobrancascliente_codcobrancascliente;
	var $fin_cobrancascliente_cli_clientes_codcliente;
	var $fin_cobrancascliente_fin_tiposcobranca_codtiposcobranca;
	var $fin_cobrancascliente_cli_enderecos_cli_clientes_codcliente;
	var $fin_cobrancascliente_cli_enderecos_codendereco;
	var $fin_cobrancascliente_codendereco_nf;
	var $fin_cobrancascliente_diacobranca;
	var $fin_cobrancascliente_descricao;
	var $fin_cobrancascliente_codcontacorrente;
	var $fin_cobrancascliente_codcartaocredito;
	var $fin_cobrancascliente_codtiponotafiscal;
	var $fin_cobrancascliente_impostos;
	var $fin_cobrancascliente_codgrupoimposto;
	var $fin_cobrancascliente_datacobranca;
	var $fin_cobrancascliente_modo;
	var $fin_cobrancascliente_nrdiastolerancia;
	var $fin_cobrancascliente_cfop;
	var $fin_cobrancascliente_nfobsimpressao;
	var $fin_cobrancascliente_enviaravisogeracaocobranca;
	var $fin_cobrancascliente_comportamentosespeciais;
	var $fin_cobrancascliente_removida;
	var $fin_cobrancascliente_emailnfe;
	var $fin_cobrancascliente_parceladecodclientecobrancaespecial;
	var $fin_cobrancascliente_valorvenda;
	var $fin_cobrancascliente_venda_codtransportadora;
	var $fin_cobrancascliente_venda_opcaofrete;
	var $fin_cobrancascliente_venda_valorfrete;
	var $fin_cobrancascliente_codenderecodestinatario_nf;
	var $fin_cobrancasclienteplanos_codcobrancasclienteplanos;
	var $fin_cobrancasclienteplanos_plan_planos_codplano;
	var $fin_cobrancasclienteplanos_fin_cobrancascliente_codcobrancascliente;
	var $fin_cobrancasclienteplanos_precocliente;
	var $fin_cobrancasclienteplanos_cortesia;
	var $fin_cobrancasclienteplanos_datacadastro;
	var $fin_cobrancasclienteplanos_datacadastroInicio;
	var $fin_cobrancasclienteplanos_datacadastroFinal;
	var $fin_cobrancasclienteplanos_dataativacao;
	var $fin_cobrancasclienteplanos_dataativacaoInicio;
	var $fin_cobrancasclienteplanos_dataativacaoFinal;
	var $fin_cobrancasclienteplanos_datadesativacao;
	var $fin_cobrancasclienteplanos_datadesativacaoInicio;
	var $fin_cobrancasclienteplanos_datadesativacaoFinal;
	var $fin_cobrancasclienteplanos_codrevenda;
	var $fin_cobrancasclienteplanos_diabilhetageminicial;
	var $fin_cobrancasclienteplanos_diabilhetagemfinal;
	var $fin_cobrancasclienteplanos_quantidade;
	var $fin_cobrancasclienteplanos_obs;
	var $fin_cobrancasclienteplanos_mescobranca;
	var $fin_cobrancasclienteplanos_anocobranca;
	var $fin_cobrancasclienteplanos_datadesativado;
	var $fin_cobrancasclienteplanos_periodocliente;
	var $fin_cobrancasclienteplanos_codigosagentesdominioemail;
	var $fin_cobrancasclienteplanos_descricaoboleto;
	var $fin_cobrancasclienteplanos_descricaonotafiscal;
	var $fin_cobrancasclienteplanos_codplanoanterior;
	var $fin_cobrancasclienteplanos_codendereco;
	var $fin_cobrancasclienteplanos_codDesignador;
	var $fin_cobrancasclienteplanos_PK_codCobrancaClientePlano;
	var $fin_tiposcobranca_codtiposcobranca;
	var $fin_tiposcobranca_fin_contascorrentes_codcontacorrente;
	var $fin_tiposcobranca_fin_gruposcobranca_codgrupocobranca;
	var $fin_tiposcobranca_descricao;
	var $fin_tiposcobranca_diacobranca;
	var $fin_tiposcobranca_formapagamento;
	var $fin_tiposcobranca_possuinumsequencial;
	var $fin_tiposcobranca_scriptnninicializacao;
	var $fin_tiposcobranca_scriptnngeracao;
	var $fin_tiposcobranca_scriptnnfinalizacao;
	var $fin_tiposcobranca_scriptnndigitoverificador;
	var $fin_tiposcobranca_scriptsninicializacao;
	var $fin_tiposcobranca_scriptsngeracao;
	var $fin_tiposcobranca_scriptsnfinalizacao;
	var $fin_tiposcobranca_scriptnomearquivocobranca;
	var $fin_tiposcobranca_localarquivobol;
	var $fin_tiposcobranca_caminhoarquivocobranca;
	var $fin_tiposcobranca_caminhorelativoarquivocobranca;
	var $fin_tiposcobranca_diabilhetageminicial;
	var $fin_tiposcobranca_diabilhetagemfinal;
	var $fin_tiposcobranca_localarquivoqui;
	var $fin_tiposcobranca_scriptnnretorno;
	var $fin_tiposcobranca_scriptsnretorno;
	var $fin_tiposcobranca_localarquivoboletoimpresso;
	var $fin_tiposcobranca_gruponsa;
	var $fin_tiposcobranca_tipopessoa;
	var $fin_tiposcobranca_numerocobrancaspagina;
	var $fin_tiposcobranca_localarquivobolbaixacobrancaregistrada;
	var $fin_tiposcobranca_scriptnomearquivobaixacobrancaregistrada;
	var $fin_tiposcobranca_caminhoarquivobaixacobrancaregistrada;
	var $fin_tiposcobranca_caminhorelativoarquivobaixacobrancaregistrada;
	var $fin_tiposcobranca_localarquivoboletoimpressohtml;
	var $fin_tiposcobranca_scriptnnretornocodcobranca;
	var $fin_tiposcobranca_planosquesempredevemsercobrados;
	var $fin_tiposcobranca_tipobilhetagem;
	var $fin_tiposcobranca_status;
	var $fin_tiposcobranca_VOIP_CDR_DiaBilhetagemInicial;
	var $fin_tiposcobranca_VOIP_CDR_DiaBilhetagemFinal;
	var $fin_tiposcobranca_VOIP_CDR_TipoBilhetagem;
	var $plan_planos_codplano;
	var $plan_planos_nome;
	var $plan_planos_periodo;
	var $plan_planos_datacriacao;
	var $plan_planos_descricao;
	var $plan_planos_periodoexpiracao;
	var $plan_planos_planoposexpiracao;
	var $plan_planos_precoforcado;
	var $plan_planos_codgrupoplano;
	var $plan_planos_diabilhetageminicial;
	var $plan_planos_diabilhetagemfinal;
	var $plan_planos_cobrarprorataadicionaldiaativacaomaiorigualque;
	var $plan_planos_cobrarprorataadicionaldiaativacaomenorigualque;
	var $plan_planos_nrdiasadicionarcalculobilhetagem;
	var $plan_planos_aparecernf;
	var $plan_planos_adicional;
	var $plan_planos_nrdiasgratis;
	var $plan_planos_status;
	var $plan_planos_prepago;
	var $plan_planos_emailespacodiscototal;
	var $plan_planos_obs;
	var $plan_planos_parametrosadicionaisprovedor;
	var $plan_planos_VOIP;
	var $plan_planos_codservicoprefeitura;
	var $plan_planos_disponivelParaTipoPessoa;
	var $plan_planos_VOIP_quandoCobrarCDR;
	var $plan_grupos_codgrupoplano;
	var $plan_grupos_descricao;
	var $cob_cobrancas_codcobranca;
	var $cob_cobrancas_cob_cobrancasgeradas_fin_tiposcobranca_codtiposcobranca;
	var $cob_cobrancas_cob_cobrancasgeradas_codcobrancagerada;
	var $cob_cobrancas_codcobrancacliente;
	var $cob_cobrancas_codcliente;
	var $cob_cobrancas_datavencimento;
	var $cob_cobrancas_datavencimentoInicial;
	var $cob_cobrancas_datavencimentoFinal;
	var $cob_cobrancas_valorcobranca;
	var $cob_cobrancas_nossonumero;
	var $cob_cobrancas_seunumero;
	var $cob_cobrancas_situacao;
	var $cob_cobrancas_codhistoricosituacao;
	var $cob_cobrancas_nrnotafiscal;
	var $cob_cobrancas_dataemissaonotafiscal;
	var $cob_cobrancas_dataprocessamento;
	var $cob_cobrancas_modo;
	var $cob_cobrancas_statuscobrancaregistrada;
	var $cob_cobrancas_cfop;
	var $cob_cobrancas_dda;
	var $cob_pagamentos_codpagamento;
	var $cob_pagamentos_codtiposcobranca;
	var $cob_pagamentos_codcobrancagerada;
	var $cob_pagamentos_codcobrancacliente;
	var $cob_pagamentos_codcobranca;
	var $cob_pagamentos_valor;
	var $cob_pagamentos_datapagamento;
	var $cob_pagamentos_nsa;
	var $cob_pagamentos_obs;
	var $cob_pagamentos_databaixa;
	var $cob_pagamentos_horabaixa;
	var $cob_pagamentos_formapagamento;
	var $cob_pagamentos_codcontacorrente;
	var $cob_pagamentos_codusuario;
	var $cob_pagamentos_codigoplanoconta;
	var $cob_pagamentos_datacredito;
	var $cob_pagamentos_valormulta;
	var $cob_pagamentos_valortaxabancaria;
	var $cob_pagamentos_duplicado;
	var $sis_cidades_nome;
	var $cob_cobrancaitens_especie;
	var $sis_departamentos_codigo;

	function pesquisar(&$arrPesquisar) {
		$criterio = new DBCriterio;
		$criterio->add(new DBFiltroLivre("cli_clientes.codcliente = cli_enderecos.cli_clientes_codcliente"));
		$criterio->add(new DBFiltroLivre("cli_enderecos.codendereco = fin_cobrancascliente.cli_enderecos_codendereco"));
		$criterio->add(new DBFiltroLivre("fin_cobrancascliente.cli_clientes_codcliente = cli_clientes.codcliente"));
		$criterio->add(new DBFiltroLivre("fin_cobrancascliente.codcobrancascliente = fin_cobrancasclienteplanos.fin_cobrancascliente_codcobrancascliente"));
		$criterio->add(new DBFiltroLivre("fin_cobrancascliente.fin_tiposcobranca_codtiposcobranca = fin_tiposcobranca.codtiposcobranca"));
		$criterio->add(new DBFiltroLivre("fin_cobrancasclienteplanos.plan_planos_codplano = plan_planos.codplano"));
		$criterio->add(new DBFiltroLivre("sis_cidades.codcidade = cli_enderecos.sis_cidades_codcidade"));
		//$criterio->add(new DBFiltroLivre("sis_grupos_usuarios.codusuario = cli_clientes.codusuarioresponsavel"));
		//$criterio->add(new DBFiltroLivre("sis_usuarios.codusuario = cli_clientes.codusuarioresponsavel"));
		$criterio->add(new DBFiltroLivre("plan_planos.codgrupoplano = plan_grupos.codgrupoplano"));

		if(strlen($this->cli_clientes_codcliente)){
			$criterio->add(new DBFiltro("cli_clientes.codcliente", "=", $this->cli_clientes_codcliente));
		}
		if(strlen($this->cli_clientes_nome)){
			$criterio->add(new DBFiltro("cli_clientes.nome", "LIKE", "%".$this->cli_clientes_nome."%"));
		}
		if(strlen($this->cli_clientes_cpfcnpj)){
			$criterio->add(new DBFiltro("cli_clientes.cpfcnpj", "=", $this->cli_clientes_cpfcnpj));
		}
		if(strlen($this->cli_clientes_inscricaoestadual)){
			$criterio->add(new DBFiltro("cli_clientes.inscricaoestadual", "=", $this->cli_clientes_inscricaoestadual));
		}
		if(strlen($this->cli_clientes_pessoafisica)){
			$criterio->add(new DBFiltro("cli_clientes.pessoafisica", "=", $this->cli_clientes_pessoafisica));
		}
		if(strlen($this->cli_clientes_razaosocial)){
			$criterio->add(new DBFiltro("cli_clientes.razaosocial", "=", $this->cli_clientes_razaosocial));
		}
		if(strlen($this->cli_clientes_datahoracadastroInicio) AND strlen($this->cli_clientes_datahoracadastroFinal)){
			$criterio->add(new DBFiltro("cli_clientes.datahoracadastro", ">=", $this->cli_clientes_datahoracadastroInicio));
			$criterio->add(new DBFiltro("cli_clientes.datahoracadastro", "<=", $this->cli_clientes_datahoracadastroFinal));
		}
		if(strlen($this->cli_clientes_rg)){
			$criterio->add(new DBFiltro("cli_clientes.rg", "=", $this->cli_clientes_rg));
		}
		if(strlen($this->cli_clientes_datanascimento)){
			$criterio->add(new DBFiltro("cli_clientes.datanascimento", "=", $this->cli_clientes_datanascimento));
		}
		if(strlen($this->cli_clientes_nomemae)){
			$criterio->add(new DBFiltro("cli_clientes.nomemae", "=", $this->cli_clientes_nomemae));
		}
		if(strlen($this->cli_clientes_nomepai)){
			$criterio->add(new DBFiltro("cli_clientes.nomepai", "=", $this->cli_clientes_nomepai));
		}
		if(strlen($this->cli_clientes_codusuarioresponsavel)){
			$criterio->add(new DBFiltro("cli_clientes.codusuarioresponsavel", "=", $this->cli_clientes_codusuarioresponsavel));
		}
		if(strlen($this->cli_clientes_obs)){
			$criterio->add(new DBFiltro("cli_clientes.obs", "=", $this->cli_clientes_obs));
		}
		if(strlen($this->cli_clientes_datacontrato)){
			$criterio->add(new DBFiltro("cli_clientes.datacontrato", "=", $this->cli_clientes_datacontrato));
		}
		if(strlen($this->cli_clientes_dataativacao)){
			$criterio->add(new DBFiltro("cli_clientes.dataativacao", "=", $this->cli_clientes_dataativacao));
		}
		if(strlen($this->cli_clientes_datacabeamento)){
			$criterio->add(new DBFiltro("cli_clientes.datacabeamento", "=", $this->cli_clientes_datacabeamento));
		}
		if(strlen($this->cli_clientes_situacao)){
			$criterio->add(new DBFiltro("cli_clientes.situacao", "=", $this->cli_clientes_situacao));
		}
		if(strlen($this->cli_clientes_codsituacaogrupo)){
			$criterio->add(new DBFiltro("cli_clientes.codsituacaogrupo", "=", $this->cli_clientes_codsituacaogrupo));
		}
		if(strlen($this->cli_clientes_contato)){
			$criterio->add(new DBFiltro("cli_clientes.contato", "=", $this->cli_clientes_contato));
		}
		if(strlen($this->cli_clientes_centralassinantestatus)){
			$criterio->add(new DBFiltro("cli_clientes.centralassinantestatus", "=", $this->cli_clientes_centralassinantestatus));
		}
		if(strlen($this->cli_clientes_inscricaomunicipal)){
			$criterio->add(new DBFiltro("cli_clientes.inscricaomunicipal", "=", $this->cli_clientes_inscricaomunicipal));
		}
		if(strlen($this->cli_clientes_centralassinantelogin)){
			$criterio->add(new DBFiltro("cli_clientes.centralassinantelogin", "=", $this->cli_clientes_centralassinantelogin));
		}
		if(strlen($this->cli_clientes_centralassinantesenha)){
			$criterio->add(new DBFiltro("cli_clientes.centralassinantesenha", "=", $this->cli_clientes_centralassinantesenha));
		}
		if(strlen($this->cli_clientes_informacaocontabil)){
			$criterio->add(new DBFiltro("cli_clientes.informacaocontabil", "=", $this->cli_clientes_informacaocontabil));
		}
		if(strlen($this->cli_clientes_logarapenasusuariocentralassinante)){
			$criterio->add(new DBFiltro("cli_clientes.logarapenasusuariocentralassinante", "=", $this->cli_clientes_logarapenasusuariocentralassinante));
		}
		if(strlen($this->cli_clientes_nomefantasia)){
			$criterio->add(new DBFiltro("cli_clientes.nomefantasia", "=", $this->cli_clientes_nomefantasia));
		}
		if(strlen($this->cli_clientes_profissao)){
			$criterio->add(new DBFiltro("cli_clientes.profissao", "=", $this->cli_clientes_profissao));
		}
		if(strlen($this->cli_clientes_estadocivil)){
			$criterio->add(new DBFiltro("cli_clientes.estadocivil", "=", $this->cli_clientes_estadocivil));
		}
		if(strlen($this->cli_clientes_codcidadenaturalidade)){
			$criterio->add(new DBFiltro("cli_clientes.codcidadenaturalidade", "=", $this->cli_clientes_codcidadenaturalidade));
		}
		if(strlen($this->cli_clientes_codpaisnacionalidade)){
			$criterio->add(new DBFiltro("cli_clientes.codpaisnacionalidade", "=", $this->cli_clientes_codpaisnacionalidade));
		}
		if(strlen($this->cli_clientes_bloquearautomaticamenteseinadimplente)){
			$criterio->add(new DBFiltro("cli_clientes.bloquearautomaticamenteseinadimplente", "=", $this->cli_clientes_bloquearautomaticamenteseinadimplente));
		}
		if(strlen($this->cli_clientes_codusuariocadastro)){
			$criterio->add(new DBFiltro("cli_clientes.codusuariocadastro", "=", $this->cli_clientes_codusuariocadastro));
		}
		if(strlen($this->cli_clientes_dataentregacontrato)){
			$criterio->add(new DBFiltro("cli_clientes.dataentregacontrato", "=", $this->cli_clientes_dataentregacontrato));
		}
		if(strlen($this->cli_clientes_pessoaspodemsolicitarsuportes)){
			$criterio->add(new DBFiltro("cli_clientes.pessoaspodemsolicitarsuportes", "=", $this->cli_clientes_pessoaspodemsolicitarsuportes));
		}
		if(strlen($this->cli_clientes_rgorgaoemissor)){
			$criterio->add(new DBFiltro("cli_clientes.rgorgaoemissor", "=", $this->cli_clientes_rgorgaoemissor));
		}
		if(strlen($this->cli_clientes_codrevenda)){
			$criterio->add(new DBFiltro("cli_clientes.codrevenda", "=", $this->cli_clientes_codrevenda));
		}
		if(strlen($this->cli_clientes_dataultimaatualizacaodadoscadastrais)){
			$criterio->add(new DBFiltro("cli_clientes.dataultimaatualizacaodadoscadastrais", "=", $this->cli_clientes_dataultimaatualizacaodadoscadastrais));
		}
		if(strlen($this->cli_clientes_proprietario)){
			$criterio->add(new DBFiltro("cli_clientes.proprietario", "=", $this->cli_clientes_proprietario));
		}
		if(strlen($this->cli_clientes_proprietariocpf)){
			$criterio->add(new DBFiltro("cli_clientes.proprietariocpf", "=", $this->cli_clientes_proprietariocpf));
		}
		if(strlen($this->cli_clientes_spc)){
			$criterio->add(new DBFiltro("cli_clientes.spc", "=", $this->cli_clientes_spc));
		}
		if(strlen($this->cli_clientes_codramoatividade)){
			$criterio->add(new DBFiltro("cli_clientes.codramoatividade", "=", $this->cli_clientes_codramoatividade));
		}
		if(strlen($this->cli_clientes_codIntegradorERP)){
			$criterio->add(new DBFiltro("cli_clientes.codIntegradorERP", "=", $this->cli_clientes_codIntegradorERP));
		}
		if(strlen($this->cli_clientes_observacaoSerasa)){
			$criterio->add(new DBFiltro("cli_clientes.observacaoSerasa", "=", $this->cli_clientes_observacaoSerasa));
		}
		if(strlen($this->cli_clientes_codholding)){
			$criterio->add(new DBFiltro("cli_clientes.codholding", "=", $this->cli_clientes_codholding));
		}
		if(strlen($this->cli_clientes_autonomo)){
			$criterio->add(new DBFiltro("cli_clientes.autonomo", "=", $this->cli_clientes_autonomo));
		}
		if(strlen($this->cli_enderecos_codendereco)){
			$criterio->add(new DBFiltro("cli_enderecos.codendereco", "=", $this->cli_enderecos_codendereco));
		}
		if(strlen($this->cli_enderecos_cli_clientes_codcliente)){
			$criterio->add(new DBFiltro("cli_enderecos.cli_clientes_codcliente", "=", $this->cli_enderecos_cli_clientes_codcliente));
		}
		if(strlen($this->cli_enderecos_sis_cidades_sis_estados_codestado)){
			$criterio->add(new DBFiltro("cli_enderecos.sis_cidades_sis_estados_codestado", "=", $this->cli_enderecos_sis_cidades_sis_estados_codestado));
		}
		if(strlen($this->cli_enderecos_sis_cidades_codcidade)){
			$criterio->add(new DBFiltro("cli_enderecos.sis_cidades_codcidade", "=", $this->cli_enderecos_sis_cidades_codcidade));
		}
		if(strlen($this->cli_enderecos_bairro)){
			$criterio->add(new DBFiltro("cli_enderecos.bairro", "=", $this->cli_enderecos_bairro));
		}
		if(strlen($this->cli_enderecos_rua)){
			$criterio->add(new DBFiltro("cli_enderecos.rua", "=", $this->cli_enderecos_rua));
		}
		if(strlen($this->cli_enderecos_cep)){
			$criterio->add(new DBFiltro("cli_enderecos.cep", "=", $this->cli_enderecos_cep));
		}
		if(strlen($this->cli_enderecos_complemento)){
			$criterio->add(new DBFiltro("cli_enderecos.complemento", "=", $this->cli_enderecos_complemento));
		}
		if(strlen($this->cli_enderecos_caixapostal)){
			$criterio->add(new DBFiltro("cli_enderecos.caixapostal", "=", $this->cli_enderecos_caixapostal));
		}
		if(strlen($this->cli_enderecos_codpredio)){
			$criterio->add(new DBFiltro("cli_enderecos.codpredio", "=", $this->cli_enderecos_codpredio));
		}
		if(strlen($this->cli_enderecos_ssid)){
			$criterio->add(new DBFiltro("cli_enderecos.ssid", "=", $this->cli_enderecos_ssid));
		}
		if(strlen($this->cli_enderecos_codcep)){
			$criterio->add(new DBFiltro("cli_enderecos.codcep", "=", $this->cli_enderecos_codcep));
		}
		if(strlen($this->cli_enderecos_obs)){
			$criterio->add(new DBFiltro("cli_enderecos.obs", "=", $this->cli_enderecos_obs));
		}
		if(strlen($this->cli_enderecos_removido)){
			$criterio->add(new DBFiltro("cli_enderecos.removido", "=", $this->cli_enderecos_removido));
		}
		if(strlen($this->cli_enderecos_latitude)){
			$criterio->add(new DBFiltro("cli_enderecos.latitude", "=", $this->cli_enderecos_latitude));
		}
		if(strlen($this->cli_enderecos_longitude)){
			$criterio->add(new DBFiltro("cli_enderecos.longitude", "=", $this->cli_enderecos_longitude));
		}
		if(strlen($this->cli_enderecos_tipoendereco)){
			$criterio->add(new DBFiltro("cli_enderecos.tipoendereco", "=", $this->cli_enderecos_tipoendereco));
		}
		if(strlen($this->fin_cobrancascliente_codcobrancascliente)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.codcobrancascliente", "=", $this->fin_cobrancascliente_codcobrancascliente));
		}
		if(strlen($this->fin_cobrancascliente_cli_clientes_codcliente)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.cli_clientes_codcliente", "=", $this->fin_cobrancascliente_cli_clientes_codcliente));
		}
		if(strlen($this->fin_cobrancascliente_fin_tiposcobranca_codtiposcobranca)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.fin_tiposcobranca_codtiposcobranca", "=", $this->fin_cobrancascliente_fin_tiposcobranca_codtiposcobranca));
		}
		if(strlen($this->fin_cobrancascliente_cli_enderecos_cli_clientes_codcliente)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.cli_enderecos_cli_clientes_codcliente", "=", $this->fin_cobrancascliente_cli_enderecos_cli_clientes_codcliente));
		}
		if(strlen($this->fin_cobrancascliente_cli_enderecos_codendereco)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.cli_enderecos_codendereco", "=", $this->fin_cobrancascliente_cli_enderecos_codendereco));
		}
		if(strlen($this->fin_cobrancascliente_codendereco_nf)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.codendereco_nf", "=", $this->fin_cobrancascliente_codendereco_nf));
		}
		if(strlen($this->fin_cobrancascliente_diacobranca)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.diacobranca", "=", $this->fin_cobrancascliente_diacobranca));
		}
		if(strlen($this->fin_cobrancascliente_descricao)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.descricao", "=", $this->fin_cobrancascliente_descricao));
		}
		if(strlen($this->fin_cobrancascliente_codcontacorrente)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.codcontacorrente", "=", $this->fin_cobrancascliente_codcontacorrente));
		}
		if(strlen($this->fin_cobrancascliente_codcartaocredito)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.codcartaocredito", "=", $this->fin_cobrancascliente_codcartaocredito));
		}
		if(strlen($this->fin_cobrancascliente_codtiponotafiscal)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.codtiponotafiscal", "=", $this->fin_cobrancascliente_codtiponotafiscal));
		}
		if(strlen($this->fin_cobrancascliente_impostos)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.impostos", "=", $this->fin_cobrancascliente_impostos));
		}
		if(strlen($this->fin_cobrancascliente_codgrupoimposto)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.codgrupoimposto", "=", $this->fin_cobrancascliente_codgrupoimposto));
		}
		if(strlen($this->fin_cobrancascliente_datacobranca)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.datacobranca", "=", $this->fin_cobrancascliente_datacobranca));
		}
		if(strlen($this->fin_cobrancascliente_modo)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.modo", "=", $this->fin_cobrancascliente_modo));
		}
		if(strlen($this->fin_cobrancascliente_nrdiastolerancia)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.nrdiastolerancia", "=", $this->fin_cobrancascliente_nrdiastolerancia));
		}
		if(strlen($this->fin_cobrancascliente_cfop)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.cfop", "=", $this->fin_cobrancascliente_cfop));
		}
		if(strlen($this->fin_cobrancascliente_nfobsimpressao)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.nfobsimpressao", "=", $this->fin_cobrancascliente_nfobsimpressao));
		}
		if(strlen($this->fin_cobrancascliente_enviaravisogeracaocobranca)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.enviaravisogeracaocobranca", "=", $this->fin_cobrancascliente_enviaravisogeracaocobranca));
		}
		if(strlen($this->fin_cobrancascliente_comportamentosespeciais)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.comportamentosespeciais", "=", $this->fin_cobrancascliente_comportamentosespeciais));
		}
		if(strlen($this->fin_cobrancascliente_removida)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.removida", "=", $this->fin_cobrancascliente_removida));
		}
		if(strlen($this->fin_cobrancascliente_emailnfe)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.emailnfe", "=", $this->fin_cobrancascliente_emailnfe));
		}
		if(strlen($this->fin_cobrancascliente_parceladecodclientecobrancaespecial)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.parceladecodclientecobrancaespecial", "=", $this->fin_cobrancascliente_parceladecodclientecobrancaespecial));
		}
		if(strlen($this->fin_cobrancascliente_valorvenda)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.valorvenda", "=", $this->fin_cobrancascliente_valorvenda));
		}
		if(strlen($this->fin_cobrancascliente_venda_codtransportadora)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.venda_codtransportadora", "=", $this->fin_cobrancascliente_venda_codtransportadora));
		}
		if(strlen($this->fin_cobrancascliente_venda_opcaofrete)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.venda_opcaofrete", "=", $this->fin_cobrancascliente_venda_opcaofrete));
		}
		if(strlen($this->fin_cobrancascliente_venda_valorfrete)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.venda_valorfrete", "=", $this->fin_cobrancascliente_venda_valorfrete));
		}
		if(strlen($this->fin_cobrancascliente_codenderecodestinatario_nf)){
			$criterio->add(new DBFiltro("fin_cobrancascliente.codenderecodestinatario_nf", "=", $this->fin_cobrancascliente_codenderecodestinatario_nf));
		}
		if(strlen($this->fin_cobrancasclienteplanos_codcobrancasclienteplanos)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.codcobrancasclienteplanos", "=", $this->fin_cobrancasclienteplanos_codcobrancasclienteplanos));
		}
		if(strlen($this->fin_cobrancasclienteplanos_plan_planos_codplano)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.plan_planos_codplano", "=", $this->fin_cobrancasclienteplanos_plan_planos_codplano));
		}
		if(strlen($this->fin_cobrancasclienteplanos_fin_cobrancascliente_codcobrancascliente)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.fin_cobrancascliente_codcobrancascliente", "=", $this->fin_cobrancasclienteplanos_fin_cobrancascliente_codcobrancascliente));
		}
		if(strlen($this->fin_cobrancasclienteplanos_precocliente)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.precocliente", "=", $this->fin_cobrancasclienteplanos_precocliente));
		}
		if(strlen($this->fin_cobrancasclienteplanos_cortesia)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.cortesia", "=", $this->fin_cobrancasclienteplanos_cortesia));
		}
		if(strlen($this->fin_cobrancasclienteplanos_datacadastroInicio) AND strlen($this->fin_cobrancasclienteplanos_datacadastroFinal)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.datacadastro", ">=", $this->fin_cobrancasclienteplanos_datacadastroInicio));
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.datacadastro", "<=", $this->fin_cobrancasclienteplanos_datacadastroFinal));
		}
		if(strlen($this->fin_cobrancasclienteplanos_dataativacaoInicio) AND strlen($this->fin_cobrancasclienteplanos_dataativacaoFinal)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.dataativacao", ">=", $this->fin_cobrancasclienteplanos_dataativacaoInicio));
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.dataativacao", "<=", $this->fin_cobrancasclienteplanos_dataativacaoFinal));
		}
		if(strlen($this->fin_cobrancasclienteplanos_datadesativacaoInicio) AND strlen($this->fin_cobrancasclienteplanos_datadesativacaoFinal)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.datadesativacao", ">=", $this->fin_cobrancasclienteplanos_datadesativacaoInicio));
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.datadesativacao", "<=", $this->fin_cobrancasclienteplanos_datadesativacaoFinal));
		}
		if(strlen($this->fin_cobrancasclienteplanos_codrevenda)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.codrevenda", "=", $this->fin_cobrancasclienteplanos_codrevenda));
		}
		if(strlen($this->fin_cobrancasclienteplanos_diabilhetageminicial)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.diabilhetageminicial", "=", $this->fin_cobrancasclienteplanos_diabilhetageminicial));
		}
		if(strlen($this->fin_cobrancasclienteplanos_diabilhetagemfinal)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.diabilhetagemfinal", "=", $this->fin_cobrancasclienteplanos_diabilhetagemfinal));
		}
		if(strlen($this->fin_cobrancasclienteplanos_quantidade)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.quantidade", "=", $this->fin_cobrancasclienteplanos_quantidade));
		}
		if(strlen($this->fin_cobrancasclienteplanos_obs)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.obs", "=", $this->fin_cobrancasclienteplanos_obs));
		}
		if(strlen($this->fin_cobrancasclienteplanos_mescobranca)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.mescobranca", "=", $this->fin_cobrancasclienteplanos_mescobranca));
		}
		if(strlen($this->fin_cobrancasclienteplanos_anocobranca)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.anocobranca", "=", $this->fin_cobrancasclienteplanos_anocobranca));
		}
		if(strlen($this->fin_cobrancasclienteplanos_datadesativado)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.datadesativado", "=", $this->fin_cobrancasclienteplanos_datadesativado));
		}
		if(strlen($this->fin_cobrancasclienteplanos_periodocliente)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.periodocliente", "=", $this->fin_cobrancasclienteplanos_periodocliente));
		}
		if(strlen($this->fin_cobrancasclienteplanos_codigosagentesdominioemail)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.codigosagentesdominioemail", "=", $this->fin_cobrancasclienteplanos_codigosagentesdominioemail));
		}
		if(strlen($this->fin_cobrancasclienteplanos_descricaoboleto)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.descricaoboleto", "=", $this->fin_cobrancasclienteplanos_descricaoboleto));
		}
		if(strlen($this->fin_cobrancasclienteplanos_descricaonotafiscal)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.descricaonotafiscal", "=", $this->fin_cobrancasclienteplanos_descricaonotafiscal));
		}
		if(strlen($this->fin_cobrancasclienteplanos_codplanoanterior)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.codplanoanterior", "=", $this->fin_cobrancasclienteplanos_codplanoanterior));
		}
		if(strlen($this->fin_cobrancasclienteplanos_codendereco)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.codendereco", "=", $this->fin_cobrancasclienteplanos_codendereco));
		}
		if(strlen($this->fin_cobrancasclienteplanos_codDesignador)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.codDesignador", "=", $this->fin_cobrancasclienteplanos_codDesignador));
		}
		if(strlen($this->fin_cobrancasclienteplanos_PK_codCobrancaClientePlano)){
			$criterio->add(new DBFiltro("fin_cobrancasclienteplanos.PK_codCobrancaClientePlano", "=", $this->fin_cobrancasclienteplanos_PK_codCobrancaClientePlano));
		}
		if(strlen($this->fin_tiposcobranca_codtiposcobranca)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.codtiposcobranca", "=", $this->fin_tiposcobranca_codtiposcobranca));
		}
		if(strlen($this->fin_tiposcobranca_fin_contascorrentes_codcontacorrente)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.fin_contascorrentes_codcontacorrente", "=", $this->fin_tiposcobranca_fin_contascorrentes_codcontacorrente));
		}
		if(strlen($this->fin_tiposcobranca_fin_gruposcobranca_codgrupocobranca)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.fin_gruposcobranca_codgrupocobranca", "=", $this->fin_tiposcobranca_fin_gruposcobranca_codgrupocobranca));
		}
		if(strlen($this->fin_tiposcobranca_descricao)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.descricao", "=", $this->fin_tiposcobranca_descricao));
		}
		if(strlen($this->fin_tiposcobranca_diacobranca)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.diacobranca", "=", $this->fin_tiposcobranca_diacobranca));
		}
		if(strlen($this->fin_tiposcobranca_formapagamento)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.formapagamento", "=", $this->fin_tiposcobranca_formapagamento));
		}
		if(strlen($this->fin_tiposcobranca_possuinumsequencial)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.possuinumsequencial", "=", $this->fin_tiposcobranca_possuinumsequencial));
		}
		if(strlen($this->fin_tiposcobranca_scriptnninicializacao)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnninicializacao", "=", $this->fin_tiposcobranca_scriptnninicializacao));
		}
		if(strlen($this->fin_tiposcobranca_scriptnngeracao)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnngeracao", "=", $this->fin_tiposcobranca_scriptnngeracao));
		}
		if(strlen($this->fin_tiposcobranca_scriptnnfinalizacao)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnnfinalizacao", "=", $this->fin_tiposcobranca_scriptnnfinalizacao));
		}
		if(strlen($this->fin_tiposcobranca_scriptnndigitoverificador)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnndigitoverificador", "=", $this->fin_tiposcobranca_scriptnndigitoverificador));
		}
		if(strlen($this->fin_tiposcobranca_scriptsninicializacao)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptsninicializacao", "=", $this->fin_tiposcobranca_scriptsninicializacao));
		}
		if(strlen($this->fin_tiposcobranca_scriptsngeracao)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptsngeracao", "=", $this->fin_tiposcobranca_scriptsngeracao));
		}
		if(strlen($this->fin_tiposcobranca_scriptsnfinalizacao)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptsnfinalizacao", "=", $this->fin_tiposcobranca_scriptsnfinalizacao));
		}
		if(strlen($this->fin_tiposcobranca_scriptnomearquivocobranca)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnomearquivocobranca", "=", $this->fin_tiposcobranca_scriptnomearquivocobranca));
		}
		if(strlen($this->fin_tiposcobranca_localarquivobol)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.localarquivobol", "=", $this->fin_tiposcobranca_localarquivobol));
		}
		if(strlen($this->fin_tiposcobranca_caminhoarquivocobranca)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.caminhoarquivocobranca", "=", $this->fin_tiposcobranca_caminhoarquivocobranca));
		}
		if(strlen($this->fin_tiposcobranca_caminhorelativoarquivocobranca)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.caminhorelativoarquivocobranca", "=", $this->fin_tiposcobranca_caminhorelativoarquivocobranca));
		}
		if(strlen($this->fin_tiposcobranca_diabilhetageminicial)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.diabilhetageminicial", "=", $this->fin_tiposcobranca_diabilhetageminicial));
		}
		if(strlen($this->fin_tiposcobranca_diabilhetagemfinal)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.diabilhetagemfinal", "=", $this->fin_tiposcobranca_diabilhetagemfinal));
		}
		if(strlen($this->fin_tiposcobranca_localarquivoqui)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.localarquivoqui", "=", $this->fin_tiposcobranca_localarquivoqui));
		}
		if(strlen($this->fin_tiposcobranca_scriptnnretorno)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnnretorno", "=", $this->fin_tiposcobranca_scriptnnretorno));
		}
		if(strlen($this->fin_tiposcobranca_scriptsnretorno)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptsnretorno", "=", $this->fin_tiposcobranca_scriptsnretorno));
		}
		if(strlen($this->fin_tiposcobranca_localarquivoboletoimpresso)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.localarquivoboletoimpresso", "=", $this->fin_tiposcobranca_localarquivoboletoimpresso));
		}
		if(strlen($this->fin_tiposcobranca_gruponsa)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.gruponsa", "=", $this->fin_tiposcobranca_gruponsa));
		}
		if(strlen($this->fin_tiposcobranca_tipopessoa)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.tipopessoa", "=", $this->fin_tiposcobranca_tipopessoa));
		}
		if(strlen($this->fin_tiposcobranca_numerocobrancaspagina)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.numerocobrancaspagina", "=", $this->fin_tiposcobranca_numerocobrancaspagina));
		}
		if(strlen($this->fin_tiposcobranca_localarquivobolbaixacobrancaregistrada)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.localarquivobolbaixacobrancaregistrada", "=", $this->fin_tiposcobranca_localarquivobolbaixacobrancaregistrada));
		}
		if(strlen($this->fin_tiposcobranca_scriptnomearquivobaixacobrancaregistrada)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnomearquivobaixacobrancaregistrada", "=", $this->fin_tiposcobranca_scriptnomearquivobaixacobrancaregistrada));
		}
		if(strlen($this->fin_tiposcobranca_caminhoarquivobaixacobrancaregistrada)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.caminhoarquivobaixacobrancaregistrada", "=", $this->fin_tiposcobranca_caminhoarquivobaixacobrancaregistrada));
		}
		if(strlen($this->fin_tiposcobranca_caminhorelativoarquivobaixacobrancaregistrada)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.caminhorelativoarquivobaixacobrancaregistrada", "=", $this->fin_tiposcobranca_caminhorelativoarquivobaixacobrancaregistrada));
		}
		if(strlen($this->fin_tiposcobranca_localarquivoboletoimpressohtml)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.localarquivoboletoimpressohtml", "=", $this->fin_tiposcobranca_localarquivoboletoimpressohtml));
		}
		if(strlen($this->fin_tiposcobranca_scriptnnretornocodcobranca)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.scriptnnretornocodcobranca", "=", $this->fin_tiposcobranca_scriptnnretornocodcobranca));
		}
		if(strlen($this->fin_tiposcobranca_planosquesempredevemsercobrados)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.planosquesempredevemsercobrados", "=", $this->fin_tiposcobranca_planosquesempredevemsercobrados));
		}
		if(strlen($this->fin_tiposcobranca_tipobilhetagem)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.tipobilhetagem", "=", $this->fin_tiposcobranca_tipobilhetagem));
		}
		if(strlen($this->fin_tiposcobranca_status)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.status", "=", $this->fin_tiposcobranca_status));
		}
		if(strlen($this->fin_tiposcobranca_VOIP_CDR_DiaBilhetagemInicial)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.VOIP_CDR_DiaBilhetagemInicial", "=", $this->fin_tiposcobranca_VOIP_CDR_DiaBilhetagemInicial));
		}
		if(strlen($this->fin_tiposcobranca_VOIP_CDR_DiaBilhetagemFinal)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.VOIP_CDR_DiaBilhetagemFinal", "=", $this->fin_tiposcobranca_VOIP_CDR_DiaBilhetagemFinal));
		}
		if(strlen($this->fin_tiposcobranca_VOIP_CDR_TipoBilhetagem)){
			$criterio->add(new DBFiltro("fin_tiposcobranca.VOIP_CDR_TipoBilhetagem", "=", $this->fin_tiposcobranca_VOIP_CDR_TipoBilhetagem));
		}
		if(strlen($this->plan_planos_codplano)){
			$criterio->add(new DBFiltro("plan_planos.codplano", "=", $this->plan_planos_codplano));
		}
		if(strlen($this->plan_planos_nome)){
			$criterio->add(new DBFiltro("plan_planos.nome", "=", $this->plan_planos_nome));
		}
		if(strlen($this->plan_planos_periodo)){
			$criterio->add(new DBFiltro("plan_planos.periodo", "=", $this->plan_planos_periodo));
		}
		if(strlen($this->plan_planos_datacriacao)){
			$criterio->add(new DBFiltro("plan_planos.datacriacao", "=", $this->plan_planos_datacriacao));
		}
		if(strlen($this->plan_planos_descricao)){
			$criterio->add(new DBFiltro("plan_planos.descricao", "=", $this->plan_planos_descricao));
		}
		if(strlen($this->plan_planos_periodoexpiracao)){
			$criterio->add(new DBFiltro("plan_planos.periodoexpiracao", "=", $this->plan_planos_periodoexpiracao));
		}
		if(strlen($this->plan_planos_planoposexpiracao)){
			$criterio->add(new DBFiltro("plan_planos.planoposexpiracao", "=", $this->plan_planos_planoposexpiracao));
		}
		if(strlen($this->plan_planos_precoforcado)){
			$criterio->add(new DBFiltro("plan_planos.precoforcado", "=", $this->plan_planos_precoforcado));
		}
		if(strlen($this->plan_planos_codgrupoplano)){
			$criterio->add(new DBFiltro("plan_planos.codgrupoplano", "=", $this->plan_planos_codgrupoplano));
		}
		if(strlen($this->plan_planos_diabilhetageminicial)){
			$criterio->add(new DBFiltro("plan_planos.diabilhetageminicial", "=", $this->plan_planos_diabilhetageminicial));
		}
		if(strlen($this->plan_planos_diabilhetagemfinal)){
			$criterio->add(new DBFiltro("plan_planos.diabilhetagemfinal", "=", $this->plan_planos_diabilhetagemfinal));
		}
		if(strlen($this->plan_planos_cobrarprorataadicionaldiaativacaomaiorigualque)){
			$criterio->add(new DBFiltro("plan_planos.cobrarprorataadicionaldiaativacaomaiorigualque", "=", $this->plan_planos_cobrarprorataadicionaldiaativacaomaiorigualque));
		}
		if(strlen($this->plan_planos_cobrarprorataadicionaldiaativacaomenorigualque)){
			$criterio->add(new DBFiltro("plan_planos.cobrarprorataadicionaldiaativacaomenorigualque", "=", $this->plan_planos_cobrarprorataadicionaldiaativacaomenorigualque));
		}
		if(strlen($this->plan_planos_nrdiasadicionarcalculobilhetagem)){
			$criterio->add(new DBFiltro("plan_planos.nrdiasadicionarcalculobilhetagem", "=", $this->plan_planos_nrdiasadicionarcalculobilhetagem));
		}
		if(strlen($this->plan_planos_aparecernf)){
			$criterio->add(new DBFiltro("plan_planos.aparecernf", "=", $this->plan_planos_aparecernf));
		}
		if(strlen($this->plan_planos_adicional)){
			$criterio->add(new DBFiltro("plan_planos.adicional", "=", $this->plan_planos_adicional));
		}
		if(strlen($this->plan_planos_nrdiasgratis)){
			$criterio->add(new DBFiltro("plan_planos.nrdiasgratis", "=", $this->plan_planos_nrdiasgratis));
		}
		if(strlen($this->plan_planos_status)){
			$criterio->add(new DBFiltro("plan_planos.status", "=", $this->plan_planos_status));
		}
		if(strlen($this->plan_planos_prepago)){
			$criterio->add(new DBFiltro("plan_planos.prepago", "=", $this->plan_planos_prepago));
		}
		if(strlen($this->plan_planos_emailespacodiscototal)){
			$criterio->add(new DBFiltro("plan_planos.emailespacodiscototal", "=", $this->plan_planos_emailespacodiscototal));
		}
		if(strlen($this->plan_planos_obs)){
			$criterio->add(new DBFiltro("plan_planos.obs", "=", $this->plan_planos_obs));
		}
		if(strlen($this->plan_planos_parametrosadicionaisprovedor)){
			$criterio->add(new DBFiltro("plan_planos.parametrosadicionaisprovedor", "=", $this->plan_planos_parametrosadicionaisprovedor));
		}
		if(strlen($this->plan_planos_VOIP)){
			$criterio->add(new DBFiltro("plan_planos.VOIP", "=", $this->plan_planos_VOIP));
		}
		if(strlen($this->plan_planos_codservicoprefeitura)){
			$criterio->add(new DBFiltro("plan_planos.codservicoprefeitura", "=", $this->plan_planos_codservicoprefeitura));
		}
		if(strlen($this->plan_planos_disponivelParaTipoPessoa)){
			$criterio->add(new DBFiltro("plan_planos.disponivelParaTipoPessoa", "=", $this->plan_planos_disponivelParaTipoPessoa));
		}
		if(strlen($this->plan_planos_VOIP_quandoCobrarCDR)){
			$criterio->add(new DBFiltro("plan_planos.VOIP_quandoCobrarCDR", "=", $this->plan_planos_VOIP_quandoCobrarCDR));
		}
		if(strlen($this->plan_grupos_codgrupoplano)){
			$criterio->add(new DBFiltro("plan_grupos.codgrupoplano", "=", $this->plan_grupos_codgrupoplano));
		}
		if(strlen($this->plan_grupos_descricao)){
			$criterio->add(new DBFiltro("plan_grupos.descricao", "=", $this->plan_grupos_descricao));
		}
		if(strlen($this->sis_departamentos_codigo)){
			$criterio->add(new DBFiltro("sis_departamentos.codigo", "=", $this->sis_departamentos_codigo));
		}
		$sql = new DBSqlSelecione;
		$sql->setEntidade("cli_enderecos, fin_cobrancascliente, fin_cobrancasclienteplanos, fin_tiposcobranca, plan_planos, sis_cidades, plan_grupos, cli_clientes LEFT JOIN sis_usuarios ON sis_usuarios.codusuario = cli_clientes.codusuarioresponsavel LEFT JOIN sis_usuarios_departamentos ON sis_usuarios_departamentos.codusuario = sis_usuarios.codusuario LEFT JOIN sis_departamentos ON sis_departamentos.codigo = sis_usuarios_departamentos.coddepartamento");
		$sql->addColuna('cli_clientes.nome AS "cli_clientes_nome"');
		$sql->addColuna('cli_clientes.codusuarioresponsavel AS "cli_clientes_codusuarioresponsavel"');
		$sql->addColuna('cli_clientes.situacao AS "cli_clientes_situacao"');
		$sql->addColuna("CASE cli_clientes.pessoafisica WHEN 1 THEN 'PF' ELSE 'PJ' END AS 'cli_clientes_pessoafisica'");
		$sql->addColuna('cli_enderecos.sis_cidades_codcidade AS "cli_enderecos_sis_cidades_codcidade"');
		$sql->addColuna('plan_planos.descricao AS "plan_planos_descricao"');
		$sql->addColuna('plan_grupos.descricao AS "plan_grupos_descricao"');
		$sql->addColuna("CASE cli_clientes.situacao WHEN 0 THEN 'Ativo' WHEN 1 THEN 'Arquivado' WHEN 2 THEN 'Bloqueado'  WHEN 3 THEN 'Pendente' WHEN 4 THEN 'Manutencao' WHEN 5 THEN 'Bloqueado para Protesto' WHEN 6 THEN 'Viabilidade Negada' WHEN 7 THEN 'Prospecção' END AS 'cli_clientes.situacao'");
		$sql->addColuna('cli_clientes.datahoracadastro AS "cli_clientes_datahoracadastro"');
		$sql->addColuna('fin_cobrancasclienteplanos.datacadastro AS "fin_cobrancasclienteplanos_datacadastro"');
		$sql->addColuna('fin_cobrancasclienteplanos.dataativacao AS "fin_cobrancasclienteplanos_dataativacao"');
		$sql->addColuna('fin_cobrancasclienteplanos.datadesativacao AS "fin_cobrancasclienteplanos_datadesativacao"');
		$sql->addColuna("REPLACE(REPLACE(FORMAT(IF(fin_cobrancasclienteplanos.precocliente > 0, fin_cobrancasclienteplanos.precocliente, plan_planos.precoforcado), 2), ',', ''), ',', '.') AS precofinal");
		$sql->addColuna("IF(sis_departamentos.codigo IS NULL,'',sis_departamentos.nome) AS sis_departamentos_codigo");
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
