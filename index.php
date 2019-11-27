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

$login = new Usuario();

$login->login("Paulo", "1$%&3");

echo $login
?>