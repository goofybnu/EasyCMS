<?php
Class SYSLoginDB extends SYSLogin {
	public function checar() {
		$sess = SYSSessao::instanciar();
		return $sess->existe('usuario');
	}

	public function logout() {
		session_start();
		//session_destroy();
		$oldURL = base64_encode($_SERVER['REQUEST_URI']);
		header('location: '.baseURL.'login/'.$oldURL);
	}

	public function login($login, $senha) {
		$sql = new DBSqlSelecione;
		$sql->setEntidade('erp.sis_usuarios');
		$sql->addColuna('id');
		$sql->addColuna('nome');
		$sql->addColuna('email');
		$sql->addColuna('login');
		$sql->addColuna('senha');
		$sql->addColuna('tipo');
		$sql->addColuna('cadastro');

		$criterio = new DBCriterio;
		$criterio->add(new DBFiltro('sis_usuarios.login', '=', $login));
		$criterio->add(new DBFiltro('sis_usuarios.senha', '=', $senha));
		$sql->setCriterio($criterio);

		try {
			$conexao = DBConexao::open();
			$resultado = $conexao->query($sql->getInstrucao());
			$dados = $resultado->fetch(PDO::FETCH_ASSOC);
			if($dados){
				$usuario = new SYSUsuario();
				$usuario->setId($dados['id']);
				$usuario->setNome($dados['nome']);
				$usuario->setEmail($dados['email']);
				$usuario->setLogin($dados['login']);
				$usuario->setSenha($dados['senha']);
				$usuario->setTipo($dados['tipo']);
				$usuario->setCadastro($dados['cadastro']);

				$sql2 = new DBSqlSelecione;
				$sql2->setEntidade('sis_usuarios su, sis_usuarios_grupos ug, sis_grupos_permissoes gp, sis_menu sm');
				$sql2->addColuna("sm.url AS 'permissao'");

				$criterio2 = new DBCriterio;
				$criterio2->add(new DBFiltro('su.login', '=', $login));
				$criterio2->add(new DBFiltro('su.senha', '=', $senha));
				$criterio2->add(new DBFiltro('su.ativo', '=', '1'));
				$criterio2->add(new DBFiltroLivre('ug.usuario = su.id'));
				$criterio2->add(new DBFiltroLivre('gp.grupo_id = ug.grupo'));
				$criterio2->add(new DBFiltroLivre('sm.id = gp.permissao'));
				$sql2->setCriterio($criterio2);
				$resultado2 = $conexao->query($sql2->getInstrucao());
				$temp_permissoes = $resultado2->fetchAll(PDO::FETCH_ASSOC);

				$sql3 = new DBSqlSelecione;
				$sql3->setEntidade('sis_usuarios su, sis_usuarios_permissoes up, sis_menu sm');
				$sql3->addColuna("sm.url AS 'permissao'");

				$criterio3 = new DBCriterio;
				$criterio3->add(new DBFiltro('su.login', '=', $login));
				$criterio3->add(new DBFiltro('su.senha', '=', $senha));
				$criterio3->add(new DBFiltro('su.ativo', '=', '1'));
				$criterio3->add(new DBFiltroLivre('up.usuario = su.id'));
				$criterio3->add(new DBFiltroLivre('sm.id = up.permissao'));
				$sql3->setCriterio($criterio3);

				$resultado3 = $conexao->query($sql3->getInstrucao());
				$temp_permissoes2 = $resultado3->fetchAll(PDO::FETCH_ASSOC);

				$permissoes = array();
				foreach($temp_permissoes as $perm){
					$permissoes[] = $perm['permissao'];
				}
				foreach($temp_permissoes2 as $perm){
					$permissoes[] = $perm['permissao'];
				}

				$usuario->setPermissoes($permissoes);
				$sess = SYSSessao::instanciar();
				$sess->set('usuario', $usuario);
				return (true);
			} else {
				return false;
			}
		} catch(PDOException $error) {
			if(debugEnabled) print_r($error->getMessage());
			return (false);
		}
	}

	public function retornar() {
		$sess = SYSSessao::instanciar();
		if ($this->checar()) {
			$usuario = $sess->get('usuario');
			return $usuario;
		} else {
			return false;
		}
	}
}
