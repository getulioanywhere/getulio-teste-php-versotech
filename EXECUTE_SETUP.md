# Script de Configuração do Banco de Dados SQLite

Este script PHP automatiza a criação de tabelas e a inserção de dados iniciais no banco de dados SQLite, utilizando arquivos SQL armazenados nos diretórios `migrations/` e `seeds/`.

## Requisitos
- Ter no local o sqlite3 instalado
- PHP 8.3 ou superior
- Banco de dados SQLite (será criado automaticamente no caminho `database/db.sqlite`)
- Arquivos SQL para migrações e seeds devem estar presentes nos diretórios `migrations/` e `seeds/` respectivamente.

## Funcionalidade

1. **Conexão com o banco de dados SQLite**:
   O script estabelece uma conexão com um banco de dados SQLite localizado em `database/db.sqlite`.

2. **Execução de migrações**:
   O script executa todas as migrações encontradas no diretório `migrations/`. As migrações geralmente contêm comandos SQL para a criação de tabelas, índices e outras estruturas do banco de dados.

3. **Inserção de dados iniciais (Seeds)**:
   O script insere dados iniciais no banco de dados, executando os arquivos SQL localizados no diretório `seeds/`.

4. **Mensagens de status**:
   Durante a execução, o script exibe mensagens informando o andamento do processo, incluindo a execução de migrações e a inserção de seeds.

## Como Usar

1. **Preparação do ambiente**:
   Certifique-se de ter o PHP instalado e funcionando corretamente em seu ambiente local. O script irá criar um banco de dados SQLite, caso ele não exista.

2. **Estrutura de diretórios**:
   O script espera que os diretórios `migrations/` e `seeds/` existam e contenham arquivos SQL.

   - **migrations/**: Deve conter arquivos SQL com comandos para criação de tabelas e modificações no esquema do banco de dados.
   - **seeds/**: Deve conter arquivos SQL com comandos `INSERT` para preencher o banco de dados com dados iniciais.

3. **Executando o Script**:
   - Acesse o diretório raiz do projeto.
   - Certifique-se de que os diretórios `migrations/` e `seeds/` estejam configurados com os arquivos necessários.
   - Execute o script no terminal:

```
   php setup.php
```

