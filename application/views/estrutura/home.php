<link rel="stylesheet" type="text/css" href="../../pds/semantic/dist/semantic.css">      <!-- Estilo Semantic -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">  <!-- Estilo CSS -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <!-- Tag para compatibilidade com navegadores -->             
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">   <!-- Tag para deixar site responsivo -->
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>   <!-- JQuery Semantic -->
  <script src="../../pds/semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/valida_home.js'); ?>"></script>   <!-- Valida Formulários -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/validacoes.js'); ?>"></script>   <!-- Valida Formulários -->
<head>
</head>

<body>
<script>
<?php
  if ($cadastro)
  {
?>
    $(document).ready(function(){
      $('#modal_home').modal('show');
    });
<?php
  }
?>
</script>

<style type="text/css">
</style>
  <div id="modal_home" class="ui modal">   
    <div class="header">
      Complete seu cadastro
    </div>
    <div class="image content">
      <div id="div_img_home" class="ui medium image" style="">
        <label style="" id="" for="btn_img_home">
          <img id="label_img_home" src="../../pds/assets/img/usuarios/user_leg.jpg">
        </label>
      </div>
      <div style="" id="desc_home" class="description">
        <form id="form_home" class="ui form" action="<?php echo site_url('salvar_foto'); ?>" enctype="multipart/form-data" method="POST">
          <input name="foto" type="file" accept="image/png, image/jpeg, image/jpg" id="btn_img_home" multiple>
          <div class="field">
            <div class="label_home_desk">
              <div class="label_left">
                <label>Telefone</label>
              </div>
              <div class="label_right">
                <label>Celular</label>
              </div>
            </div>
            <div class="fields">
              <div class="ui left icon input campo_home home_right">
                <input id="telefone" type="text" placeholder="Telefone">
                <i class="phone icon"></i>
              </div>
              <div class="label_home home_top">
                <label class="campo_home">Celular</label>  
              </div>
              <div class="ui left icon input campo_home home_left">
                <input id="celular" type="text" placeholder="Celular">
                <i class="mobile icon"></i>
              </div> 
            </div>
          </div>
          <div class="two fields">
            <div class="field">
              <label>Estado</label>
              <select style="" id="estado_select" class="ui fluid dropdown">
                <option value="" selected disabled>Estado</option>
              </select>
            </div>
            <div class="field">
              <label>Cidade</label>
              <select id="cidade_select" class="ui fluid dropdown">
                <option value="" selected disabled>Selecione o estado</option>
              </select>
            </div>
          </div>
          <div class="field">
            <div class="label_home_desk">
              <div class="">
                <label id="data_label" style="">Data de Nascimento</label>
              </div>
            </div>
            <div class="fields">
              <div id="date_home" style="" class="ui left icon input campo_home home_right">
                <input id="input_data" type="date" placeholder="">
                <i class="calendar icon"></i>
              </div>
            </div>
            <center>
              <div style="" id="msg_data" class="ui pointing red basic label">
                    <span id="texto_data">Data inválida</span>
              </div>
            </center>
          </div>
        </form>
      </div>
    </div>
    <div class="actions">
      <div id="btn_ignorar" class="ui blue deny button">
        Ignorar
      </div>
      <div style="" id="btn_concluir" class="ui right denny green labeled icon button">
        Concluir
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>

  <div id="msg_home" class="ui tiny modal">
    <div class="header">Perfil Cadastrado</div>
    <div class="content">
      <p>Seus dados foram cadastrados com sucesso!</p>
    </div>
    <div class="actions">
      <div class="ui positive button">Ok</div>
    </div>
  </div>
</body>