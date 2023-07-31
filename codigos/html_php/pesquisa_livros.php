<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body style="background-color: #F7EFFF;">

<nav class="navbar col-12 position-fixed navbar-expand-lg bg-body" style="z-index: 999;" style="background-color: #FFFFFF;">
    <div class="container-fluid col-11 m-auto">
      <!--<a class="navbar-brand" href="#" margin-padding >CLC</a>-->
      <a class="navbar-brand" href="pagina_pos_login.html">
        <img src="imagens/logo.png" alt="" width="60" height="60" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-5 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="equipe.html">Equipe</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://instagram.com/clubedeleituraceres?igshid=NGExMmI2YTkyZg==">Instagram</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="campus.html">Campus</a>
            </li>
          </ul>
        <li class="nav-item " style="list-style: none;">
          <form class="d-flex " class="form-control me-2" role="search" action="pesquisa_livros.php">
            <select name="options_pesquisa"  id="1" class= " me-2 btn btn-outline-light -secondary " style= "background-color: mediumpurple;" style="list-style: none;">
              <!-- me-2 p-0 btn btn btn-outline-secondary-->
                <option value="1">Titulo</option>
                <option value="2">Autor</option>
                <option value="3">Gênero</option>
                <option value="4">Editora</option>
            </select>
            <input class="form-control me-2" type="search" placeholder="Pesquisar livro por: " aria-label="Search" name="informacao_digitada" style= "border-block: medium-purple;">
        </li>
          <button  class="btn btn-outline-light "type="submit" style="background-color: mediumpurple;">Pesquisar</button>
          </form>
      </div>
    </div>
  </nav>
  <br><br>
      <div class="row g-1 container-fluid">
    <?php
//estrutura básica de conexão php e banco de dados{----
    $servidor = "db";
    $usuario ="root";
    $senha = "54321";
    $nome_banco ="db_site";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco );
//----}

//recepção de dados{----
    $escolha = $_GET["options_pesquisa"];
    $palavra_pesquisada = $_GET["informacao_digitada"];
//----}

//inicio de pesquisa de dados tabela livro{----
    //pesquisa por titulo{----
if ($escolha == "1") {
    $sql = "SELECT * FROM tb_livro WHERE  nome_livro like '%$palavra_pesquisada%'";
    $pesquisa_por_nome = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($pesquisa_por_nome) > 0){
        while ($linha_tabela_livro = mysqli_fetch_array($pesquisa_por_nome)) {
            //busca de imagem no bd
            $id_imagem = $linha_tabela_livro['id_imagem'];
            $sql_id_imagem = "SELECT * FROM tb_link_imagens WHERE id_imagem = '$id_imagem'";
            $pesquisa_por_id_imagem =  mysqli_query($conexao, $sql_id_imagem);
            if (mysqli_num_rows($pesquisa_por_id_imagem) > 0){
                while ($linha_tb_imagem = mysqli_fetch_array($pesquisa_por_id_imagem)) {
                    $link_imagem = $linha_tb_imagem["link_imagem"];
                }
            }
            echo"<br><div class='card ' style='max-width: 520px; max-height: 200px; border-color: rgb(59, 0, 114); margin: 90px 20px 0px 20px; background-color:white;'>
            <div class='row g-0'>
              <div class='col-md-4'>
                <img src='$link_imagem' class='img-fluid rounded-start' alt='imagem do livro' style='max-height: 185px; max-width: 555px;'>
              </div>
             <br>";
            //busca por imagem finalizada
            $nome_livro = $linha_tabela_livro['nome_livro'];
            
            echo "<div class='col-md-8'>
            <div class='card-body'>
              <h5 class='card-title'>$nome_livro</h5> ";

            $data_publi = $linha_tabela_livro['data_publi'];

            echo "<p class='card-text'>
            Data de publição: $data_publi
            <br>";

            $titulo_livro = $linha_tabela_livro['titulo_livro'];
            echo "Titulo real do livro: $titulo_livro <br> ";
            //inicio de pesquisa do select por chave estrangeira
            //autor
            $id_autor = $linha_tabela_livro['id_autor'];
            $sql_id_autor = "SELECT * FROM tb_autor WHERE id_autor = '$id_autor'";
            $pesquisa_por_id_autor =  mysqli_query($conexao, $sql_id_autor);
            if (mysqli_num_rows($pesquisa_por_id_autor) > 0){
                while ($linha_tb_autor = mysqli_fetch_array($pesquisa_por_id_autor)) {
                    $nome_autor = $linha_tb_autor['nome_autor'];
                    echo "Autor: $nome_autor <br>";
                }
            }
            //gênero
            $id_genero = $linha_tabela_livro['id_genero'];
            $sql_id_genero = "SELECT * FROM tb_genero WHERE id_genero = '$id_genero'";
            $pesquisa_por_id_genero =  mysqli_query($conexao, $sql_id_genero);
            if (mysqli_num_rows($pesquisa_por_id_genero) > 0){
                while ($linha_tb_genero = mysqli_fetch_array($pesquisa_por_id_genero)) {
                    $genero = $linha_tb_genero['genero'];
                    echo "Gênero: $genero <br>";
                }               
            } 
            //editoa
            $id_editora = $linha_tabela_livro['id_editora'];
            $sql_id_editora = "SELECT * FROM tb_editora WHERE id_editora = '$id_editora'";
            $pesquisa_por_id_editora =  mysqli_query($conexao, $sql_id_editora);
            if (mysqli_num_rows($pesquisa_por_id_editora) > 0){
                while ($linha_tb_editora = mysqli_fetch_array($pesquisa_por_id_editora)) {
                    $editora = $linha_tb_editora['nome_editora'];
                    echo "Editora: $editora ";
                    echo"</p>
                    </div>
                        </div>
                            </div>
                                </div>";
                }               
            }
        }
    }
    else {
        echo"Nenhum livro encontrado";
    }
}
    //término de pesquisa por título----}

    //inicio de pesquisa por autor{----
