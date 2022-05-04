<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
</head>

<body>

    <?php

    $hostname = "localhost";
    $bancodedados = "projeto_integrador";
    $usuario = "usuarios";
    $senha =

        $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
    if ($mysqli->connect_errno) {
        echo "Falha ao conectar: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
    } else
        echo "conectado!";

    ?>

</body>

</html>