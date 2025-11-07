<?php
//ob_start(); // Start output buffering
header("Access-Control-Allow-Origin: *");

// Conexão com o banco de dados
$maquina = "***";
$usernamebd = "***";
$passwordbd = "***";
$bd = "***";
$ligacao = new PDO("mysql:host=$maquina;dbname=$bd", $usernamebd, $passwordbd);
$ligacao->query("SET NAMES utf8");

function listarUmLivroXML($id) {
    global $ligacao;

    $consulta = $ligacao->prepare("SELECT * FROM bookssociety WHERE id = :id");
    $consulta->bindParam(':id', $id);
    $consulta->execute();

    header('Content-type: application/xml');
    print '<?xml version="1.0" encoding="UTF-8"?>';
    print "<livro>";

    if ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
        print "<id>$row->id</id>";
        print "<titulo>$row->titulo</titulo>";
        print "<autor>$row->autor</autor>";
        print "<genero>$row->genero</genero>";
        print "<editora>$row->editora</editora>";
        print "<ano_publicacao>$row->ano_publicacao</ano_publicacao>";
        print "<isbn>$row->isbn</isbn>";
        print "<preco>$row->preco</preco>";
        print "<qtdestoque>$row->qtdestoque</qtdestoque>";
    } else {
        print "<erro>Livro não encontrado</erro>";
    }

    print "</livro>";
}

function listarTodosLivrosXML() {
    global $ligacao;

    $consulta = $ligacao->prepare("SELECT * FROM bookssociety");
    $consulta->execute();

    header('Content-type: application/xml');
    print '<?xml version="1.0" encoding="UTF-8"?>';
    print "<livros>";

    while ($row = $consulta->fetch(PDO::FETCH_OBJ)) {
        print "<livro>";
        print "<id>$row->id</id>";
        print "<titulo>$row->titulo</titulo>";
        print "<autor>$row->autor</autor>";
        print "<genero>$row->genero</genero>";
        print "<editora>$row->editora</editora>";
        print "<ano_publicacao>$row->ano_publicacao</ano_publicacao>";
        print "<isbn>$row->isbn</isbn>";
        print "<preco>$row->preco</preco>";
        print "<qtdestoque>$row->qtdestoque</qtdestoque>";
        print "</livro>";
    }

    print "</livros>";
}

function listarUmLivroJSON($id) {
    global $ligacao;

    $consulta = $ligacao->prepare("SELECT * FROM bookssociety WHERE id = :id");
    $consulta->bindParam(':id', $id);
    $consulta->execute();

    $livro = $consulta->fetch(PDO::FETCH_ASSOC);

    header('Content-type: application/json');
    echo json_encode($livro);
}

function listarTodosLivrosJSON() {
    global $ligacao;

    $consulta = $ligacao->query("SELECT * FROM bookssociety");

    $livros = array();

    while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $livros[] = $row;
    }

    header('Content-type: application/json');
    echo json_encode($livros);
}

