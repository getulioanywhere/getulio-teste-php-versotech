<?php

// Exibe erros de PHP para facilitar a depuração durante o desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusão do arquivo de conexão com o banco de dados
require '../../connection.php';

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $colors = $_POST['colors'] ?? [];

    // Verifica se os campos obrigatórios não estão vazios
    if (!empty($name) && !empty($email)) {
        try {
            // Estabelece a conexão com o banco de dados
            $connection = new Connection();

            // Query para inserir o novo usuário na tabela 'users'
            $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Recupera o ID do último usuário inserido
            $userId = $connection->getConnection()->lastInsertId();

            // Se cores foram selecionadas, associa o usuário com as cores
            if (!empty($colors)) {
                $queryColors = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
                $stmtColors = $connection->getConnection()->prepare($queryColors);
                foreach ($colors as $colorId) {
                    // Associa o usuário com as cores selecionadas
                    $stmtColors->bindParam(':user_id', $userId, PDO::PARAM_INT);
                    $stmtColors->bindParam(':color_id', $colorId, PDO::PARAM_INT);
                    $stmtColors->execute();
                }
            }

            // Redireciona para a página principal com uma mensagem de sucesso
            header("Location: ../../index.php?success=1&message=Usuário cadastrado com sucesso!");
            exit();
        } catch (PDOException $e) {
            // Exibe uma mensagem de erro caso ocorra algum problema com a execução da query
            echo "Erro ao adicionar usuário: " . $e->getMessage();
        }
    } else {
        // Exibe um erro caso algum campo obrigatório esteja vazio
        echo "Todos os campos são obrigatórios!";
    }
}
