<!--<form action="app/colors/save_color.php" method="POST">-->
    
     <form action="<?= isset($colorId) ? 'app/colors/update_color.php' : 'app/colors/add_color.php' ?>" method="POST">

    <?php
    $btnName = 'Cadastrar';
    $titlePage = 'Cadastrar Nova Cor';
    if (isset($colorId)):
        $btnName = 'Atualizar';
        $titlePage = 'Atualizar cor de ID: ' . $colorId;
        ?>
        <input type="hidden" name="id" value="<?= $colorId ?>">
        <?php
    endif;
    ?>
    <div class="modal-header">
        <h5 class="modal-title" id="addColorModalLabel"><?= $titlePage ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="color_name" class="form-label">Nome da Cor</label>
            <input type="text" class="form-control" id="color_name" name="name" value="<?= isset($colorName) ? $colorName : '' ?>" required>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success"><?= $btnName ?></button>
    </div>
</form>
<?php
unset($colorId);
unset($colorName);
?>