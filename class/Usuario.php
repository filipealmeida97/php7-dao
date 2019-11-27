<?php

	class Usuario {
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

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
		
		//Início: Métod para procurar um objeto na base de dados pelo seu 'id'
		public function loadById($id){

			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if (count($results) > 0){
				$row = $results[0];

				$this->setIdUsuario($row['idusuario']);
				$this->setDesLogin($row['deslogin']);
				$this->setDesSenha($row['dessenha']);
				$this->setDtCadastro(new DateTime($row['dtcadastro']));
			}


		}
		//Termino: Métod para procurar um objeto na base de dados pelo seu 'id'

		public function __toString(){
			return json_encode(array(
				'idusuario'=>$this->getIdUsuario(),
				'deslogin'=>$this->getDesLogin(),
				'dessenha'=>$this->getDesSenha(),
				'dtcadastro'=>$this->getDtCadastro()->format("d/m/Y H:i:s")
			));
		}
	}
	
?>


