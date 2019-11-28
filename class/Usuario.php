<?php

	class Usuario {
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		//Início: Método Construtor, o qual chama os métodos set para atribuir valores as propriedades dessas classe
		public function __construct($login = "", $password = ""){
			$this->setDesLogin($login);
			$this->setDesSenha($password);
		}
		//Termino: Método Construtor, o qual chama os métodos set para atribuir valores as propriedades dessas classe

		//Início: Métodos gets
		public function getIdUsuario(){
			return $this->idusuario;
		}

		public function getDesLogin(){
			return $this->deslogin;
		}

		public function getDesSenha(){
			return $this->dessenha;
		}

		public function getDtCadastro(){
			return $this->dtcadastro;
		}
		//Termino: Métodos gets

		//Início: Métodos sets
		public function setIdUsuario($value){
			$this->idusuario = $value;
		}

		public function setDesLogin($value){
			$this->deslogin = $value;
		}

		public function setDesSenha($value){
			$this->dessenha = $value;
		}

		public function setDtCadastro($value){
			$this->dtcadastro = $value;
		}
		//Termino: Métodos sets
		
		//Início: Método que insere valores nos atributos dessa classe
		public function setData($data){
				$this->setIdUsuario($data['idusuario']);
				$this->setDesLogin($data['deslogin']);
				$this->setDesSenha($data['dessenha']);
				$this->setDtCadastro(new DateTime($data['dtcadastro']));			
		}
		//Termino: Método que insere valores nos atributos dessa classe

		//Início: Método para procurar um objeto na base de dados pelo seu 'id'
		public function loadById($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if (count($results) > 0){

				$this->setData($results[0]);

			}


		}
		//Termino: Método para procurar um objeto na base de dados pelo seu 'id'

		//Início: Método estático que lista todos os usuários/objetos/registros
		public static function getList(){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
		}
		//Termino: Método estático que lista todos os usuários/objetos/registro

		//Início: Método estático que lista usuários/objetos/registro buscando pelo login
		public static function search($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :DESLOGIN ORDER BY deslogin", array(
				':DESLOGIN'=>"%".$login."%"
			));
		}
		//Termino: Método estático que lista usuários/objetos/registro buscando pelo login

		//Início: Método Login, o qual verifica se um usuário existe exatamente com as informações passadas
		public function login($login, $password){
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :DESLOGIN AND dessenha = :DESSENHA", array(
				":DESLOGIN"=>$login,
				":DESSENHA"=>$password
			));

			if (count($results) > 0){

				$this->setData($results[0]);

			}else{

				throw new Exception("Usuário não encontrado. Login e/ou senha inválidos");

			}			
		}
		//Termino: Método Login, o qual verifica se um usuário existe exatamente com as informações passadas

		//Início: Método que insere um novo registro/usuario/objeto no banco por uma procedure no mysql
		public function insert(){
			$sql = new Sql();

			$results = $sql->select("CALL sp_usuarios_insert(:DESLOGIN, :DESSENHA)", array(
				':DESLOGIN'=>$this->getDesLogin(),
				':DESSENHA'=>$this->getDesSenha()
			));

			if (count($results) > 0){

				$this->setData($results[0]);
				
			}
		}
		//Termino: Método que insere um novo registro/usuario/objeto no banco por uma procedure no mysql

		//Início: Método Update, para atualizar os registros de um possível usuário
		public function update($login, $password){

			$this->setDesLogin($login);
			$this->setDesSenha($password);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET deslogin = :DESLOGIN, dessenha = :DESSENHA WHERE idusuario = :ID", array(
				':DESLOGIN'=>$this->getDesLogin(),
				':DESSENHA'=>$this->getDesSenha(),
				':ID'=>$this->getIdUsuario()
			));

		}
		//Termino: Método Update, para atualizar os registros de um possível usuário

		//Início: Método Delete, o qual irá deletar esse objeto da Base de Dados(BD)
		public function delete(){
			
			$sql = new Sql();

			$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$this->getIdUsuario()
			));

			$this->setIdUsuario(0);
			$this->setDesLogin("");
			$this->setDesSenha("");
			$this->setDtCadastro(new DateTime());
		}
		//Termino: Método Delete, o qual irá deletar esse objeto da Base de Dados(BD)

		//Início: Método mágico '__toString'
		public function __toString(){
			return json_encode(array(
				'idusuario'=>$this->getIdUsuario(),
				'deslogin'=>$this->getDesLogin(),
				'dessenha'=>$this->getDesSenha(),
				'dtcadastro'=>$this->getDtCadastro()->format("d/m/Y H:i:s")
			));
		}
		//Termino: Método mágico '__toString'
	}
	
?>


