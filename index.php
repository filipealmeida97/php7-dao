<?php

require_once("config.php");

//Nesse traz apenas um usuario e inicia o objeto com seus respectivos atributos e valores
//$usuario = new Usuario();
//$usuario->loadById(1);
//echo $usuario;


//Carrega uma Lista de Usuario
//$results = Usuario::getList();
//echo json_encode($results);

//Carrega uma lista de usuario pelo login
//$search = Usuario::search("ma");
//echo json_encode($search)

//Faz Login
//$login = new Usuario();
//$login->login("Paulo", "1$%&3");
//echo $login

//Executa um inserção no BD
//$aluno = new Usuario("Sergio", "034876");
//$aluno->insert();
//echo $aluno;

//Update 
//$usuario = new Usuario();
//$usuario->loadById(8);
//$usuario->update("Professor: Marcelo", "32489");
//echo $usuario;

$usuario = new Usuario();
$usuario->loadById(7);
$usuario->delete();
echo $usuario;

?>