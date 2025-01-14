<?php
// Inclusão do arquivo de conexão com o banco de dados
require '../../connection.php';

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'name' foi preenchido
    if (empty($_POST['name'])) {
        // Se o campo 'name' estiver vazio, exibe um erro e interrompe a execução
        die('O campo nome é obrigatório.');
    }

    // Recupera o valor do campo 'name' do formulário
    $name = $_POST['name'];

    // Estabelece a conexão com o banco de dados
    $connection = new Connection();
    
    // Query SQL para inserir a nova cor na tabela 'colors'
    $query = "INSERT INTO colors (name) VALUES (:name)";
    
    // Prepara a query para execução
    $stmt = $connection->getConnection()->prepare($query);
    
    // Vincula o parâmetro ':name' ao valor da variável $name
    $stmt->bindParam(':name', $name);
    
    try {
        // Executa a query para inserir a cor
        $stmt->execute();
        
        // Redireciona para a página principal com uma mensagem de sucesso
        header("Location: ../../index.php?success=1&message=Cor cadastrada com sucesso!");
        exit();
    } catch (PDOException $e) {
        // Exibe a mensagem de erro caso ocorra um erro no banco de dados
        echo 'Erro ao inserir cor: ' . $e->getMessage();
    }
}
?>
