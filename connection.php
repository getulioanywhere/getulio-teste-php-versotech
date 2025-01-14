<?php

class Connection {

    // Caminho do arquivo do banco de dados SQLite
    private $databaseFile;
    // Variável para armazenar a conexão PDO
    private $connection;

    // Construtor da classe, é chamado quando a classe é instanciada
    public function __construct()
    {
        // Definindo o caminho absoluto do arquivo de banco de dados
        $this->databaseFile = realpath(__DIR__ . "/database/db.sqlite");
        // Estabelecendo a conexão com o banco de dados
        $this->connect();
    }

    // Método privado que estabelece a conexão com o banco de dados
    private function connect()
    {
        try {
            // Cria a conexão PDO com o banco de dados SQLite
            $this->connection = new PDO("sqlite:{$this->databaseFile}");
            // Configura o modo de erro para lançar exceções em caso de falhas
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Se houver um erro de conexão, exibe a mensagem de erro
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }

    // Método público para obter a conexão com o banco de dados
    public function getConnection()
    {
        // Se a conexão já estiver estabelecida, retorna ela; caso contrário, chama o método 'connect' para criar a conexão
        return $this->connection ?: $this->connect();
    }

    // Método para executar uma consulta SQL e retornar o resultado
    public function query($query)
    {
        // Executa a consulta SQL e obtém o resultado
        $result = $this->getConnection()->query($query);
        // Define o modo de busca para que os resultados sejam mapeados para objetos stdClass
        $result->setFetchMode(PDO::FETCH_INTO, new stdClass);
        return $result;
    }

    // Método para preparar uma consulta SQL para execução
    public function prepare($query)
    {
        // Retorna a consulta preparada para que os parâmetros possam ser vinculados posteriormente
        return $this->getConnection()->prepare($query);
    }
}
?>
