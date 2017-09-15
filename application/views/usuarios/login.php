<!DOCTYPE html>
<html>
<head>
	<title>MyTour - Login</title>

	<link rel="stylesheet" type="text/css" href="../../pds/semantic/dist/semantic.css">      <!-- Estilo Semantic -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">  <!-- Estilo CSS -->
	<meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <!-- Tag para compatibilidade com navegadores -->             
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">   <!-- Tag para deixar site responsivo -->
	<script  src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>   <!-- JQuery Semantic -->
	<script src="../../pds/semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/valida_login.js'); ?>"></script>   <!-- Valida Formulários --> 
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
</body>
</html>
