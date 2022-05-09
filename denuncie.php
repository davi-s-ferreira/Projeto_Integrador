<?php
require '_confg.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeErro = null;
    $senhaErro = null;
    $cidadeErro = null;
    $emailErro = null;
    $comentariosErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['cidade'])) {
            $cidade = $_POST['cidade'];
        } else {
            $cidadeErro = 'Por favor digite o seu endereço!';
            $validacao = False;
        }


        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um endereço de email válido!';
                $validacao = False;
            }
        } else {
            $emailErro = 'Por favor digite um endereço de email!';
            $validacao = False;
        }


        if (!empty($_POST['senha'])) {
            $senha = $_POST['senha'];
        } else {
            $senhaErro = 'Por favor digite uma senha!';
            $validacao = False;
        }

        if (!empty($_POST['comentarios'])) {
            $comentarios = $_POST['comentarios'];
        } else {
            $comentariosErro = 'Por favor digite um comentario!';
            $validacao = False;
        }
    }


//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO denuncia (denuncia_email, denuncia_senha, denuncia_cidade, denuncia_comentarios) VALUES(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array( $cidade, $email, $senha, $comentarios));
        Banco::desconectar();
        header("Location: form.html");
    }
}
?>


<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <link rel="stylesheet" href="style.css">
  <title>Denuncie</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/blog/">



  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="blog.css" rel="stylesheet">
</head>

<body>
  

    <div class="container-fluid p-0 m-0">
      <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
          <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="index.html">Violência Obstrética</a>
          </div>
        </div>
      </header>

      <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
          <a class="p-2 link-secondary" href="index.html">Início</a>
          <a class="p-2 link-secondary" href="Texto.html">Conteúdo</a>
          <a class="p-2 link-secondary" href="legislação.html">Legislação</a>
          <a class="p-2 link-secondary" href="denuncie.html">Denuncie</a>
        </nav>
      </div>
    </div>
    <hr>

    <main class="container">
      <div class="row g-5">
        <div class="col-md-8">

          <article class="blog-post">
            <h2 class="blog-post-title">Denuncie!</h2>
            <p class="blog-post-meta">Cadastre-se para termos acesso as suas informações e entrarmos em contato.<a href="#"></a></p>

            <form action="denuncie.php" method="post">

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Endereço de email:</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Digite seu email..." value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                <div id="emailHelp" class="form-text">Nunca compartilharemos seu e-mail com mais ninguém.</div>
              </div>

              <div class="mb-3">
                <label for="inputPassword4" class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" id="exampleFormControlInput1" placeholder="Digite sua senha..." minlength="8" maxlength="20" value="<?php echo !empty($senha) ? $senha : ''; ?>">
                            <?php if (!empty($senhaErro)): ?>
                                <span class="text-danger"><?php echo $senhaErro; ?></span>
                            <?php endif; ?>
                <div id="passwordHelp" class="form-text">Deve ter de 8 a 20 caracteres.</div>
              </div>

              <div class="mb-3">
                <label for="inputCity" class="form-label">Cidade:</label>
                <input type="text" class="form-control" name="cidade" id="exampleFormControlInput1" placeholder="Digite sua cidade..." value="<?php echo !empty($cidade) ? $cidade : ''; ?>">
                            <?php if (!empty($cidadeErro)): ?>
                                <span class="text-danger"><?php echo $cidadeErro; ?></span>
                            <?php endif; ?>
              </div>

              <div class="form-floating">
                <input class="form-control" placeholder="Leave a comment here" name="comentarios" id="floatingTextarea2" style="height: 100px" value="<?php echo !empty($comentarios) ? $comentarios : ''; ?>">
                            <?php if (!empty($comentariosErro)): ?>
                                <span class="text-danger"><?php echo $comentariosErro; ?></span>
                            <?php endif; ?>
                <label for="floatingTextarea2">Comentários</label>
                <div id="passwordHelp" class="form-text">Especifique sua denúncia, esta mensagem é 100% privada.</div>
                &nbsp;
              </div>
              <button type="submit" class="btn btn-success" role="button">Adicionar</button>
              <input class="btn btn-danger" type="reset" value="Limpar">
              </form>
          </article>
        </div>
      </div>
    </main>
  

    <footer class="blog-footer">
    <p>© 2022 - Todos os Direitos Reservados
      <br>
      Desenvolvido pela D.W.D Company
      <br>
      <a href="https://pt-br.facebook.com/observatoriovobrasil/">Facebook</a>
    </p>
    <p><a href="https://twitter.com/danimontpsol/status/1266116104767836161">Twitter</a></p>
    <p><a href="https://www.instagram.com/_violenciaobstetrica/">Instagram</a></p>
    <p>
      <a href="index.html">voltar ao topo</a>
    </p>
  </footer>

</body>

</html>