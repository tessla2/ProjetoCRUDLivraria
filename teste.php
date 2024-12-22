<?php
session_start();
if (isset($_SESSION["utilizador"])) {
    $utilizador = $_SESSION["utilizador"];
    print "<link rel='stylesheet' href='estilo.css'>"; 
    print "<link rel='icon' type='image/x-icon' href='favicon.ico'>";         
    //--------------------------------------------Topo-------------------------------------------------------------------------------//  
    require_once("consultartodos.php");

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
    print "<th>Título</th>";
    print "<th>Autor</th>";
    print "<th>Gênero</th>";
    print "<th>Editora</th>";
    print "<th>Ano de Publicação</th>";
    print "<th>ISBN</th>";
    print "<th>Preço</th>";
    print "<th>Quantidade em Estoque</th>";
    print "<th>IMG</th>";
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
        print "<td><img src='$row->imagem' alt='Imagem do Livro' style='max-width: 100px; max-height: 100px;'></td>";
        print "<td class='action-cell'><a href='editarlivro.php?id=$row->id'>Editar</a></td>";
        print "<td class='action-cell'><a href='eliminarlivro.php?id=$row->id'>Eliminar</a></td>";
        print "</tr>";
    }
    print "</table>";    print "</div>";
} else {
    header("location: index.php");
    exit(); 
}
?>







