<?php if (isset($_GET['deleted'])): ?>
    <!-- Exibe uma mensagem de erro se a chave 'deleted' estiver presente na URL -->
    <div class="alert alert-danger"><?= $_GET['message'] ?></div>
<?php endif; ?>

<?php if (isset($_GET['updated']) || isset($_GET['success'])): ?>
    <!-- Exibe uma mensagem de sucesso se as chaves 'updated' ou 'success' estiverem presentes na URL -->
    <div class="alert alert-success"><?= $_GET['message'] ?></div>
<?php endif; ?>