elseif ($escolha == "2") {
    $sql = "SELECT * FROM tb_autor WHERE nome_autor like '%$palavra_pesquisada%'";
    $pesquisa_por_autor = mysqli_query($conexao, $sql);
    
    if (mysqli_num_rows($pesquisa_por_autor) > 0){
        while ($linha_tb_nome_autor = mysqli_fetch_array($pesquisa_por_autor)) {
            $nome_autor = $linha_tb_nome_autor['nome_autor'];
            $id_autor = $linha_tb_nome_autor['id_autor'];   
            $sql_linha_id_autor = "SELECT * FROM tb_livro WHERE id_autor = '$id_autor'";
            $pesquisa_por_linha_id_autor =  mysqli_query($conexao, $sql_linha_id_autor);
            if (mysqli_num_rows($pesquisa_por_linha_id_autor) > 0){
                while ($linha_tabela_livro = mysqli_fetch_array($pesquisa_por_linha_id_autor)) {
                    //busca de imagem no bd
                    $id_imagem = $linha_tabela_livro['id_imagem'];
                    $sql_id_imagem = "SELECT * FROM tb_link_imagens WHERE id_imagem = '$id_imagem'";
                    $pesquisa_por_id_imagem =  mysqli_query($conexao, $sql_id_imagem);
                    if (mysqli_num_rows($pesquisa_por_id_imagem) > 0){
                        while ($linha_tb_imagem = mysqli_fetch_array($pesquisa_por_id_imagem)) {
                            $link_imagem = $linha_tb_imagem["link_imagem"];
                        }
                    }
                    echo"<br><div class='card ' style='max-width: 530px; max-height: 200px; border-color: rgb(59, 0, 114); margin: 90px 20px 0px 40px; background-color:white;'>
                    <div class='row g-0'>
                    <div class='col-md-4'>
                        <img src='$link_imagem' class='img-fluid rounded-start' alt='imagem do livro' style='max-height: 185px; max-width: 555px;'>
                    </div>
                    <br>";
                    //busca por imagem finalizada
                    $nome_livro = $linha_tabela_livro['nome_livro'];

                    echo "<div class='col-md-8'>
                    <div class='card-body'>
                    <h5 class='card-title'>$nome_livro</h5> ";

                    $data_publi = $linha_tabela_livro['data_publi'];

                    echo "<p class='card-text'>
                    Data de publição: $data_publi
                    <br>";

                    $titulo_livro = $linha_tabela_livro['titulo_livro'];

                    echo "Titulo real do livro: $titulo_livro <br> ";

                    echo"Autor: $nome_autor <br>";

                    //gênero
                    $id_genero = $linha_tabela_livro['id_genero'];
                    $sql_id_genero = "SELECT * FROM tb_genero WHERE id_genero = '$id_genero'";
                    $pesquisa_por_id_genero =  mysqli_query($conexao, $sql_id_genero);
                    if (mysqli_num_rows($pesquisa_por_id_genero) > 0){
                        while ($linha_tb_genero = mysqli_fetch_array($pesquisa_por_id_genero)) {
                            $genero = $linha_tb_genero['genero'];
                            echo "Gênero: $genero <br>";
                        }
                    }
                    //editora
                    $id_editora = $linha_tabela_livro['id_editora'];
                    $sql_id_editora = "SELECT * FROM tb_editora WHERE id_editora = '$id_editora'";
                    $pesquisa_por_id_editora =  mysqli_query($conexao, $sql_id_editora);
                    if (mysqli_num_rows($pesquisa_por_id_editora) > 0){
                        while ($linha_tb_editora = mysqli_fetch_array($pesquisa_por_id_editora)) {
                            $editora = $linha_tb_editora['nome_editora'];
                            echo "Editora: $editora ";
                            echo"</p>
                            </div>
                                </div>
                                    </div>
                                        </div>";
                        }               
                    }  
                }               
            }
        }
    }else {
        echo"Nenhum livro encontrado";
    }    
}
    //término de pesquisa por autor----}       

    //ínicio de pesquisa por gênero{----
