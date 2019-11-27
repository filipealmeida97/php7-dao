<?php

require_once("config.php");

$sql = new Sql();

$result = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($result);

?>