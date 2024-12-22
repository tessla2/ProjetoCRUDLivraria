<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Book Society</title>
    <link rel="stylesheet" href="estiloscss/estiloconsulta.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">     
</head>
<body>
    <div class="container-painel">
        <div class="top-bar">
            <div class="company-name">
                <img src="imagens/book.png" alt="Slogan" class="slogan-img">
                Consulta
            </div>
            <div class="menu-horizontal">
                <ul class="menu">
                    <li class="dropdown">
                        <a href="#" >Consultar</a>
                        <div class="dropdown-content">
                            <a href="consultartodos.php">Todos os Livros</a>
                            <a href="consultartitulo.php">Por Título</a>
                            <a href="consultarautor.php">Por Autor</a>
                            <a href="consultargenero.php">Por Gênero</a>
                            <a href="consultareditora.php">Por Editora</a>
                            <a href="consultarano.php">Por Ano de Publicação</a>
                            <a href="consultarisbn.php">Por ISBN</a>
                            <a href="consultarqtdestoque.php">Por Quantidade em Estoque</a>
                            <a href="consultarpreco.php">Por Preço</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#">Consultar Personalizada</a>
                        <div class="dropdown-content">
                            <a href="umregistroxml.html">Por Registro XML</a>
                            <a href="todosregistrosjson.html">Por todos Registros JSON</a>
                        </div>
                    </li>
                    <li><a href="gestao.php">Voltar a Gestão</a></li>      
                    <li><a href="logout.php">Terminar Sessão</a></li>
                </ul>
            </div> 
        </div>
        <h1>Consulta por Gênero</h1>
        <div class="content">
            <form action="" method="GET" class="form-group">
                <label for="genero" class="consulta-genero">Indique o Gênero:</label>        
                <input type="text" name="genero" id="genero" class="consulta-input"> 
                <input type="submit" name="pesquisa" id="pesquisa" value="PESQUISAR">  
            </form>  
        </div>
        <div class="pesquisa">
            <?php
            if (isset($_GET["pesquisa"])) {
                $genero = $_GET["genero"];

                // BD    
                $maquina = "fdb1031.runhosting.com";
                $usernamebd = "4433440_tess";
                $passwordbd = "fusrodah2011";
                $bd = "4433440_tess";    

                try {
                    $ligacao = new PDO("mysql:host=$maquina;dbname=$bd", $usernamebd, $passwordbd);    
                    $ligacao->query("SET NAMES utf8");         
                    $consulta = $ligacao->prepare("SELECT * FROM bookssociety WHERE genero LIKE ?");
                    $consulta->execute(["%$genero%"]);

                    echo "<table width='75%' border='1'>";
                    echo "<tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>ID</th>
                            <th>Gênero</th>
                            <th>Editora</th>
                            <th>Ano de Publicação</th>
                            <th>ISBN</th>
                            <th>Preço</th>
                            <th>Quantidade em Estoque</th>
                            <th>Imagem</th>
                            <th>Editar</th>
                          </tr>";

                    while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
                        echo "<tr>";
                        echo "<td>$row->titulo</td>";
                        echo "<td>$row->autor</td>";
                        echo "<td>$row->id</td>";
                        echo "<td>$row->genero</td>";
                        echo "<td>$row->editora</td>";
                        echo "<td>$row->ano_publicacao</td>";
                        echo "<td>$row->isbn</td>";
                        echo "<td>$row->preco</td>";
                        echo "<td>$row->qtdestoque</td>";
                        echo "<td><img src='$row->imagem' alt='Imagem do Livro' style='max-width: 100px; max-height: 100px;'></td>";
                        echo "<td class='action-cell'><a href='editarlivro.php?id=$row->id'>Editar</a></td>";
                      
                        echo "</tr>";
                    }
                    echo "</table>";
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
            ?>
        </div>
    </div>
    <?php require_once("rodape.html"); ?>    
</body>
</html>