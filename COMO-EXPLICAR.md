# Roteiro para apresentar

## 1. Mostrar o formulário

“O usuário preenche nome, e-mail e senha. O formulário tem `method="post"` e envia esses dados para `cadastro.php`. Os nomes dos campos no HTML aparecem no `$_POST` do PHP.”

Abra o `tela.php` e mostre `action`, `method` e `name` nos campos.

## 2. Mostrar o CREATE

“O PHP recebe os dados e confere se o e-mail é válido e se as senhas são iguais. Depois transforma a senha em um hash e cadastra uma linha no banco.”

Abra o `cadastro.php` e siga os comentários numerados de 1 a 5. O trecho principal é:

```php
$sql = 'INSERT INTO public.usuarios_escola (nome, email, senha) VALUES (:nome, :email, :senha)';
$comando = $pdo->prepare($sql);
$comando->execute(['nome' => $nome, 'email' => $email, 'senha' => $senhaProtegida]);
```

- `INSERT INTO`: insere um novo cadastro.
- `:nome`, `:email`, `:senha`: espaços reservados para os valores.
- `prepare`: prepara o SQL.
- `execute`: envia os valores e executa a gravação.

O Create do CRUD significa criar um registro. Não é preciso executar `CREATE TABLE` a cada cadastro: a tabela é criada uma vez na instalação.

## 3. Provar que salvou

Cadastre uma conta durante a apresentação. Depois abra o Table Editor do Supabase ou execute:

```sql
SELECT id, nome, email FROM public.usuarios_escola;
```

“A linha existe no banco. Não é apenas um nome que apareceu na tela.”

## 4. Explicar o login e a sessão

Abra `login.php`.

“O `SELECT` encontra o usuário pelo e-mail. `password_verify` confere a senha digitada com o hash salvo. Se estiver correta, guardamos o ID e o nome na sessão.”

Abra `painel.php`.

“A sessão lembra quem entrou. Se não houver um ID na sessão, o PHP manda o visitante de volta ao login. Quem está conectado vê seu nome e o aviso de desenvolvimento.”

Abra `sair.php`.

“Ao sair, apagamos a sessão.”

## Divisão sugerida

Uma pessoa explica o formulário, outra mostra a conexão e o `INSERT`, outra prova o cadastro no banco e outra explica login/sessão. O JavaScript é independente desse processo e serve apenas para os botões da interface.
