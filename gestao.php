<?php
session_start();
if (isset($_SESSION["utilizador"])) {
    $utilizador = $_SESSION["utilizador"];

}
?>        

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão Book Society</title>
    <link rel="stylesheet" href="estiloscss/estilogestao.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        
    </style>
</head>
<body>
    <div class="container-painel">
        <div class="top-bar">
            <div class="company-name">
                <img src="imagens/book.png" alt="Slogan" class="slogan-img">
                Book Society Gestão
            </div>
            <div class="menu-horizontal">
                <ul class="menu">
                    <li><a href="adicionarlivros.php">Adicionar Livros</a></li>
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
                    <li><a href="logout.php">Terminar Sessão</a></li>
                </ul>
            </div>
            <div class="welcome-message">
                Olá novamente, <?php echo htmlspecialchars($utilizador); ?>!
                <img src="imagens/hello.gif" alt="Avatar do Usuário" class="avatar">
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="sidebar">
            <img src="imagens/loja.jpg" alt="Slogan" class="slogan-img2">  
            <ul>
                <li><img src="imagens/utilizador.png" alt="Avatar do Usuário" class="avatar"></li>
                <li><img src="imagens/moeda.png" alt="Avatar do Usuário" class="avatar"></li>
                <li><img src="imagens/grafico.png" alt="Avatar do Usuário" class="avatar"></li>
                <li><img src="imagens/clientes.png" alt="Avatar do Usuário" class="avatar"></li>
                <li><img src="imagens/estiqueta.png" alt="Avatar do Usuário" class="avatar"></li>    
            </ul>
        </div>
            
     <div class="livros-tabela">
    <div class="livro-row">
        <div class="livro">
            <img src="imagens/tess.jpg" alt="Tess of the D'Ubervilles" style="max-width: 160px; height: auto;">

            <h3>Tess of the D'Ubervilles</h3>
            <p>none</p>
            <p class="preco">€29,90</p>
            <p class="autor">Thomas Hardy</p>
        </div>
        <div class="livro">
            <img src="imagens/pride.jpg" alt="Pride and Prejudice" style="max-width: 162px; height: auto;">
            <h3>Pride and Prejudice</h3>
            <p>none</p>
            <p class="preco">€24,99</p>
            <p class="autor">Jane Austen</p>
        </div>
        <div class="livro">
            <img src="imagens/morro.jpg" alt="Morro dos Ventos Uivantes"style="max-width: 133px; height: auto;">
            <h3>Morro dos Ventos Uivantes</h3>
            <p>none</p>
            <p class="preco">€30,50</p>
            <p class="autor">Emily Bronte</p>
        </div>
        <div class="livro">
            <img src="imagens/harry.jpg" alt="Harry Potter e a Pedra Filosofal"style="max-width: 145px; height: auto;">
            <h3>Harry Potter e a Pedra Filosofal</h3>
            <p>none</p>
            <p class="preco">€19,00</p>
            <p class="autor">J. K. Rowling</p>
        </div>
         <div class="livro">
            <img src="imagens/revolucao.png" alt="Título do Livro 4"style="max-width: 170px; height: auto;">
            <h3>Revolução dos Bichos</h3>
            <p>none</p>
            <p class="preco">€30,99</p>
            <p class="autor">George Orwell</p>
        </div>  
    </div>
    <div class="livro-row">
        <div class="livro">
            <img src="imagens/conde.jpg" alt="Conde de Monte Cristo"style="max-width: 160px; height: auto;">
            <h3>Conde de Monte Cristo</h3>
            <p>none</p>
            <p class="preco">€59,00</p>
            <p class="autor">Alexandre Dumas</p>
        </div>
      <div class="livro">
            <img src="imagens/zaratustra.jpg" alt="Zaratustra"style="max-width: 155px; height: auto;">
            <h3>Assim Falou Zaratustra</h3>
            <p>none</p>
            <p class="preco">€25,00</p>
            <p class="autor">Friedrich Nietzsche</p>
        </div>
        <div class="livro">
            <img src="imagens/karenina.jpg" alt="Anna Karenina"style="max-width: 178px; height: auto;">
            <h3>Anna Karenina</h3>
            <p>none</p>
            <p class="preco">€30,00</p>
            <p class="autor">Liev Tolstói</p>
        </div>
        <div class="livro">
            <img src="imagens/1984.png" alt="1984"style="max-width: 154px; height: auto;">
            <h3>1984</h3>
            <p>none</p>
            <p class="preco">€29,00</p>
            <p class="autor">George Orwell</p>
        </div>    
        <div class="livro">
            <img src="imagens/aia.jpg" alt="Conto da Aia"style="max-width: 164px; height: auto;">
            <h3>Conto da Aia</h3>
            <p>none</p>
            <p class="preco">€20,00</p>
            <p class="autor">Margaret Atwood</p>
        </div>    
    </div>
    <div class="livro-row">
        <div class="livro">
            <img src="imagens/guerra.jpg" alt="Guerra e Paz"style="max-width: 160px; height: auto;">
            <h3>Guerra e Paz</h3>
            <p>none</p>
            <p class="preco">€59,00</p>
            <p class="autor">Liev Tolstói</p>
        </div>
      <div class="livro">
            <img src="imagens/mercadorveneza.jpg" alt="O Mercador de Veneza"style="max-width: 154px; height: auto;">
            <h3>O Mercador de Veneza</h3>
            <p>none</p>
            <p class="preco">€15,00</p>
            <p class="autor">William Shakespeare</p>
        </div>
        <div class="livro">
            <img src="imagens/mulher.jpg" alt="A Guerra Não Tem Rosto de Mulher"style="max-width: 153px; height: auto;">
            <h3>A Guerra Não Tem Rosto de Mulher</h3>
            <p>none</p>
            <p class="preco">€32,99</p>
            <p class="autor">Svetlana Aleksiévitch</p>
        </div>
        <div class="livro">
            <img src="imagens/tronos.jpg" alt="Game of Thrones Vol 1"style="max-width: 178px; height: auto;">
            <h3>Game of Thrones Vol 1</h3>
            <p>none</p>
            <p class="preco">€23,00</p>
            <p class="autor">George R.R. Martin</p>
        </div>    
        <div class="livro">
            <img src="imagens/DaVinciCode.jpg" alt="O Código Da Vinci"style="max-width: 160px; height: auto;">
            <h3>O Código Da Vinci</h3>
            <p>none</p>
            <p class="preco">€20,00</p>
            <p class="autor">Dan Brown</p>
        </div>    
    </div>         
</div>
</div>
</body>
<footer class="footer">
  <div class="footer-content">
    <p>&copy; Developed with ❤️ by <a href="#" class="white-text" target="_blank">Tess</a>.</p>
  </div>
</footer>

<style>
/* Estilos para o rodapé */
.footer {
  position: fixed;
  bottom: 0;
  left: 0; 
  width: 100%;
  background-color: #5D5A5A;
  color: #fff; 
  text-align: center;
  padding: 20px 0;
  z-index: 1000;
  height: 20px;    
}

.footer a {
  color: #fff;
  text-decoration: none;   
}

.footer a:hover {
  text-decoration: underline;
}
.footer-content p {
  margin-top: -5px; 
}        
</style>
</html>

