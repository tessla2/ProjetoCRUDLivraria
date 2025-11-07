<?php
session_start();
if (isset($_SESSION["utilizador"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["novo"])) {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $genero = $_POST["genero"];
    $editora = $_POST["editora"];
    $ano_publicacao = $_POST["ano_publicacao"];
    $isbn = $_POST["isbn"];
    $preco = $_POST["preco"];
    $qtdestoque = $_POST["qtdestoque"];
    $imagem_url = $_POST["imagem"]; // novo campo para o URL da imagem
    
    //BD
    $maquina = "***";
    $usernamebd = "***";
    $passwordbd = "***";
    $bd = "***";

    $ligacao = new PDO("mysql:host=$maquina; dbname=$bd", $usernamebd, $passwordbd);
    $ligacao->query("SET NAMES utf8");
    $consulta = $ligacao->prepare("INSERT INTO bookssociety (titulo, autor, genero, editora, ano_publicacao, isbn, preco, qtdestoque, imagem) 
        VALUES ('$titulo','$autor','$genero','$editora','$ano_publicacao','$isbn','$preco','$qtdestoque','$imagem_url')");
    $consulta->execute();
    if ($consulta->rowCount() > 0) {
        $mensagem = "Livro Inserido com Sucesso!";
        // Exibe a mensagem usando PHP
        echo "<div class='alert alert-success'><span class='alert-close'>&times;</span>$mensagem</div>";
    } else {
        $mensagem = "Erro ao inserir livro. Por favor, tente novamente.";
        echo "<div class='alert alert-danger'><span class='alert-close'>&times;</span>$mensagem</div>";
    }
}
?>

<html>
<head>
    <title>Book Society</title>
    <link rel='stylesheet' href='estiloscss/estiloadicionar.css'>
    <link rel="icon" type="image/x-icon" href="favicon.ico">     
</head>
<body>
   <div class="container-painel">
        <div class="top-bar">
            <div class="company-name">
                <img src="imagens/book.png" alt="Slogan" class="slogan-img">
                Novo Livro
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
           
           
    <form class="form-container" action="" method="POST"> 
        <table>
            <tr>
                <td><h4>Título</h4></td>
                <td><input type="text" name="titulo" id="titulo" required></td>
            </tr>
            <tr>
                <td><h4>Autor</h4></td>
                <td><input type="text" name="autor" id="autor" required></td>
            </tr>
            <tr>
                <td><h4>Gênero</h4></td>
                <td><input type="text" name="genero" id="genero" required></td>
            </tr>
            <tr>
                <td><h4>Editora</h4></td>
                <td><input type="text" name="editora" id="editora"></td>
            </tr>
            <tr>
                <td><h4>Ano de Publicação</h4></td>
                <td><input type="number" name="ano_publicacao" id="ano_publicacao"></td>
            </tr>
            <tr>
                <td><h4>ISBN</h4></td>
                <td><input type="text" name="isbn" id="isbn" required></td>
            </tr>
            <tr>
                <td><h4>Preço</h4></td>
                <td><input type="number" name="preco" id="preco" required></td>
            </tr>
            <tr>
                <td><h4>Quantidade em Estoque</h4></td>
                <td><input type="number" name="qtdestoque" id="qtdestoque" required></td>
            </tr>
            <tr>
                <td><h4>URL da Imagem</h4></td>
                <td><input type="text" name="imagem" id="imagem"></td>
            </tr>
            <tr>        
                <td colspan="2"><input type="submit" name="novo" id="novo" value="CRIAR NOVO"></td>  
            </tr>
        </table>
    </form>     
 
    </div>  
        <script>
    document.addEventListener('DOMContentLoaded', function() {
      const closeButtons = document.querySelectorAll('.alert-close');
      closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          const alert = this.parentElement;
          alert.classList.add('fade-out');
          setTimeout(() => {
            alert.style.display = 'none';
          }, 500); // Tempo correspondente à duração da animação definida no CSS
        });
      });
    });
  </script>
</body>
      <?php require_once("rodape.html"); ?> 
</html>
