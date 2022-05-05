<?php

require_include("conexao.php");

$email=$_POST['email'];
$senha=$_POST['senha'];
$cidade=$_POST['cidade'];
$comentarios=$_POST['comentarios']; 


$sql="INSERT INTO cadastro(email,senha,cidade,comentarios) VALUES ('$email','$senha','$cidade','$comentarios')";

if(mysqli_query($conexao,$sql)){
  echo "Usuário cadastrado com sucesso";
}
else{
  echo "Erro".mysqli_connect_error($conexao);
}

mysqli_close($conexao);

?>