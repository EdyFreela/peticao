<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{{ $title }}</title>
<style>
	h1, h2{
		text-align:center;
	}
	p{
		font-size: 14px;
	}
	.copy{
		font-size:11px;
		text-align: center;
	}
</style>
</head>

<body>

<h1>USEMODA</h1>
<hr>
<h2>Ative sua conta</h2>
<p>Olá <strong>{{ $name }}</strong>,</p>
<p>Obrigado por se inscrever na <strong>USEMODA</strong></p>
<p>Para completar seu registro, você deve clicar no próximo link de confirmação:</p>
<a href="{{ $activateLink }}">{{ $activateLink }}</a>
<p>Se depois de clicar no link parece estar quebrado, copie e cole-o em uma nova janela do navegador.</p>
<p>Estes são os seus dados de acesso para entrar na web:</p>
<p>E-Mail:</p>
<p>Senha:</p>
<p>Se você precisa nos contatar, pode fazê-lo através deste endereço de e-mail: suporte@usemoda.com</p>
<p>Saudações</p>
<p>Usemodas</p>
<hr>
<p class="copy">Se você não deseja receber mais e-mails, modifique suas opções de "Perfil".</p>
<p class="copy">Copyright &copy; <?php echo date('Y'); ?> Usemoda</p>

</body>
</html>