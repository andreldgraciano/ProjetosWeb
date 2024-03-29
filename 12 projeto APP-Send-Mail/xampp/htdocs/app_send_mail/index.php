<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>

	<body class="vh-100">

		<div class="container">  

			<div class ="row align-items-center h-100">

				<div class="col-md-6">
					<div class="text-center">
						<img class="d-block mx-auto" src="imagens/logo.png" alt="" width="72" height="72">
						<h2>Send Mail</h2>
						<p class="lead">Seu app de envio de e-mails particular!</p>
					</div>
				</div>

				<div class="col-md-6">

					<div class="card-body font-weight-bold">

						<form action="processa_envio.php" method="post">
							<div class="form-group">
								<label for="nome">Nome</label>
								<input name="nome" type="text" class="form-control" id="nome" placeholder="Nome">
							</div>

							<div class="form-group">
								<label for="destino">Destino</label>
								<input name="destino" type="text" class="form-control" id="destino" placeholder="joao@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto</label>
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem</label>
								<textarea name="mensagem" class="form-control" id="mensagem" placeholder="Ensira sua mensagem aqui!"></textarea>
							</div>

							<?php
                            if(isset($_GET['mail']) && $_GET['mail'] == 'erro'){ ?>

                                <div class="text-danger mb-3">
                                    Insira todos os dados!
                                </div>

                            <?php } ?>

							<div class="d-flex justify-content-center">
								<button type="submit" class="btn btn-primary btn-lg ">Enviar Mensagem</button>
							</div>
						</form>

					</div>
				</div>

			</div>

		</div>
	</body>
</html>