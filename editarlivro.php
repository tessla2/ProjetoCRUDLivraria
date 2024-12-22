<?php
session_start();

if (!isset($_SESSION["utilizador"])) {
    header("location: index.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("location: consultartodos.php");
    exit;
}

$utilizador = $_SESSION["utilizador"];
$id_livro = $_GET['id'];

// Conexão com o banco de dados
$maquina = "fdb1031.runhosting.com";
$usernamebd = "4433440_tess";
$passwordbd = "fusrodah2011";
$bd = "4433440_tess";
$ligacao = new PDO("mysql:host=$maquina; dbname=$bd", $usernamebd, $passwordbd);
$ligacao->query("SET NAMES utf8");

// Verifique se o formulário foi enviado para editar o livro
if (isset($_POST['editar'])) {
    // Obtenha os dados do formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $genero = $_POST['genero'];
    $editora = $_POST['editora'];
    $ano_publicacao = $_POST['ano_publicacao'];
    $isbn = $_POST['isbn'];
    $preco = $_POST['preco'];
    $qtdestoque = $_POST['qtdestoque'];

    // Atualize os dados do livro no banco de dados
    $consulta = $ligacao->prepare("UPDATE bookssociety SET titulo=?, autor=?, genero=?, editora=?, ano_publicacao=?, isbn=?, preco=?, qtdestoque=? WHERE id=?");
    $consulta->execute([$titulo, $autor, $genero, $editora, $ano_publicacao, $isbn, $preco, $qtdestoque, $id_livro]);

    // Verifique se a atualização foi bem-sucedida
    if ($consulta->rowCount() > 0) {
        $mensagem = "Livro editado com Sucesso!";
        // Exibe a mensagem usando PHP
        echo "<div class='alert alert-success'><span class='alert-close'>&times;</span>$mensagem</div>";
    } else {
        $mensagem = "Erro ao editar livro. Por favor, tente novamente.";
        echo "<div class='alert alert-danger'><span class='alert-close'>&times;</span>$mensagem</div>";
    }
}

// Busque os detalhes do livro com base no ID
$consulta = $ligacao->prepare("SELECT * FROM bookssociety WHERE id = ?");
$consulta->execute([$id_livro]);
$livro = $consulta->fetch(PDO::FETCH_ASSOC);
?>

<html>
<head>
    <title>Editar Livro</title>
    <link rel='stylesheet' href='estiloscss/estiloeditar.css'>
<link rel="icon" type="image/x-icon" href="favicon.ico">     
</head>
<body>
   <div class="container-painel">
        <div class="top-bar">
            <div class="company-name">
                <img src="imagens/book.png" alt="Slogan" class="slogan-img">
                Editar Livro
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
                    <li><a href="consultartodos.php">Voltar a Lista</a></li>  
                    <li><a href="gestao.php">Voltar a Gestão</a></li>      
                    <li><a href="logout.php">Terminar Sessão</a></li>
                </ul>
            </div> 
           </div>   
    <form class="form-container" action="" method="POST"> 
        <table>
            <tr>
                <td><h4>Título</h4></td>
                <td><input type="text" name="titulo" value="<?php echo $livro['titulo']; ?>" required></td>
            </tr>
            <tr>
                <td><h4>Autor</h4></td>
                <td><input type="text" name="autor" value="<?php echo $livro['autor']; ?>" required></td>
            </tr>
            <tr>
                <td><h4>Gênero</h4></td>
                <td><input type="text" name="genero" value="<?php echo $livro['genero']; ?>" required></td>
            </tr>
            <tr>
                <td><h4>Editora</h4></td>
                <td><input type="text" name="editora" value="<?php echo $livro['editora']; ?>"></td>
            </tr>
            <tr>
                <td><h4>Ano de Publicação</h4></td>
                <td><input type="number" name="ano_publicacao" value="<?php echo $livro['ano_publicacao']; ?>" required></td>
            </tr>
            <tr>
                <td><h4>ISBN</h4></td>
                <td><input type="text" name="isbn" value="<?php echo $livro['isbn']; ?>" required></td>
            </tr>
            <tr>
                <td><h4>Preço</h4></td>
                <td><input type="number" name="preco" value="<?php echo $livro['preco']; ?>" required></td>
            </tr>
            <tr>
                <td><h4>Quantidade em Estoque</h4></td>
                <td><input type="number" name="qtdestoque" value="<?php echo $livro['qtdestoque']; ?>" required></td>
            </tr>
            <tr>        
                <td colspan="2"><input type="submit" name="editar" value="Editar Livro"></td>  
            </tr>
        </table>
    </form>     
    </div>    
</body>
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
     <?php require_once("rodape.html"); ?>     
</html>
