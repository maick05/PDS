<!DOCTYPE html>
<html>
<head>
	<title>MyTour - Login</title>

	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.css">      <!-- Estilo Semantic -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">  <!-- Estilo CSS -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <!-- Tag para compatibilidade com navegadores -->             
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">   <!-- Tag para deixar site responsivo -->
	<script  src="assets/js/jquery-3.1.1.min.js"></script>   <!-- JQuery Semantic -->
	<script src="semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
	<script type="text/javascript" src="assets/js/valida_login.js"></script>   <!-- Valida Formulários --> 
	<script type="text/javascript">
		$(document).ready(function()
		{
			<?php
			if (isset($ref)) 
			{
				?>
				$('#modal_ref').modal('show');
				<?php
			}
			?>
		});
	</script>
</head>
<body>
	<div class="ui middle aligned center aligned grid">
		<div class="column">
			<form id="form_login" class="ui large form" method="post" enctype="multpart/data" action="<?= site_url('logar');?>">
				<div class="ui stacked segment">
					<h2 class="ui teal">
						<div class="content">
							<span class="t1"> Faça o Login</span>
						</div>
					</h2>
					<div class="field">
						<div class="ui left icon input">
							<i class="mail icon"></i>
							<input id="input_email" type="text" name="usuarios[email]" placeholder="Email">
						</div>
						<div style="" id="msg_email" class="ui pointing red basic label">
							<span id="texto_email"></span>
						</div>
					</div>
					<div class="field">
						<div class="ui left icon input">
							<i class="lock icon"></i>
							<input id="input_senha" type="password" name="usuarios[senha]" placeholder="Senha">
						</div>
						<div style="" id="msg_senha" class="ui pointing red basic label">
							<span id="texto_senha"></span>
						</div>
					</div>
					<a href="#"><div id="btn_logar" class="ui fluid large teal submit button">Login</div></a>
					<div id="div_esq_senha"><a href="#" style="">Esqueci minha senha</a></div>
				</div>
				<div style="text-align: left;" id="msg_login" class="ui warning message">
					<i style="float: left; margin-top: -1.2%" class="big warning circle icon"></i>
					Email ou senha estão incorretos
				</div>
			</form>
			<div class="ui message">
				Ainda não possui uma conta no MyTour? <a class="l1" href="<?= site_url('cadastro');?>">Cadastre-se</a>
			</div>
		</div>
	</div>
	
	<div class="ui tiny modal" id="modal_rec">
		<div class="header">Recuperar Senha</div>
		<div class="content">
			<p>Informe o seu email que iremos lhe enviar uma solicitação de recuperação de senha:</p>
			<div class="field">
				<div class="ui left icon input" style="width:100%">
					<i class="mail icon"></i>
					<input id="input_email_rec" type="text" name="usuarios[email]" placeholder="Email">
				</div>
				<div style="" id="msg_rec" class="ui pointing red basic label">
					<span id="texto_rec"></span>
				</div>
			</div>
		</div>
		<div class="actions" id="actions_rec" style="">
			<div class="ui cancel button">Cancelar</div>
			<div id="btn_recuperar" class="ui denny green button" style="">Enviar</div>
		</div>
	</div>

	<div class="ui mini modal" id="modal_ref">
		<div class="header">Refefinir Senha</div>
		<div class="content">
			<form  id="form_criar" class="ui form" style="" method="POST" action="<?php echo site_url('criar_excursao'); ?>" enctype="multipart/form-data"> 
				<div class="field">
					<label>Insira sua nova senha:</label>
					<div class="ui left icon input">
						<input autocomplete="off" id="senha1" type="password" placeholder="" name="excursoes[contato]"
						value="">
						<i class="lock icon"></i>
					</div>
					<div style="" id="msg_s1" class="ui pointing red basic label">
						<span id="texto_s1"></span>
					</div>
				</div>
				<input type="hidden" value="<?php
				if(isset($id_u))
				{
					echo $id_u;
				}?>" id="id_u">
				<div class="field">
					<label>Confirme a senha</label>
					<div class="ui left icon input">
						<input autocomplete="off" type="password" placeholder="" name="excursoes[contato_email]"
						id="senha2"  value="">
						<i class="lock icon"></i>
					</div>
					<div style="" id="msg_s2" class="ui pointing red basic label">
						<span id="texto_s2"></span>
					</div>
				</div>
			</form>
		</div>
		<div class="actions" id="actions_rec2" style="">
			<div class="ui cancel button">Cancelar</div>
			<div id="btn_redefinir" class="ui denny green button" style="">Redefinir</div>
		</div>
	</div>

	<div class="ui mini modal" id="modal_msg_senha">
		<div class="header">Atenção</div>
		<div class="content">
			<p>Senha redefinida com sucesso!</p>
		</div>
		<div class="actions" id="" style="">
			<div id="btn_redefinir" class="ui positive button" style="">Ok</div>
		</div>
	</div>

	<div class="ui mini modal" id="modal_msg_email">
		<div class="header">Atenção</div>
		<div class="content">
			<p>Email enviado com sucesso!</p>
		</div>
		<div class="actions" id="" style="">
			<div id="btn_redefinir" class="ui positive button" style="">Ok</div>
		</div>
	</div>
</body>
</html>
