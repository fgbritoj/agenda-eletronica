
# Sobre o Phinx

- O Phinx vai ser uma aplicação para rodar migrations;

- Para acessar o banco local é só alterar as configurações no arquivo .env;

- As migrations estarão localizadas na pasta db/migrations;
 

*Comando para rodar o Phinx*

- .\phinx: esse comando quando executado no terminal, consegue acessar as funcionalidades da migration e verificar os comandos;

- Para conseguir criar novas tabelas no banco verifique a documentação do Phinx:
Link: https://book.cakephp.org/phinx/0/en/index.html

# Estrutura de arquivos do sistema

- O projeto seguirá o padrão MVC, com a parte de serviços separada.

- Cada módulo terá seu próprio arquivo nas pastas dentro do diretório `\src`.

-Exemplo: A categoria terá
`src/Controller/CategoryController.php`: Apenas os controles que serão chamados pelas rotas do arquivo routes/app.php.
`src/Models/Category.php`: Serão organizados os getters e setters simulando os dados da base de dados.
`src/Services/CategoryService.php`: Conterão os métodos principais para manipular os dados.

 - Para a parte de visualização que está na pasta `resources/views/pages/`
 - Nesse caminho ficarão os arquivos html das páginas.
 Sempre seguirão o padrão:
 `category_search.html`: Página do filtro de busca do módulo, onde será exibido um grid com os registros e um filtro de busca. 
 `category.html`: Será o formulário de cadastro e atualização."

# Componentes do select no sistema

 *Exemplo do select com as informações do banco*
 
```html

<select-db id-input="Id do input" label="Label do Input" class="w-100" route="/Rota na api" value="{$value.id_value}"></select-db>

```

*Exemplo do select com busca das informações no banco*

```html
<input-select id-input="Id do input" label="Label do Input" class="w-100" value="{$value.name_value}" value_id="{$value.id_value}" route="Rota na api"></input-select>

```






