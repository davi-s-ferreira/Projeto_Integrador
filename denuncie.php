<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/Projeto_Integrador/Projeto_Integrador/_confg.php";

$form = [
  "email" => '',
  "senha" => '',
  "cidade" => '',
  "comentario" => ''
];

if (isset($_POST['send'])) :

    $form['email'] = sanitize('email', 'email');
    $form['senha'] = sanitize('senha', 'string');
    $form['cidade'] = sanitize('cidade', 'string');
    $form['comentario'] = sanitize('comentarios', 'string');

    $sql = <<<SQL

  INSERT INTO denuncia (
    denuncia_email,
    denuncia_senha,
    denuncia_cidade,
    denuncia_comentarios
  ) VALUES (
    '{$form['email']}',
    '{$form['senha']}',
    '{$form['cidade']}',
    '{$form['comentario']}'

  );

  SQL;

    $conn->query($sql);

    debug($sql);

endif; // if (isset($_POST['send']))
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

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
              <input type="hidden" name="send" value="true">

              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Endereço de email:</label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="Digite seu email...">
                <div id="emailHelp" class="form-text">Nunca compartilharemos seu e-mail com mais ninguém.</div>
              </div>

              <div class="mb-3">
                <label for="inputPassword4" class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" id="exampleFormControlInput1" placeholder="Digite sua senha..." minlength="8" maxlength="20">
                <div id="passwordHelp" class="form-text">Deve ter de 8 a 20 caracteres.</div>
              </div>

              <div class="mb-3">
                <label for="inputCity" class="form-label">Cidade:</label>
                <input type="text" class="form-control" name="cidade" id="exampleFormControlInput1" placeholder="Digite sua cidade...">
              </div>

              <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="comentarios" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Comentários</label>
                <div id="passwordHelp" class="form-text">Especifique sua denúncia, esta mensagem é 100% privada.</div>
                &nbsp;
              </div>

              <a class="btn btn-success" href="" role="button">Próximo</a>
              <input class="btn btn-danger" type="reset" value="Limpar">
              </form>
          </article>
        </div>
      </div>
    </main>
  

  <footer class="blog-footer">
    <p>© 2022 - Todos os Direitos Reservados
      <br>
      Desenvolvido pela D.W.D Company <a href="https://getbootstrap.com/">Bootstrap</a>
      <a href="https://twitter.com/mdo">@mdo</a>.
    </p>
    <p>
      <a href="denuncie.html">voltar ao topo</a>
    </p>
  </footer>

</body>

</html>