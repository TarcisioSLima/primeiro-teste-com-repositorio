<?php
    $nome_usuario = $_GET["nome_usuario"];
    $email_usuario = $_GET["email_usuario"];
    $senha_usuario = $_GET["senha_usuario"];

    $servidor = "db";
    $usuario = "root";
    $senha = "54321";
    $banco = "db_site";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    
    $pesquisa_email = "SELECT * FROM tb_usuario WHERE email_usuario = '$email_usuario'";
    $teste_email_repitido = mysqli_query($conexao, $pesquisa_email);

    if (mysqli_num_rows($teste_email_repitido) == 0){
        $insert_bd = "INSERT INTO tb_usuario (nome_usuario, email_usuario, senha_usuario) VALUES ('$nome_usuario', '$email_usuario', '$senha_usuario')";
     if (mysqli_query($conexao, $insert_bd)) {
        header('Location: login.html');
        exit();
    } else {
        header('Location: cadastro.html');
        exit();
    }
    }else {
        header('Location: cadastro.html');
        exit();
    }
    
?>
