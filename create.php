
<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailErro = null;
    $senhaErro = null;
    $cidadeErro = null;
    $comentariosErro = null;


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


    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['senha'])) {
            $senha = $_POST['senha'];
        } else {
            $senhaErro = 'Por favor digite a sua Senha!';
            $validacao = False;
        }


        if (!empty($_POST['cidade'])) {
            $cidade = $_POST['cidade'];
        } else {
            $cidadeErro = 'Por favor digite a sua Cidade!';
            $validacao = False;
        }


        if (!empty($_POST['comentarios'])) {
            $comentarios = $_POST['comentarios'];
        } else {
            $comentariosErro = 'Por favor digite um Comentário!';
            $validacao = False;
        }
    }


//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuarios (email, senha, cidade, comentarios) VALUES(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($email, $senha, $cidade, $comentarios));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Adicionar Contato</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Contato </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">


                <div class="control-group <?php !empty($emailErro) ? '$emailErro ' : ''; ?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="email" type="text" placeholder="Email"
                                   value="<?php echo !empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $emailErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="control-group  <?php echo !empty($senhaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Senha</label>
                        <div class="controls">
                            <input size="40" class="form-control" name="senha" type="password" placeholder="senha"
                                   value="<?php echo !empty($senha) ? $senha : ''; ?>">
                            <?php if (!empty($senhaErro)): ?>
                                <span class="text-danger"><?php echo $senhaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="control-group <?php echo !empty($cidadeErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Cidade</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="cidade" type="text" placeholder="cidade"
                                   value="<?php echo !empty($cidade) ? $cidade : ''; ?>">
                            <?php if (!empty($cidadeErro)): ?>
                                <span class="text-danger"><?php echo $cidadeErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="control-group <?php echo !empty($comentariosErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Comentários</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="comentarios" type="text" placeholder="comentarios"
                                   value="<?php echo !empty($comentarios) ? $comentarios : ''; ?>">
                            <?php if (!empty($comentariosErro)): ?>
                                <span class="text-danger"><?php echo $comentariosErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
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
