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

			<p>Caro <strong>{{ $nome }}</strong>,</p>

			<p>Meu muito obrigado por ter assinado a petição:<br> <strong><a href="{{ $link }}">{{ $titulo }}</a></strong></p>

			<p>Cada pessoa conta nessa batalha espiritual. Então, estou escrevendo para pedir que você compartilhe essa petição com todos os seus amigos que poderiam também participar desse esforço. E, quem sabe, toda sua lista de contatos.</p>

			<p>Simplesmente envie essa mensagem para seus amigos. É simples.</p>

			<p>Estou contando com você porque eu não posso fazer isso sozinho.</p>

			<p>Possa Deus, Nosso Senhor, abençoar e recompensar sua ajuda!</p>

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