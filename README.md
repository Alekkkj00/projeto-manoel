# ECLIPSE — versão para trabalho de escola

Esta versão mantém o visual e usa **PHP simples, formulários HTML e uma tabela**. Faz cadastro, login, sessão e logout. Depois de entrar, mostra o nome do jogador e o aviso de desenvolvimento.

O formulário funciona sem JavaScript. O JavaScript só troca a página de login/cadastro, mostra a senha e controla a janela da história e a tela cheia. Não há classes, frameworks, API JSON, Fetch, Composer ou Node.js para executar o projeto.

## Instalar

1. Copie a pasta do ZIP para `C:\xampp\htdocs\eclipse-escola`.
2. No Supabase, execute **somente `banco/database.sql`** no SQL Editor. Ele cria a tabela `usuarios_escola` sem alterar as tabelas anteriores.
3. Abra `conexao.php`. Preencha o host, usuário e senha exibidos em **Supabase → Connect → Session pooler**, usando a porta **5432**. O usuário normalmente é `postgres.zqjhxobjizcjwzuyykgc`. Use a senha do banco, não a chave pública `anon`.
4. No `php.ini` do XAMPP, habilite `extension=pdo_pgsql` e reinicie o Apache. Não precisa iniciar MySQL: o banco é PostgreSQL no Supabase.
5. Abra **http://localhost/eclipse-escola/**. Crie uma conta e depois faça login.

Se o banco não conectar, confira os dados em `conexao.php` e se a extensão foi habilitada. Não compartilhe a senha do banco no chat ou em repositório público.

## O que cada arquivo faz

| Arquivo | Explicação |
|---|---|
| `index.php` | Escolhe entre login e cadastro. |
| `tela.php` | Contém o HTML do visual, reaproveitado nas telas. |
| `conexao.php` | Conecta o PHP ao banco usando PDO. |
| `cadastro.php` | Recebe os dados, confere e executa o `INSERT`. |
| `login.php` | Busca o e-mail e confere a senha. |
| `painel.php` | Só abre para quem entrou na conta. |
| `sair.php` | Encerra a sessão. |
| `inicio.php` | Inicia a sessão, cria o token do formulário e guarda mensagens. |
| `assets/script.js` | Cuida apenas dos pequenos controles da tela. |

O **Create do CRUD** acontece no `cadastro.php`, com o comando **`INSERT INTO`**. O **`CREATE TABLE`** do arquivo SQL cria a tabela que recebe esses cadastros. São duas etapas diferentes.

As proteções básicas também estão comentadas: `prepare`/`execute` separam os dados do SQL; `password_hash` protege a senha; `password_verify` confere a senha; `htmlspecialchars` mostra textos com segurança. O token oculto confere se o formulário pertence à sessão atual.

Para manter a apresentação curta, esta versão não inclui recuperação por e-mail, acesso lembrado por 30 dias nem os sistemas futuros do RPG. O fluxo é cadastrar → entrar → ver a mensagem → sair.

## Banco completo do jogo

O SQL anterior foi preservado em `referencia/banco-completo-do-jogo.sql`, caso vocês continuem o RPG depois. **Ele não é necessário para esta demonstração.** O código escolar usa apenas `usuarios_escola`.

Guarde o ZIP e os SQLs para preservar o código e a estrutura. Esses arquivos não contêm os usuários que serão cadastrados depois; para guardar esses dados, faça também uma exportação do banco.

Veja `COMO-EXPLICAR.md` para dividir a apresentação entre o grupo.
