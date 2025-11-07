<?php
session_start();
if (isset($_SESSION["utilizador"])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $maquina = "***";
        $usernamebd = "***";
        $passwordbd ="***";
        $bd = "***";
        $ligacao = new PDO("mysql:host=$maquina; dbname=$bd", $usernamebd, $passwordbd);
        $ligacao->query("SET NAMES utf8"); 

        // Deletando o livro imediatamente sem confirmação
        $consulta = $ligacao->prepare("DELETE FROM bookssociety WHERE id = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($consulta->rowCount() > 0) {
            // Define a mensagem de sucesso na variável de sessão
            $_SESSION['mensagem'] = "Livro excluído com sucesso.";
            // Redirecionando de volta após a exclusão
            header("Location: consultartodos.php");
            exit();
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir o livro.";
            // Cria um alerta JavaScript para exibir a mensagem de erro
            echo "<script>alert('Erro ao excluir o livro.');</script>";
            // Redirecionando de volta após o erro
            header("Location: consultartodos.php");
            exit();
        }
    } else {
        echo "ID do livro não especificado.";
    }
} else {
    header("location: index.php");
}
?>
