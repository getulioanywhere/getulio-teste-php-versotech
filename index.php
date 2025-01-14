<?php
// Inclui o arquivo do cabeçalho, que pode conter as tags HTML iniciais, links de estilos e configurações padrão da página
include __DIR__ . '/views/partes/header.php';

// Inclui o arquivo de conexão com o banco de dados para que as operações de banco possam ser realizadas
require __DIR__ . '/connection.php';
?>

<!-- Container principal que centraliza o conteúdo e aplica margens no topo -->
<div class="container">

    <div class="row">
        <!-- Inclui o arquivo responsável por exibir mensagens de sucesso ou erro, geralmente relacionado a operações realizadas -->
        <?php include __DIR__ . '/views/partes/messages.php'; ?>

        <!-- Coluna maior da página para exibir a lista e gerenciamento de usuários -->
        <div class="col-md-8">
            <!-- Inclui a view responsável por listar os usuários cadastrados -->
            <?php include __DIR__ . '/views/users/users.php'; ?>
        </div>

        <!-- Coluna menor da página para exibir e gerenciar as cores -->
        <div class="col-md-4">
            <!-- Inclui a view responsável por listar e adicionar cores -->
            <?php include __DIR__ . '/views/colors/colors.php'; ?>
        </div>

    </div>
</div>

<!-- Inclui o arquivo do rodapé, que pode conter scripts, informações adicionais ou tags de fechamento -->
<?php include __DIR__ . '/views/partes/footer.php'; ?>
