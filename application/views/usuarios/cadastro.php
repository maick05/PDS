<!DOCTYPE html>
<html>
<head>
	<title>MyTour - Cadastro</title>

	<link rel="stylesheet" type="text/css" href="../../pds/semantic/dist/semantic.css">      <!-- Estilo Semantic -->
  	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">  <!-- Estilo CSS -->
	<meta charset="utf-8" />
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <!-- Tag para compatibilidade com navegadores -->             
  	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">   <!-- Tag para deixar site responsivo -->
	<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>" ></script>   		<!-- JQuery Semantic -->
	<script src="../../pds/semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
 	<script src="<?php echo base_url('assets/js/valida_cadastro.js'); ?>"></script>  <!-- Valida Formulários --> 
</head>
<body>
	<div class="ui middle aligned center aligned grid">
	  <div class="column">
	    <form id="form_cadastro" class="ui large form" method="post" action="<?= base_url('cadastrar'); ?>" enctype="multipart/form-data">
	      <div class="ui stacked segment">
          <h2 class="ui teal">
            <div class="content">
              <span class="t1">Crie sua conta</span>
            </div>
          </h2>
          	<div class="field">
	          <div class="ui left icon input">
	            <i class="user icon"></i>
	            <input id="input_nome" type="text" name="usuarios[nome]" placeholder="Nome" required>
	          </div>
	          <div id="msg_nome" class="ui pointing red basic label">
      			<span id="texto_nome"></span>
    		  </div>
	        </div>
	        <div class="field">
	          <div class="ui left icon input">
	            <i class="mail icon"></i>
	            <input id="input_email" type="email" name="usuarios[email]" placeholder="Email" required>
	          </div>
	          <div id="msg_email" class="ui pointing red basic label">
      			<span id="texto_email"></span>
    		  </div>
	        </div>
	        <div class="field">
	          <div class="ui left icon input">
	            <i class="lock icon"></i>
	            <input id="input_senha" type="password" name="usuarios[senha]" placeholder="Senha" required>
	          </div>
	          <div style="" id="msg_senha" class="ui pointing red basic label">
      			<span id="texto_senha"></span>
    		  </div>
	        </div>
	        <a href="#"><div id="btn_cadastrar" class="ui fluid large teal submit button">Cadastrar-se</div></a>
	      </div>
	     </form>
	    <div class="ui message">
	      Já possui uma conta? <a class="l1" href="<?= base_url('login'); ?> ">Faça o Login</a>
	    </div>
	  </div>
	</div>
</body>
</html>
