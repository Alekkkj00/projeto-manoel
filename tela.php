<?php
// Estas variáveis só escolhem os textos e os campos da tela.
$cadastro = ($tela === 'cadastro');
$logado = ($tela === 'painel');
$nomeSeguro = htmlspecialchars($_SESSION['nome'] ?? '', ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#090e18"><meta name="description" content="Entre no universo de ECLIPSE: Crônicas do Reino Perdido. Um reino esquecido aguarda o seu retorno.">
  <title>ECLIPSE — Crônicas do Reino Perdido</title>
  <link rel="icon" href="assets/sigil.svg" type="image/svg+xml">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="<?= $cadastro ? 'registering' : ($logado ? 'authenticated' : '') ?>">
  <div class="landscape" aria-hidden="true"></div><div class="vignette" aria-hidden="true"></div><div class="motes" aria-hidden="true"></div>
  <header class="topbar">
    <a class="brand" href="./" aria-label="Eclipse, início"><img src="assets/sigil.svg" alt="" width="35" height="35"><span>ECLIPSE<small>CRÔNICAS DO REINO PERDIDO</small></span></a>
    <nav aria-label="Navegação principal"><button class="text-button" id="about-button">O universo de Valdoria <span aria-hidden="true">↗</span></button><span class="alpha"><i></i> EM DESENVOLVIMENTO</span></nav>
  </header>
  <main>
    <section class="world-copy" aria-labelledby="world-heading">
      <div class="eyebrow"><span></span> UM REINO. SETE CRISTAIS. SEU DESTINO.</div>
      <h1 id="world-heading">Até a última luz.<br><em>Além da escuridão.</em></h1>
      <p>Os portões de Valdoria voltarão a se abrir.<br>Escreva seu nome na história que está por vir.</p>
      <div class="world-caption"><span class="tiny-diamond">✧</span><span>VALDORIA, O REINO PERDIDO<small>Onde a luz e as sombras guardam o mesmo segredo.</small></span></div>
    </section>
    <section class="portal" aria-label="Portal do jogador">
      <div class="portal-ornament" aria-hidden="true"><span></span>◇<span></span></div>
      <?php if (!$logado): ?>
      <div id="auth-view">
        <p class="eyebrow center">SUA JORNADA COMEÇA AQUI</p>
        <h2 id="form-title"><?= $cadastro ? 'Seu nome. Sua lenda.' : 'O reino espera por você.' ?></h2><p class="intro" id="form-intro"><?= $cadastro ? 'Crie sua conta e faça parte desta história.' : 'Entre e prepare-se para o próximo capítulo.' ?></p>
        <div class="tabs" role="tablist" aria-label="Acesso à conta"><button id="login-tab" role="tab" aria-selected="<?= $cadastro ? 'false' : 'true' ?>" aria-controls="auth-form" type="button">Entrar</button><button id="register-tab" role="tab" aria-selected="<?= $cadastro ? 'true' : 'false' ?>" aria-controls="auth-form" type="button">Criar conta</button></div>
        <form id="auth-form" action="<?= $cadastro ? 'cadastro.php' : 'login.php' ?>" method="post" aria-labelledby="form-title">
          <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
          <?php if ($cadastro): ?>
          <div id="username-field"><label for="username">Nome de aventureiro</label><div class="input-wrap"><span aria-hidden="true">♙</span><input id="username" name="nome" required autocomplete="nickname" minlength="3" maxlength="24" pattern="[A-Za-z0-9_]{3,24}" placeholder="Como será lembrado?"></div><small class="field-help">3–24 letras, números ou _. Este será seu nome no portal.</small></div>
          <?php endif; ?>
          <div id="email-field"><label for="email">Seu e-mail</label><div class="input-wrap"><svg aria-hidden="true" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 6 9 7 9-7"/></svg><input id="email" name="email" type="email" autocomplete="email" placeholder="aventureiro@exemplo.com" maxlength="254" required></div></div>
          <div id="password-field"><label for="password">Sua senha</label><div class="input-wrap"><svg aria-hidden="true" viewBox="0 0 24 24"><rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V6a4 4 0 0 1 8 0v4M12 14v3"/></svg><input id="password" name="senha" type="password" autocomplete="<?= $cadastro ? 'new-password' : 'current-password' ?>" placeholder="Digite sua senha" maxlength="72" required><button class="eye" type="button" id="toggle-password" aria-label="Mostrar senha" aria-pressed="false"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg></button></div></div>
          <?php if ($cadastro): ?>
          <div id="confirm-field"><label for="confirm-password">Confirme sua senha</label><div class="input-wrap"><span aria-hidden="true">⌁</span><input id="confirm-password" name="confirmacao" required type="password" autocomplete="new-password" placeholder="Repita sua senha" maxlength="72"></div></div>
          <?php endif; ?>
          <?php if ($mensagem !== ''): ?>
          <p class="feedback" role="status"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></p>
          <?php endif; ?>
          <button type="submit" class="primary" id="submit-button"><span id="submit-label"><?= $cadastro ? 'Criar minha conta' : 'Entrar no reino' ?></span><span aria-hidden="true">→</span></button>
        </form>
        <div class="trust-line" id="trust-line"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="m12 3 8 3v6c0 5-8 9-8 9s-8-4-8-9V6Z"/><path d="m8 12 3 3 5-6"/></svg><span>Seu próximo capítulo começa com uma conta segura.</span></div>
        <div class="dev-note"><span class="note-icon" aria-hidden="true">✧</span><div><strong>Uma nova história está sendo escrita.</strong><p>O jogo está em desenvolvimento. Crie sua conta e esteja pronto para a próxima atualização.</p></div></div>
      </div>
      <?php else: ?>
      <div id="player-view">
        <div class="player-seal" aria-hidden="true">✧</div><p class="eyebrow center">BEM-VINDO A VALDORIA</p><h2 id="welcome-title">Saudações, <?= $nomeSeguro ?>.</h2><p class="intro">Sua história está apenas começando.</p>
        <div class="development"><span class="status-tag"><i></i> EM DESENVOLVIMENTO</span><h3>O reino está despertando.</h3><p>O jogo está em desenvolvimento. Na próxima atualização, haverá conteúdo para jogar.</p><p class="muted">Seu cadastro já faz parte desta jornada. Nos vemos em Valdoria.</p></div>
        <div class="account-row"><span class="account-avatar" id="account-avatar"><?= substr($nomeSeguro, 0, 1) ?></span><div><strong id="player-name"><?= $nomeSeguro ?></strong><small>Aventureiro de Valdoria</small></div><span class="online-dot" title="Conectado"></span></div>
        <form action="sair.php" method="post">
          <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
          <button type="submit" class="secondary">Sair da conta <span aria-hidden="true">↗</span></button>
        </form>
      </div>
      <?php endif; ?>
      <div class="portal-bottom" aria-hidden="true"><span></span>✦<span></span></div>
    </section>
  </main>
  <footer><span>© 2026 ECLIPSE <span class="footer-separator">/</span> Crônicas do Reino Perdido</span><div><span class="version">PRÉ-ALPHA · v0.1</span><button id="fullscreen-button" class="icon-button" aria-label="Ativar tela cheia" title="Tela cheia">⛶</button></div></footer>
  <dialog id="about-dialog" aria-labelledby="about-title"><button id="fechar-historia" class="close" aria-label="Fechar">×</button><p class="eyebrow">AS CRÔNICAS DE VALDORIA</p><h2 id="about-title">Sete cristais.<br>Um reino esquecido.</h2><p>Há 700 anos, um eclipse sobrenatural rompeu o Selo Celestial. Os sete cristais que protegiam Valdoria foram espalhados, e as sombras tomaram o continente.</p><p>Entre vilas esquecidas e florestas corrompidas, uma nova história aguarda para ser contada.</p><p class="dialog-note">A aventura ainda está em desenvolvimento. A criação de personagens e o mundo jogável chegarão em futuras atualizações.</p><button id="voltar-portal" class="primary close-dialog">Voltar ao portal <span>→</span></button></dialog>
  <script src="assets/script.js" defer></script>
</body>
</html>
