<?php
    $servidor = "db";
    $usuario = "root";
    $senha = "54321";
    $banco = "db_site";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    
    $login_usuario = $_GET["login_usuario"];
    $login_senha = $_GET["login_senha"];

    $sql = "SELECT * FROM tb_usuario WHERE nome_usuario = '$login_usuario' and senha_usuario = '$login_senha'";
    
    $resultados = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultados) > 0){
        header('Location: pagina_pos_login.html');
        exit();
    } else {
        header('Location: login.html');
        exit(); 
    };

    mysqli_close($conexao)    
?>