elseif ($escolha == "3") {
    $sql = "SELECT * FROM tb_genero WHERE genero like '%$palavra_pesquisada%'";
    $pesquisa_por_genero = mysqli_query($conexao, $sql);
    
    if (mysqli_num_rows($pesquisa_por_genero) > 0){
        while ($linha_tb_nome_genero = mysqli_fetch_array($pesquisa_por_genero)) {
            $genero = $linha_tb_nome_genero['genero'];
            $id_genero = $linha_tb_nome_genero['id_genero'];   
            $sql_linha_id_genero = "SELECT * FROM tb_livro WHERE id_genero = '$id_genero'";
            $pesquisa_por_linha_id_genero =  mysqli_query($conexao, $sql_linha_id_genero);
            if (mysqli_num_rows($pesquisa_por_linha_id_genero) > 0){
                while ($linha_tabela_livro = mysqli_fetch_array($pesquisa_por_linha_id_genero)) {
                    //busca de imagem no bd
                    $id_imagem = $linha_tabela_livro['id_imagem'];
                    $sql_id_imagem = "SELECT * FROM tb_link_imagens WHERE id_imagem = '$id_imagem'";
                    $pesquisa_por_id_imagem =  mysqli_query($conexao, $sql_id_imagem);
                    if (mysqli_num_rows($pesquisa_por_id_imagem) > 0){
                        while ($linha_tb_imagem = mysqli_fetch_array($pesquisa_por_id_imagem)) {
                            $link_imagem = $linha_tb_imagem["link_imagem"];
                        }
                    }
                    echo"<br><div class='card ' style='max-width: 530px; max-height: 200px; border-color: rgb(59, 0, 114); margin: 90px 20px 0px 40px; background-color:white;'>
                    <div class='row g-0'>
                    <div class='col-md-4'>
                        <img src='$link_imagem' class='img-fluid rounded-start' alt='imagem do livro' style='max-height: 185px; max-width: 555px;'>
                    </div>
                    <br>";
                    //busca por imagem finalizada
                    $nome_livro = $linha_tabela_livro['nome_livro'];

                    echo "<div class='col-md-8'>
                    <div class='card-body'>
                      <h5 class='card-title'>$nome_livro</h5> ";

                    $data_publi = $linha_tabela_livro['data_publi'];

                    echo "<p class='card-text'>
                    Data de publição: $data_publi
                    <br>";

                    $titulo_livro = $linha_tabela_livro['titulo_livro'];

                    echo "Titulo real do livro: $titulo_livro <br> ";

                    //gênero
                    $id_autor = $linha_tabela_livro['id_autor'];
                    $sql_id_autor = "SELECT * FROM tb_autor WHERE id_autor = '$id_autor'";
                    $pesquisa_por_id_autor =  mysqli_query($conexao, $sql_id_autor);
                    if (mysqli_num_rows($pesquisa_por_id_autor) > 0){
                        while ($linha_tb_autor = mysqli_fetch_array($pesquisa_por_id_autor)) {
                            $autor = $linha_tb_autor['nome_autor'];
                        }
                    }
                    echo "Autor: $autor <br>";
                    echo"Gênero: $genero <br>";
                    //editora
                    $id_editora = $linha_tabela_livro['id_editora'];
                    $sql_id_editora = "SELECT * FROM tb_editora WHERE id_editora = '$id_editora'";
                    $pesquisa_por_id_editora =  mysqli_query($conexao, $sql_id_editora);
                    if (mysqli_num_rows($pesquisa_por_id_editora) > 0){
                        while ($linha_tb_editora = mysqli_fetch_array($pesquisa_por_id_editora)) {
                            $editora = $linha_tb_editora['nome_editora'];
                            echo "Editora: $editora ";
                            echo"</p>
                            </div>
                                </div>
                                    </div>
                                        </div>";
                        }               
                    }  
                }               
            }
        }
    }else {
        echo"Nenhum livro encontrado";
    }    
}    
////término de pesquisa por gênero----}

