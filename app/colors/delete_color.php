<?php
// Inclusão do arquivo de conexão com o banco de dados
require '../../connection.php';

// Verifica se o parâmetro 'id' foi passado via URL
if (!isset($_GET['id'])) {
    // Se o ID não foi fornecido, exibe um erro e interrompe a execução
    die('ID da cor não foi especificado.');
}

// Estabelece a conexão com o banco de dados
$connection = new Connection();

// Recupera o ID da cor a ser excluída
$id = $_GET['id'];

// Prepara a query SQL para excluir a cor com o ID fornecido
$query = "DELETE FROM colors WHERE id = :id";

// Prepara a execução da query
$stmt = $connection->getConnection()->prepare($query);

// Vincula o parâmetro ':id' ao valor do ID recuperado da URL
$stmt->bindParam(':id', $id);

try {
    // Executa a query para excluir a cor
    $stmt->execute();

    // Redireciona para a página principal com a mensagem de sucesso
    header("Location: ../../index.php?deleted=1&message=Cor ID: {$id} excluída com sucesso!");
    exit();
} catch (PDOException $e) {
    // Em caso de erro, exibe a mensagem de erro gerada pela exceção
    die('Erro ao excluir a cor: ' . $e->getMessage());
}
?>
