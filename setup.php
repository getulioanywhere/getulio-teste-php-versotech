<?php
/*
 * EXECUTA A CRIAÇÃO DAS TABELAS E INSERI DADOS CONFORME OS ARQUIVOS DOS DIRETÓRIOS:
 * migrations\
 * seeds\
 */

try {
    // Conexão com o SQLite
    $pdo = new PDO('sqlite:database/db.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexão com o banco de dados SQLite estabelecida.\n";

    // Função para executar arquivos SQL
    function executeSqlFile(PDO $pdo, string $filePath) {
        if (file_exists($filePath)) {
            $sql = file_get_contents($filePath);
            $pdo->exec($sql);
            echo "Executado: $filePath\n";
        } else {
            echo "Arquivo não encontrado: $filePath\n";
        }
    }

    // Executar migrações
    echo "Executando migrações...\n";
    $migrations = glob(__DIR__ . '/migrations/*.sql');
    foreach ($migrations as $migration) {
        executeSqlFile($pdo, $migration);
    }

    // Executar seeds
    echo "Inserindo dados iniciais...\n";
    $seeds = glob(__DIR__ . '/seeds/*.sql');
    foreach ($seeds as $seed) {
        executeSqlFile($pdo, $seed);
    }

    echo "Configuração concluída com sucesso.\n";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
