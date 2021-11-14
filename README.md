# To-do Application
Trabalho final da disciplina de Programação Web.

### Integrantes do grupo
- Everton;
- Fabio;
- Lucas;
- Milena;
- Paola;

### Dependências 
- PHP ^8.0.11;
- SQLite ^3.36.0;

### Instalação
Para iniciar o servidor, digite no terminal:

`php -S localhost:8000 -t .`

### Como utilizar
Cada usuário poderá cadastrar N Listas contanto que o título não seja vazio e nem se repitam.

Para criar uma lista, insira o título da lista desejado e clique em Adicionar.

Para criar novas listas posteriormente, insira um novo título e clique no ícone "+".

 ---
As Listas poderão ser privadas e públicas.

Uma Lista pública será publicada na página /user/public para todos os usuários.

Para publicar ou privar uma lista clique no ícone de visibilidade.

Para deletar uma lista clique no ícone de lixeira (esta ação é irreversível).

---
Cada lista poderá contem N Tarefas contanto que o conteúdo da tarefa não seja vazio e nem se repitam

Para criar uma tarefa, insira o conteúdo e clique no ícone "+".

---
Cada tarefa possui dois estados, "Em andamento" e "Concluída".

Para alterar o estado de cada tarefa, clique no texto respectivo localizado abaixo do conteúdo da mesma.

Para deletar uma tarefa,  clique no ícone de lixeira (esta ação é irreversível).

---
Para visualizar e modificar suas tarefas, clique no ícone de casa e você será redirecionado para a página /user/home.

Para visualizar as listas públicas por você e outros usuários, clique no ícone de globo e você será redirecionado para a página /user/public

Para realizar uma busca pelas suas listas, clique no ícone de bússola e insira o nome da lista que você deseja buscar.

