<?php

// Exibe erros de PHP para facilitar a depuração durante o desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusão do arquivo de conexão com o banco de dados
require '../../connection.php';

// Verifica se o parâmetro 'id' foi fornecido na URL
if (!isset($_GET['id'])) {
    die("ID do usuário não fornecido.");
}

// Recupera o ID do usuário passado na URL
$id = $_GET['id'];

try {
    // Estabelece a conexão com o banco de dados
    $connection = new Connection();

    // Query para excluir o usuário da tabela 'users' com o ID fornecido
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $connection->getConnection()->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Redireciona para a página principal com uma mensagem de sucesso
    header("Location: ../../index.php?deleted=1&message=Usuário ID: {$id} excluído com sucesso!");
    exit();
} catch (PDOException $e) {
    // Exibe uma mensagem de erro caso ocorra algum problema com a execução da query
    die("Erro ao excluir usuário: " . $e->getMessage());
}
?>
