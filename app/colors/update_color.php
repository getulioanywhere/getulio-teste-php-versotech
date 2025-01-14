<?php
// Inclusão do arquivo de conexão com o banco de dados
require '../../connection.php';

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos obrigatórios 'id' e 'name' foram preenchidos
    if (empty($_POST['id']) || empty($_POST['name'])) {
        // Se algum dos campos estiver vazio, exibe uma mensagem de erro e interrompe a execução
        die('Todos os campos são obrigatórios.');
    }

    // Recupera os valores dos campos do formulário
    $id = $_POST['id'];
    $name = $_POST['name'];

    // Estabelece a conexão com o banco de dados
    $connection = new Connection();

    // Prepara a query SQL para atualizar o nome da cor no banco de dados
    $query = "UPDATE colors SET name = :name WHERE id = :id";
    $stmt = $connection->getConnection()->prepare($query);

    // Vincula os parâmetros da query com os valores fornecidos pelo usuário
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);

    try {
        // Executa a query para atualizar a cor
        $stmt->execute();

        // Após a execução bem-sucedida, redireciona com a mensagem de sucesso
        header("Location: ../../index.php?updated=1&message=Cor ID: {$id} atualizada com sucesso!");
        exit();
    } catch (PDOException $e) {
        // Se ocorrer um erro ao executar a query, exibe a mensagem de erro
        die('Erro ao atualizar a cor: ' . $e->getMessage());
    }
}
?>
