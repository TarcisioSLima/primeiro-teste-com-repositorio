<?php
    $servidor = "db";
    $usuario ="root";
    $senha = "54321";
    $nome_banco ="db_site";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );

//docker-php-ext-install mysqli
?>