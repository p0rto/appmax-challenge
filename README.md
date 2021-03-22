## Appmax Challenge
Sistema de Gerenciamento de Estoque, simples e fácil.

### Versões
- Laravel: 7.30.4
- PHP: 7.2.19
- MySQL: 5.7.24

### Instalando
Após clonar o projeto, rodar os comandos ``npm install`` e ``composer install`` para instalação das dependências.

### Iniciando o projeto
Crie um arquivo ``.env`` na raiz do projeto, colando o conteúdo que está dentro do arquivo ``.env.example`` e rode o comando ``php artisan key:generate`` para gerar a chave do projeto.

### Migrations e Seeds
Para criar e popular as estruturas do banco de dados, rode os comandos ``php artisan migrate`` e ``php artisan db:seed``.

### Tabelas do Banco de Dados
#### products
- id: BIGINT,
- sku: VARCHAR/255,
- name: VARCHAR/255,
- price: DOUBLE,
- created_at: TIMESTAMP,
- updated_at: TIMESTAMP,
- deleted_at: TIMESTAMP

### stocks
- id: BIGINT,
- product_id: BIGINT FK (products),
- quantity: INT,
- created_at: TIMESTAMP,
- updated_at: TIMESTAMP,
- deleted_at: TIMESTAMP

### historics
- id: BIGINT,
- stock_id: BIGINT FK (stocks),
- operation: TINYINT,
- action_origin: TINYINT,
- created_at: TIMESTAMP,
- updated_at: TIMESTAMP,
- deleted_at: TIMESTAMP

### Login
Após as seeds rodarem, será criado, na tabela ``users`` um único usuário que será utilizado para logar no sistema. O e-mail será <b>testeappmax@appmax.com</b> e a senha <b>appmax</b>

### Funcionalidades
O sistema consiste basicamente de três entidades: ``Produtos``, ``Estoques`` e ``Historicos``.

#### Produtos
Na tela de produtos, é possível criar/editar/deletar itens que poderão ser adicionados ao estoque. Os SKU's são únicos.

#### Estoques
Na tela de estoques, são listados todos os produtos que estão em estoque, juntamente com a quantidade em estoque. É possível criar novos estoques para produtos ainda não estão em estoque, assim como deletar um estoque ou editar sua quantidade e/ou produto relacionado.

#### Historicos/Relatorios
Existem dois relatórios no sistema, o primeiro mostrando todas as entradas/adições nos estoques, e o segundo todas as saídas/diminuições nos estoques.

##### Adições
Cada vez que um novo estoque é criado, é gravado um registro na tabela de historicos, constando o id do estoque e a quantidade adicionada, juntamente com a ``operation`` de adição relacionada, e a ``action_origin`` de sistema ou API, a depender da origem da ação. Se uma edição for feita no estoque, aumentando essa quantidade inicial, será criado um novo registro na tabela de historicos, informando essa diferença adicionada.

##### Remoções
Se um estoque for deletado, será criado um registro na tabela de historicos, constando o id do estoque e a quantidade total retirada, juntamente com a ``operation`` de remoção relacionada, e a ``action_origin`` de sistema ou API, a depender da origem da ação. Se o estoque for editado, e a sua quantidade for menor do que a atual, o mesmo processo será gravado na tabela de historicos.

### API
Existem duas rotas disponíveis, abertas, que irão interagir com o estoque:

#### /api/decrease-stock (PUT)
A chamada irá diminuir a quantidade em um determinado estoque. Esta rota espera, no body da requisição, 2 parâmetros obrigatórios: ``sku`` e ``quantity``. O SKU informado precisa ser valido (de um produto existente) e este produto deve estar vinculado a um estoque. A quantidade informada não pode ser maior do que a quantidade em estoque.
- Exemplo de requisição:
- ![image](https://user-images.githubusercontent.com/70228491/111939831-0e11fd00-8aac-11eb-838f-75ff0fedd5cb.png)
- Exemplo de resposta:
- ![image](https://user-images.githubusercontent.com/70228491/111939870-2255fa00-8aac-11eb-8144-dc6b31bc3973.png)

#### /api/increase-stock (PUT)
A chamada irá diminuir a quantidade em um determinado estoque. Esta rota espera, no body da requisição, 2 parâmetros: ``sku`` e ``quantity``. O SKU informado precisa ser valido (de um produto existente) e este produto deve estar vinculado a um estoque.
- Exemplo de requisição:
- ![image](https://user-images.githubusercontent.com/70228491/111939956-55988900-8aac-11eb-80c9-2e0691a481f0.png)
- Exemplo de resposta:
- ![image](https://user-images.githubusercontent.com/70228491/111939985-63e6a500-8aac-11eb-8602-ff4beb240968.png)


