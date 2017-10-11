
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>IPCO - Instituto Plinio Correa de Oliveira</title>
  <meta name="description" content="IPCO - Instituto Plinio Correa de Oliveira">	
</head>
<body style="background-color:#f6f6f6; font-family: Segoe UI, Arial;">

	<div style="width: 550px; margin-top:20px; background-color: #fff; margin:auto;">
		<div style="background-color:#081832; border-bottom:3px solid #d19429; color:#fff; font-size:9px; text-align: center;">
			<img src="<?php echo $message->embed('https://campanhas.ipco.org.br/assets/img/header-mail-ipco.jpg'); ?>" style="width: 100%;">
		</div>
		<div style="padding:20px;">
			<p>Parece que você teve algum problema com sua senha.</p>
			<p>Abaixo o link para cadastrar uma nova.</p>
			<p><a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
			<p>Se depois de clicar no link algo der errado, simplesmente copie e cole-o em uma nova janela do navegador.</p>
			<p>Se ainda assim você encontrar algum problema, por favor, escreva-nos através deste endereço de e-mail: contato@ipco.org.br</p>
			<p>Cordialmente,</p>
			<p>Allysson Vidal</p>
			<p>Ação Jovem IPCO</p>
		</div>		
		<div style="background-color:#081832; border-top:1px solid #d19429; color:#fff; font-size:9px; padding:20px; text-align: center;">
			Instituto Plinio Correa de Oliveira<br>
			<?php echo date('Y'); ?>
		</div>
	</div>		

</body>
</html>
