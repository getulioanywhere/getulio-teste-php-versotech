<form action="<?= isset($userId) ? 'app/users/update_user.php' : 'app/users/add_user.php' ?>" method="POST">
    <?php
    $btnName = 'Cadastrar';
    $titlePage = 'Cadastrar Novo Usuário';
    $selectedColors = [];

    if (isset($userId)):
        $btnName = 'Atualizar';
        $titlePage = 'Atualizar usuário de ID: ' . $userId;

        // Obter as cores vinculadas ao usuário
        $stmt = $connection->prepare("SELECT color_id FROM user_colors WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $selectedColors = $stmt->fetchAll(PDO::FETCH_COLUMN);
    ?>
        <input type="hidden" name="id" value="<?= $userId ?>">
    <?php endif; ?>

    <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel"><?= $titlePage ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($userName) ? $userName : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= isset($userEmail) ? $userEmail : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="colors" class="form-label">Selecione as cores:</label>
            <select class="form-select" id="colors" name="colors[]" multiple>
                <?php
                // Listar todas as cores disponíveis
                $colors = $connection->query("SELECT * FROM colors")->fetchAll(PDO::FETCH_OBJ);
                foreach ($colors as $color):
                    $selected = in_array($color->id, $selectedColors) ? 'selected' : '';
                ?>
                    <option value="<?= $color->id ?>" <?= $selected ?>><?= htmlspecialchars($color->name) ?></option>
                <?php endforeach; ?>
            </select>
            <small>Segure a tecla <b>Ctrl</b> (ou <b>Command</b> no Mac) para selecionar mais de uma cor.</small>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success"><?= $btnName ?></button>
    </div>
</form>
<?php
unset($userId);
unset($userName);
unset($userEmail);
unset($colors);
?>