elseif ($escolha == "4") {
    $sql = "SELECT * FROM tb_editora WHERE nome_editora like '%$palavra_pesquisada%'";
    $pesquisa_por_editora = mysqli_query($conexao, $sql);
//------------------------------------------------------------------------------
if (mysqli_num_rows($pesquisa_por_editora) > 0){
    while ($linha_tb_nome_editora = mysqli_fetch_array($pesquisa_por_editora)) {
        $editora = $linha_tb_nome_editora['nome_editora'];
        $id_editora = $linha_tb_nome_editora['id_editora'];   
        $sql_linha_id_editora = "SELECT * FROM tb_livro WHERE id_editora = '$id_editora'";
        $pesquisa_por_linha_id_editora =  mysqli_query($conexao, $sql_linha_id_editora);
        if (mysqli_num_rows($pesquisa_por_linha_id_editora) > 0){
            while ($linha_tabela_livro = mysqli_fetch_array($pesquisa_por_linha_id_editora)) {
                //busca de imagem no bd
                $id_imagem = $linha_tabela_livro['id_imagem'];
                $sql_id_imagem = "SELECT * FROM tb_link_imagens WHERE id_imagem = '$id_imagem'";
                $pesquisa_por_id_imagem =  mysqli_query($conexao, $sql_id_imagem);
                if (mysqli_num_rows($pesquisa_por_id_imagem) > 0){
                    while ($linha_tb_imagem = mysqli_fetch_array($pesquisa_por_id_imagem)) {
                        $link_imagem = $linha_tb_imagem["link_imagem"];
                    }
                }
                echo"<br><div class='card ' style='max-width: 530px; max-height: 200px; border-color: rgb(59, 0, 114); margin: 90px 20px 0px 40px; background-color:white;'>
                <div class='row g-0'>
                <div class='col-md-4'>
                    <img src='$link_imagem' class='img-fluid rounded-start' alt='imagem do livro' style='max-height: 185px; max-width: 555px;'>
                </div>
                <br>";
                //busca por imagem finalizada
                $nome_livro = $linha_tabela_livro['nome_livro'];

                echo "<div class='col-md-8'>
                        <div class='card-body'>
                            <h5 class='card-title'>$nome_livro</h5> ";

                $data_publi = $linha_tabela_livro['data_publi'];
                
                echo "<p class='card-text'>
                    Data de publição: $data_publi
                    <br>";
                
                $titulo_livro = $linha_tabela_livro['titulo_livro'];

                echo "Titulo real do livro: $titulo_livro <br> ";
                //autor
                $id_autor = $linha_tabela_livro['id_autor'];
                $sql_id_autor = "SELECT * FROM tb_autor WHERE id_autor = '$id_autor'";
                $pesquisa_por_id_autor =  mysqli_query($conexao, $sql_id_autor);
                if (mysqli_num_rows($pesquisa_por_id_autor) > 0){
                    while ($linha_tb_autor = mysqli_fetch_array($pesquisa_por_id_autor)) {
                        $autor = $linha_tb_autor['nome_autor'];
                        echo "Autor: $autor <br>";
                    }
                }
                //genero
                $id_genero = $linha_tabela_livro['id_genero'];
                $sql_id_genero = "SELECT * FROM tb_genero WHERE id_genero = '$id_genero'";
                $pesquisa_por_id_genero =  mysqli_query($conexao, $sql_id_genero);
                if (mysqli_num_rows($pesquisa_por_id_genero) > 0){
                    while ($linha_tb_genero = mysqli_fetch_array($pesquisa_por_id_genero)) {
                        $genero = $linha_tb_genero['genero'];
                        echo "Gênero: $genero <br>";
                        }
                    }echo "Editora: $editora";
                    echo"</p>
                            </div>
                                </div>
                                    </div>
                                        </div>";
                }               
            }
        }
    }else {
        echo"Nenhum livro encontrado";
    }    
}

?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>