<?php
// Estabelece a conexão com o banco de dados e obtém os usuários
$connection = new Connection();
$users = $connection->query("SELECT * FROM users")->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container mt-5 card">
    <h1 class="text-center mb-4">Lista de Usuários</h1>

    <!-- Botão para abrir o modal de cadastro -->
    <button class="btn btn-success mb-3" style="max-width: 200px;" data-bs-toggle="modal" data-bs-target="#addNewUserModal">Cadastrar Novo Usuário</button>

    <!-- Tabela de usuários -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Cores</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Itera sobre cada usuário e exibe seus dados -->
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user->id) ?></td>
                    <td><?= htmlspecialchars($user->name) ?></td>
                    <td><?= htmlspecialchars($user->email) ?></td>
                    <td>
                        <?php
                        // Obtém as cores associadas ao usuário através de uma consulta SQL
                        $stmt = $connection->prepare("SELECT c.name FROM colors c INNER JOIN user_colors uc ON c.id = uc.color_id WHERE uc.user_id = :user_id");
                        $stmt->bindParam(':user_id', $user->id, PDO::PARAM_INT);
                        $stmt->execute();
                        $userColors = $stmt->fetchAll(PDO::FETCH_COLUMN);
                        // Exibe as cores separadas por vírgula
                        echo implode(', ', $userColors);
                        ?>
                    </td>
                    <td>
                        <!-- Botões de Ação (Editar e Excluir) -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal<?= htmlspecialchars($user->id) ?>">Editar</button>
                        <a href="app/users/delete_user.php?id=<?= htmlspecialchars($user->id) ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modais de Edição -->
<?php foreach ($users as $user): ?>
    <?php
    // Obtém os dados do usuário para preenchimento no modal de edição
    $userId = htmlspecialchars($user->id);
    $userName = htmlspecialchars($user->name);
    $userEmail = htmlspecialchars($user->email);
    ?>
    <!-- Modal de Edição do Usuário -->
    <div class="modal fade" id="editUserModal<?= $userId ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?= $userId ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Inclui o formulário de edição do usuário -->
                <?php include __DIR__ . '/../partes/form_user.php'; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal de Cadastro de Novo Usuário -->
<div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Inclui o formulário de cadastro do usuário -->
            <?php include __DIR__ . '/../partes/form_user.php'; ?>
        </div>
    </div>
</div>
