<?php
    require "./libs/PHPMailer/Exception.php";
    require "./libs/PHPMailer/OAuth.php";
    require "./libs/PHPMailer/PHPMailer.php";
    require "./libs/PHPMailer/POP3.php";
    require "./libs/PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem{
        private $nome = null;
        private $destino = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = array('codigo_status' => null, 'descricao_status' => null);

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function mensagemValida(){
            if(empty($this->nome) || empty($this->destino) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }
            return true;
        }
    }

    $mensagem = new Mensagem();

    $mensagem->__set('nome', $_POST['nome']);
    $mensagem->__set('destino', $_POST['destino']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if (!$mensagem->mensagemValida()){
        header('Location: index.php?mail=erro');
    }

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = false;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = ''; //your gmail
        $mail->Password   = ''; //your password app google
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('', ''); // (your gmail, your name)
        $mail->addAddress($mensagem->__get('destino'), $mensagem->__get('nome'));

        $mail->isHTML(true);
        $mail->Subject = $mensagem->__get('assunto');
        $mail->Body    = $mensagem->__get('mensagem');
        $mail->AltBody = 'É necessário utilizar um client que suporte HHTML para ter acesso total ao conteúdo dessa mensagem!';

        $mail->send();

        $mensagem->status['codigo_status'] = 1;
        $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso!';


    } catch (Exception $e) {
        $mensagem->status['codigo_status'] = 2;
        $mensagem->status['descricao_status'] = 'Não foi possível enviar esse email, tente novamente mais tarde!<br />Detalhes do erro: <span class="text-danger">' . $mail->ErrorInfo . '</span>';
    }
?>

<html>
    <head>
        <meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    
    <body class="vh-100">
        <div class="container">
            <div class="row align-items-center h-100">

                <div class="col-md-6">
                    <div class="text-center">
                        <img class="d-block mx-auto" src="imagens/logo.png" alt="" width="72" height="72">
                        <h2>Send Mail</h2>
                        <p class="lead">Seu app de envio de e-mails particular!</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <?php
                        if($mensagem->status['codigo_status'] == 1){
                    ?>

                        <div class="text-center">
                            <h1 class="display-4 text-success">Sucesso</h1>
                            <p><?= $mensagem->status['descricao_status'] ?></p>
                            <a href="index.php" class="btn btn-success btn-lg mt-5  text-white">Voltar</a>
                        </div>

                    <?php } ?>
                    <?php
                        if($mensagem->status['codigo_status'] == 2){
                    ?>
                            
                        <div class="text-center">
                            <h1 class="display-4 text-danger">Ops!</h1>
                            <p><?= $mensagem->status['descricao_status'] ?></p>
                            <a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
                        </div>

                    <?php } ?>
                </div>

            </div>
        </div>

    </body>
</html>