function criarNovoLivroXML($dados) {
    global $ligacao;

    $titulo = $dados['titulo'];
    $autor = $dados['autor'];
    $genero = $dados['genero'];
    $editora = $dados['editora'];
    $ano_publicacao = $dados['ano_publicacao'];
    $isbn = $dados['isbn'];
    $preco = $dados['preco'];
    $qtdestoque = $dados['qtdestoque'];

    header('Content-type: application/xml');
    print '<?xml version="1.0" encoding="UTF-8"?>';
    print "<resposta>";

    try {
        $consulta = $ligacao->prepare("INSERT INTO bookssociety (titulo, autor, genero, editora, ano_publicacao, isbn, preco, qtdestoque) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->execute([$titulo, $autor, $genero, $editora, $ano_publicacao, $isbn, $preco, $qtdestoque]);
        
        if ($consulta->rowCount() > 0) {
            print "<status>Novo livro criado com sucesso!</status>";
        } else {
            print "<status>Erro ao criar o novo livro.</status>";
        }
    } catch (PDOException $e) {
        print "<status>Erro ao criar o novo livro: " . $e->getMessage() . "</status>";
    }

    print "</resposta>";
}

function excluirLivroXML($id) {
    global $ligacao;

    header('Content-type: application/xml');
    print '<?xml version="1.0" encoding="UTF-8"?>';
    print "<resposta>";

    try {
        $consulta = $ligacao->prepare("DELETE FROM bookssociety WHERE id = ?");
        $consulta->execute([$id]);
        
        if ($consulta->rowCount() > 0) {
            print "<status>Livro excluído com sucesso!</status>";
        } else {
            print "<status>Livro não encontrado para exclusão.</status>";
        }
    } catch (PDOException $e) {
        print "<status>Erro ao excluir o livro: " . $e->getMessage() . "</status>";
    }

    print "</resposta>";
}

function criarNovoLivroJSON($dados) {
    global $ligacao;

    $titulo = $dados['titulo'];
    $autor = $dados['autor'];
    $genero = $dados['genero'];
    $editora = $dados['editora'];
    $ano_publicacao = $dados['ano_publicacao'];
    $isbn = $dados['isbn'];
    $preco = $dados['preco'];
    $qtdestoque = $dados['qtdestoque'];

    header('Content-type: application/json');
    print "{";

    try {
        $consulta = $ligacao->prepare("INSERT INTO bookssociety (titulo, autor, genero, editora, ano_publicacao, isbn, preco, qtdestoque) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $consulta->execute([$titulo, $autor, $genero, $editora, $ano_publicacao, $isbn, $preco, $qtdestoque]);
        
        if ($consulta->rowCount() > 0) {
            print '"status": "Novo livro criado com sucesso!"';
        } else {
            print '"status": "Erro ao criar o novo livro."';
        }
    } catch (PDOException $e) {
        print '"status": "Erro ao criar o novo livro: ' . $e->getMessage() . '"';
    }

    print "}";
}

function excluirLivroJSON($id) {
    global $ligacao;

    header('Content-type: application/json');
    print "{";

    try {
        $consulta = $ligacao->prepare("DELETE FROM bookssociety WHERE id = ?");
        $consulta->execute([$id]);
        
        if ($consulta->rowCount() > 0) {
            print '"status": "Livro excluído com sucesso!"';
        } else {
            print '"status": "Livro não encontrado para exclusão."';
        }
    } catch (PDOException $e) {
        print '"status": "Erro ao excluir o livro: ' . $e->getMessage() . '"';
    }

    print "}";
}

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

if ($acao == 'listarUmLivroXML') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id !== null) {
        listarUmLivroXML($id);
    }
} elseif ($acao == 'listarTodosLivrosXML') {
    listarTodosLivrosXML();
} elseif ($acao == 'listarUmLivroJSON') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id !== null) {
        listarUmLivroJSON($id);
    }
} elseif ($acao == 'listarTodosLivrosJSON') {
    listarTodosLivrosJSON();
} elseif ($acao == 'criarNovoLivroXML') {
    $dados = $_GET; // Aqui estou assumindo que os dados são enviados via GET, ajuste conforme necessário
    criarNovoLivroXML($dados);
} elseif ($acao == 'excluirLivroXML') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id !== null) {
        excluirLivroXML($id);
    }
} elseif ($acao == 'criarNovoLivroJSON') {
    $dados = $_GET; // Aqui estou assumindo que os dados são enviados via GET, ajuste conforme necessário
    criarNovoLivroJSON($dados);
} elseif ($acao == 'excluirLivroJSON') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if ($id !== null) {
        excluirLivroJSON($id);
    }
} else {
    homepage();
}

//| 1. Listar um Livro: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=listarUmLivroXML&id=1
//| 2. Listar todos em XML: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=listarTodosLivrosXML 
//| 3. Listar 1 em JSON: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=listarUmLivroJSON&id=1
//| 4. Listar todos em JSON: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=listarTodosLivrosJSON 
//| 5. Criar em XML: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=criarNovoLivroXML&titulo=teste&autor=teste&genero=teste&editora=teste&ano_publicacao=200&isbn=ISBNDoLivro&preco=20&qtdestoque=20
//| 6. Excluir em XML: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=excluirLivroXML&id=ID_DO_LIVRO 
//| 7. Criar em JSON: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=criarNovoLivroJSON&titulo=teste&autor=teste&genero=teste&editora=teste&ano_publicacao=200&isbn=0000&preco=20&qtdestoque=20
//| 8. Excluir em JSON: http://bloomtess.atwebpages.com/5421/ficha6/webservice.php/?acao=excluirLivroJSON&id=ID_DO_LIVRO
?>
