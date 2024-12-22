<?php
session_start();

// Other PHP code here

if (isset($_SESSION["utilizador"])) {
    // Rest of your code for authenticated users
} else {
    header("location: index.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Society</title>
    <link rel="stylesheet" href="estiloscss/estilotodos.css">
    <link rel='icon' type='image/x-icon' href='favicon.ico'>   
</head>
    <div class="container-painel">
        <div class="top-bar">
            <div class="company-name">
                <img src="imagens/book.png" alt="Slogan" class="slogan-img">
                Listagem
            </div>
            <div class="menu-horizontal">
                <ul class="menu">
                    <li class="dropdown">
                        <a href="#" >Consultar</a>
                        <div class="dropdown-content">
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
                    <li><a href="adicionarlivros.php">Adicionar Livro</a></li>      
                    <li><a href="gestao.php">Voltar a Gestão</a></li>      
                    <li><a href="logout.php">Terminar Sessão</a></li>
                </ul>
            </div>    
        </div>
           </div>  
<body>
<?php
if (isset($_SESSION["utilizador"])) {
    $utilizador = $_SESSION["utilizador"];

    //---------------------------------------Conexão a BD----------------------------------------------------------------------------//    
    $maquina="fdb1031.runhosting.com";
    $usernamebd="4433440_tess";
    $passwordbd="fusrodah2011";
    $bd="4433440_tess";    
        
    $ligacao = new PDO("mysql:host=$maquina; dbname=$bd", $usernamebd, $passwordbd);    
    $ligacao->query("SET NAMES utf8");         
    
    $consulta = $ligacao->prepare("SELECT * FROM bookssociety");
    $consulta->execute();

    print "<div class='table-wrapper'>";
    print "<table class='user-table'>";
    // Cabeçalho da tabela
    print "<tr>";
    print "<th>ID</th>";
    print "<th class='titulo-column'>Título</th>";
    print "<th>Autor</th>";
    print "<th>Gênero</th>";
    print "<th>Editora</th>";
    print "<th class='ano-column'>Ano Publicação</th>";
    print "<th>ISBN</th>";
    print "<th class='preco-column'>Preço</th>";
    print "<th class='QuantidadeemEstoque-column'>Qtd em Estoque</th>";
    print "<th class='IMG-column'>IMG</th>";
    print "<th>Editar</th>";
    print "<th>Eliminar</th>";
    print "</tr>";

    while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
        // Dados da tabela
        print "<tr>";
        print "<td>$row->id</td>";
        print "<td>$row->titulo</td>";
        print "<td>$row->autor</td>";
        print "<td>$row->genero</td>";
        print "<td>$row->editora</td>";
        print "<td>$row->ano_publicacao</td>";
        print "<td>$row->isbn</td>";
        print "<td>$row->preco</td>";
        print "<td>$row->qtdestoque</td>";
        print "<td><img src='$row->imagem' alt='Imagem do Livro' style='max-width: 200px; max-height: 120px;'></td>";
        print "<td class='action-cell'><a href='editarlivro.php?id=$row->id'>Editar</a></td>";
        print "<td class='action-cell'><a href='eliminarlivro.php?id=$row->id'>Eliminar</a></td>";
        print "</tr>";
    }
    print "</table>";
    print "</div>";
    
   //print"<h3><a href='infosoftware.php'>Informações do Software</a></h3>";     
} else {
    header("location: gestao.php");
    exit(); 
}
?>
</body>
</html>
