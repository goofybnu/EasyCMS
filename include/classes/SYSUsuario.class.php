<?php
class SYSUsuario {
	private $id 		= null;
	private $nome 		= null;
	private $email 		= null;
	private $login 		= null;
	private $senha 		= null;
	public $tipo 		= null;
	private $cadastro 	= null;
	public $permissoes = null;

	public function getId() {
		return $this->id;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function getTipo() {
		return $this->tipo;
	}

	public function getCadastro() {
		return $this->cadastro;
	}

	public function getPermissoes(){
		return $this->permissoes;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setLogin($login) {
		$this->login = $login;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}

	public function setCadastro($cadastro) {
		$this->cadastro = $cadastro;
	}

	public function setPermissoes($permissoes){
		$this->permissoes = $permissoes;
	}
}