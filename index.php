<?php
session_start();
//DADOS BD
$maquina="fdb1031.runhosting.com";
$usernamebd="4433440_tess";
$passwordbd="fusrodah2011";
$bd="4433440_tess";
 
if (isset($_POST["login"])) {
  //print "O Formulário foi enviado !";
   $username=$_POST["username"];
   $password=$_POST["password"];
   $ligacao = new PDO("mysql:host=$maquina; dbname=$bd", $usernamebd, $passwordbd);    
   $ligacao->query("SET NAMES utf8");         
   $consulta=$ligacao->prepare("select * from yotessutilizadores where user='$username' and pass='$password'");
   $consulta->execute();
     if ($consulta->rowCount()>0) {
    // if (($username==$user)&&($pass==$password))
    //  {
    //print "Autenticação com sucesso!";
    $_SESSION["utilizador"]=$_POST["username"];
    header("location: gestao.php");        
    }        
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">        
<title>Autenticação</title>
<link rel='stylesheet' href='estiloscss/estiloautenticador.css'>
<link rel="icon" type="image/x-icon" href="favicon.ico">
<style>
/* Estilos para o cabeçalho */
.header {
    background-image: url('imagens/sociedade.jpg'); /* URL da sua imagem */
    background-size: cover; /* Garante que a imagem cubra todo o cabeçalho */
    background-position: center; /* Centraliza a imagem */
    padding: 20px; /* Adiciona um espaçamento interno */
    text-align: center; /* Centraliza o conteúdo dentro do cabeçalho */
    color: #fff; /* Cor do texto */
}
</style>    
</head>     
<body>
<div class="container-painel">
  <div class="top-bar">
    <div class="company-name">
      <img src="imagens/book.png" alt="Slogan" class="slogan-img">
      Book Society Gestão
    </div> 
  </div>  

  <div class="container"> 
    <header class="header"><h1>Bem-Vindo! Autenticador Society<hr></h1><h2>Login</h2></header>             
    <form action="" method="POST">
      <input type="text" name="username" id="username" placeholder="O seu username"><p/>
      <input type="password" name="password" id="password" placeholder="A sua password"><p/>
      <input type="submit" name="login" id="login" value="AUTENTICAR">
    </form>
  </div>
</div>
<div class="informacoes-container">
    <h2>Endereço</h2>
    <p>Rua das Flores, 123</p>
    <p>Telefone: (123) 456-7890</p>
</div>
<div class="avatar">
<img src="imagens/lendo.gif" alt="Slogan" class="slogan-img">
</div>
<?php require_once("rodape.html"); ?>     
</body>
</html>
