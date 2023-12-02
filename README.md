# Library API
- A aplicação pode ser acessada a partir do navegador web. Para fazer login, use o nome de usuário admin e a senha admin.

- A página inicial da aplicação exibe uma listagem de todos os livros. Cada livro inclui as seguintes informações:

```
Título
Autor
Gênero
Editora
Ano de publicação
```

- Para visualizar os detalhes de um livro, clique no título do livro.
- Para editar um livro, clique no botão "Editar".
- Para excluir um livro, clique no botão "Excluir".
- Para criar um novo livro, clique no botão "Criar".

- Exibição do clima atual
A aplicação também exibe o clima atual da região do usuário autenticado. Para isso, é utilizado o serviço da API HG Brasil. O clima é exibido na barra lateral da página inicial. As informações exibidas incluem:

```
Temperatura
Umidade
Pressão atmosférica
Velocidade do vento
Direção do vento
```

## Siga os passos:

### Rode o docker compose
Na raiz do projeto faça o seguinte comando para iniciar o serviço:

```
sudo docker-compose up -d
```

### Rode as migrates
```
sudo docker exec -it php_library php spark migrate
```

### Rode os seeds
```
sudo docker exec -it php_library php spark db:seed DatabaseSeeder
```