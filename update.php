<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $emailErro = null;
    $senhaErro = null;
    $cidadeErro = null;
    $comentariosErro = null;

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cidade = $_POST['cidade'];
    $comentarios = $_POST['comentarios'];

    //Validação
    $validacao = true;
    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }
    
    
    if (empty($senha)) {
        $senhaErro = 'Por favor digite a sua Senha!';
        $validacao = false;
    }


    if (empty($cidade)) {
        $cidadeErro = 'Por favor digite a sua Cidade!';
        $validacao = false;
    }


    if (empty($comentarios)) {
        $comentariosErro = 'Por favor digite um Comentário';
        $validacao = false;
    }


    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios  set email = ?, senha = ?, cidade = ?, comentarios = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($email, $senha, $cidade, $comentarios, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM usuarios where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $email = $data['email'];
    $senha = $data['senha'];
    $cidade = $data['cidade'];
    $comentarios = $data['comentarios'];
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- using new bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Atualizar Contato</title>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Atualizar Contato </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">


                <div class="control-group <?php echo !empty($emailErro) ? 'error' : ''; ?>">
                        <label class="control-label">E-mail</label>
                        <div class="controls">
                            <input name="email" class="form-control" size="40" type="text" placeholder="Email"
                                   value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="control-group <?php echo !empty($senhaErro) ? 'error' : ''; ?>">
                        <label class="control-label">Senha</label>
                        <div class="controls">
                            <input name="senha" class="form-control" size="40" type="password" placeholder="senha"
                                   value="<?php echo !empty($senha) ? $senha : ''; ?>">
                            <?php if (!empty($senhaErro)): ?>
                                <span class="text-danger"><?php echo $senhaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($cidadeErro) ? 'error' : ''; ?>">
                        <label class="control-label">Cidade</label>
                        <div class="controls">
                            <input name="cidade" class="form-control" size="50" type="text" placeholder="cidade"
                                   value="<?php echo !empty($cidade) ? $cidade : ''; ?>">
                            <?php if (!empty($cidadeErro)): ?>
                                <span class="text-danger"><?php echo $cidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($comentariosErro) ? 'error' : ''; ?>">
                        <label class="control-label">Comentários</label>
                        <div class="controls">
                            <input name="comentarios" class="form-control" size="80" type="text" placeholder="comentarios"
                                   value="<?php echo !empty($comentarios) ? $comentarios : ''; ?>">
                            <?php if (!empty($comentariosErro)): ?>
                                <span class="text-danger"><?php echo $comentariosErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>