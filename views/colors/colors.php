<div class="container mt-5 card">
    <h1 class="text-center mb-4">Lista de Cores</h1>

    <!-- Botão para abrir o modal de cadastro de cor -->
    <button class="btn btn-success mb-3" style="max-width: 200px;" data-bs-toggle="modal" data-bs-target="#addColorModal">Cadastrar Nova Cor</button>

    <?php
    // Estabelece a conexão com o banco de dados e obtém todas as cores
    $connection = new Connection();
    $colors = $connection->query("SELECT * FROM colors")->fetchAll(PDO::FETCH_OBJ);
    ?>

    <!-- Tabela que exibe as cores -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Itera sobre cada cor e exibe os dados na tabela -->
            <?php foreach ($colors as $color): ?>
                <tr>
                    <td><?= htmlspecialchars($color->id) ?></td>
                    <td><?= htmlspecialchars($color->name) ?></td>
                    <td>
                        <!-- Botão para editar a cor -->
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editColorModal<?= htmlspecialchars($color->id) ?>">Editar</button>
                        <!-- Botão para excluir a cor -->
                        <a href="app/colors/delete_color.php?id=<?= htmlspecialchars($color->id) ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modais de Edição -->
<?php foreach ($colors as $color): ?>
    <?php
    // Obtém os dados da cor para preencher no modal de edição
    $colorId = htmlspecialchars($color->id);
    $colorName = htmlspecialchars($color->name);
    ?>
    <!-- Modal de Edição da Cor -->
    <div class="modal fade" id="editColorModal<?= $colorId ?>" tabindex="-1" aria-labelledby="editColorModalLabel<?= $colorId ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Inclui o formulário de edição da cor -->
                <?php include __DIR__ . '/../partes/form_color.php'; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal de Cadastro de Cor -->
<div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Inclui o formulário de cadastro de cor -->
            <?php include __DIR__ . '/../partes/form_color.php'; ?>
        </div>
    </div>
</div>
