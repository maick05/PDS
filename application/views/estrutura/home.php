<link rel="stylesheet" type="text/css" href="../../pds/semantic/dist/semantic.css">      <!-- Estilo Semantic -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">  <!-- Estilo CSS -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <!-- Tag para compatibilidade com navegadores -->             
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">   <!-- Tag para deixar site responsivo -->
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>   <!-- JQuery Semantic -->
  <script src="../../pds/semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/valida_home.js'); ?>"></script>   <!-- Valida Formulários -->
<head>
</head>

<body>
<script>

 $(document).ready(function(){
    $('.ui.modal').modal('show');
});
</script>

<style type="text/css">
</style>

  <div class="ui modal">   
    <div class="header">
      Complete seu cadastro
    </div>
    <div class="image content">
      <div class="ui medium image">
        <img src="https://semantic-ui.com/images/avatar2/large/rachel.png">
      </div>
      <div style="width: 100%" class="description">
        <form class="ui form">
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
              <select class="ui fluid dropdown">
                <option value="">Estado</option>
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
              </select>
            </div>
            <div class="field">
              <label>Cidade</label>
              <div class="ui fluid search selection dropdown">
                <input type="hidden" name="country">
                <i class="dropdown icon"></i>
                <div class="default text">Selecione o estado</div>
                <div class="menu">
            <div class="item" data-value="eh"><i class="eh flag"></i>Western Sahara</div>
            <div class="item" data-value="ye"><i class="ye flag"></i>Yemen</div>
            <div class="item" data-value="zm"><i class="zm flag"></i>Zambia</div>
            <div class="item" data-value="zw"><i class="zw flag"></i>Zimbabwe</div>
          </div>
               </div>
            </div>
          </div>
          <div class="field">
            <div class="label_home_desk">
              <div class="">
                <label style="font-weight: bold; font-size: 0.92857143em;">Data de Nascimento</label>
              </div>
            </div>
            <div class="fields">
              <div id="date_home" style="" class="ui left icon input campo_home home_right">
                <input type="date" placeholder="Telefone">
                <i class="calendar icon"></i>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="actions">
      <div class="ui blue deny button">
        Ignorar
      </div>
      <div class="ui positive right labeled icon button">
        Concluir
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>
</body>