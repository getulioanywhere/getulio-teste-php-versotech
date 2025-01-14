<?php

// Exibe erros de PHP para facilitar a depuração durante o desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusão do arquivo de conexão com o banco de dados
require '../../connection.php';

// Verifica se a requisição foi feita por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $id = $_POST['id'] ?? '';  // ID do usuário
    $name = $_POST['name'] ?? '';  // Nome do usuário
    $email = $_POST['email'] ?? '';  // Email do usuário
    $colors = $_POST['colors'] ?? [];  // Cores associadas ao usuário

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (!empty($id) && !empty($name) && !empty($email)) {
        try {
            // Estabelece a conexão com o banco de dados
            $connection = new Connection();

            // Atualiza os dados do usuário na tabela 'users'
            $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
            $stmt = $connection->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Limpa as cores associadas ao usuário antes de inserir as novas
            $queryDeleteColors = "DELETE FROM user_colors WHERE user_id = :user_id";
            $stmtDelete = $connection->getConnection()->prepare($queryDeleteColors);
            $stmtDelete->bindParam(':user_id', $id, PDO::PARAM_INT);
            $stmtDelete->execute();

            // Insere as novas cores associadas ao usuário
            if (!empty($colors)) {
                $queryInsertColors = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
                $stmtColors = $connection->getConnection()->prepare($queryInsertColors);
                foreach ($colors as $colorId) {
                    $stmtColors->bindParam(':user_id', $id, PDO::PARAM_INT);
                    $stmtColors->bindParam(':color_id', $colorId, PDO::PARAM_INT);
                    $stmtColors->execute();
                }
            }

            // Redireciona para a página principal com uma mensagem de sucesso
            header("Location: ../../index.php?success=1&message=Usuário ID: {$id} atualizado com sucesso!");
            exit();
        } catch (PDOException $e) {
            // Exibe uma mensagem de erro caso algo dê errado com a execução da query
            echo "Erro ao atualizar usuário: " . $e->getMessage();
        }
    } else {
        // Exibe uma mensagem de erro caso os campos obrigatórios não sejam preenchidos
        echo "Todos os campos são obrigatórios!";
    }
}
?>
