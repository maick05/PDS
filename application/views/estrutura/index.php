<link rel="stylesheet" type="text/css" href="<?php echo base_url('semantic/dist/semantic.css');?>">      <!-- Estilo Semantic -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">  <!-- Estilo CSS -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <!-- Tag para compatibilidade com navegadores -->             
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">   <!-- Tag para deixar site responsivo -->
<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js');?>"></script>   <!-- JQuery Semantic -->
<script src="semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
<script type="text/javascript" src="<?php echo base_url('assets/js/valida_home.js'); ?>"></script>   <!-- Valida Formulários -->
<script type="text/javascript" src="<?php echo base_url('assets/js/validacoes.js'); ?>"></script>   <!-- Valida Formulários -->
<head>
  <meta charset='utf-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
</head>
<body>
  <div style="" class="ui massive secondary pointing menu" id="menu_fixo">
    <a style="" class="item" id="item_fixed">
      <button id="btn_menu_abrir" class="menu-abrir"></button>
    </a>
    <a style="" class="item" id="item_fixed">
      MyTour
    </a>
    <div class="right menu">
      <div id="img_menu" class="" style="margin: auto; margin-right: ">
        <a href="<?php echo site_url('meu_perfil');?>"><img style="width: 35px;" class="ui avatar image" 
          src="<?php 
          if(isset($usuario_logado['url_foto']) && file_exists($usuario_logado['url_foto']))
          {
            echo base_url($usuario_logado['url_foto']);
          }
          else
          {
            echo base_url('assets/img/usuarios/user.jpg');
          }
          ?>
          "></a>
        </div>
        <a style="" class="ui item active" id="item_fixed" href="<?php echo site_url('meu_perfil');?>">
          Meu Perfil
        </a>    
        <a style="" class="ui item" id="item_fixed" href="<?php echo site_url('logout');?>">
          Sair
        </a>
      </div>
    </div>

    <div style="" class="ui inverted vertical pointing menu" id="menu_lateral">
      <a class="item" href="<?php echo site_url('home');?>">
        <i style="" class="home icon" id="icon_index"></i>
        Página Inicial
      </a>
      <a class="item" href="<?php echo site_url('buscar_excursoes');?>">
        <i style="" class="search icon" id="icon_index"></i>
        Buscar Excursões  
      </a>
      <a class="item" href="<?php echo site_url('minhas_excursoes');?>">
        <i style="" class="bus icon" id="icon_index"></i>
        Minhas Excursões
      </a>
      <a class="item" href="<?php echo site_url('add_excursao');?>">
        <i style="" class="add icon" id="icon_index"></i>
        Criar Excursão
      </a>
      <a class="item">
        <i style="" class="info icon" id="icon_index"></i>
        Sobre
      </a>
      <a class="item">
        <i style="" class="phone icon" id="icon_index"></i>
        Contato
      </a>
      <span class="item">
      </span>
    </div>
    <content>
      <div id="divs">


      </body>
      </html>