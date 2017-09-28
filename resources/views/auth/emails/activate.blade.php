<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>IPCO - Instituto Plinio Correa de Oliveira</title>
  <meta name="description" content="IPCO - Instituto Plinio Correa de Oliveira">
</head>

<body style="background-color:#f6f6f6; font-family: Segoe UI, Arial;">
  
	<div style="width: 550px; margin-top:20px; background-color: #fff; margin:auto;">
		<div style="background-color:#081832; border-bottom:3px solid #d19429; color:#fff; font-size:9px; padding:20px; text-align: center;">
			<h1 style="color:#d19429;">Instituto Plínio Corrêa de Oliveira</h1>
		</div>

		<div style="padding:20px;">
			<h1>Ative sua conta</h1>
			
			<p>Olá <strong>{{ $name }}</strong>,</p>

			<p>Obrigado por se inscrever na IPCO.org.br</p>	

			<p>Para completar seu registro, você deve clicar no próximo link de confirmação:</p>

			<a href="{{ $activateLink }}">{{ $activateLink }}</a>

			<p>Se depois de clicar no link parece estar quebrado, copie e cole-o em uma nova janela do navegador.</p>

			<p>Se você precisa nos contatar, pode fazê-lo através deste endereço de e-mail: <a href="mailto:contato@ipco.org.br">contato@ipco.org.br</a></p>

			<p>Saudações</p>

			<p>IPCO.org.br</p>

			<p>Instituto Plinio Correa de Oliveira</p>
		</div>		
		<div style="background-color:#081832; border-top:1px solid #d19429; color:#fff; font-size:9px; padding:20px; text-align: center;">
			Instituto Plinio Correa de Oliveira<br>
			<?php echo date('Y'); ?>
		</div>
	</div>

</body>
</html>