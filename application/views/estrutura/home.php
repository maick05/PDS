<link rel="stylesheet" type="text/css" href="../../pds/semantic/dist/semantic.css">      <!-- Estilo Semantic -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>">  <!-- Estilo CSS -->
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <!-- Tag para compatibilidade com navegadores -->             
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">   <!-- Tag para deixar site responsivo -->
<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>   <!-- JQuery Semantic -->
<script src="../../pds/semantic/dist/semantic.min.js"></script> <!-- JavaScript Semantic -->
<script type="text/javascript" src="<?php echo base_url('assets/js/valida_home.js'); ?>"></script>   <!-- Valida Formulários -->
<script type="text/javascript" src="<?php echo base_url('assets/js/validacoes.js'); ?>"></script>   <!-- Valida Formulários -->
<script type="text/javascript" src="<?php echo base_url('assets/js/cidade_estado.js'); ?>"></script>  
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

  <div class="ui segment">
    <h2 class="ui left floated header">Excursões atuais</h2>
    <div class="ui clearing divider"></div>
    <?php 
    if (isset($sem_ep))
    {
      ?>
      <div class="ui icon message">
        <i class="Info Circle icon"></i>
        <div class="content">
          <div class="header">
            Não há excursões
          </div>
          <p>Não excursões no momento, caso queira adicionar uma nova excursão <a style="text-decoration: underline;" href="<?php echo site_url('add_excursao');?>"> clique aqui.</a></p>   
        </div>
      </div>
      <?php
    } 
    else
    {
      ?>
      <div class="ui four stackable doubling cards">
        <?php
        if (isset($excursoesProx)) 
        {
          foreach ($excursoesProx -> result() as $linha)
          {
            $data = new DateTime($linha->data_part);
            $data = $data -> format("d/m/Y");
            ?>
            <div class="ui card" style="">
              <div class="content">
               <a href="<?php $segments = array('ver_detalhes_excursao', $linha->id_excursao);echo site_url($segments); 
               ?>" class="header" style="font-size: 1.2em" id="titulo"><?= $linha->nome?></a>
             </div>
             <div class="image" id="img_exc" onclick="">
              <img 
              src="<?php 
              if(isset($linha->url_foto) && file_exists($linha->url_foto))
              {
                echo base_url($linha->url_foto);
              }
              else
              {
                echo base_url('assets/img/excursoes/excursao_padrao.png');
              }?>">
              <input type="hidden" id="id_exc" value="<?php echo $linha->id_excursao ?>">
            </div>
            <div class="content" style="margin-top: -0.5em">
              <span style="color: black; font-size: 1em; font-weight: bold;">Saindo: </span>
              <div class="meta">
                <span class="date"><?= $data." - ".$linha->horario_part;?></span>
              </div>
              <div class="description">
                <p id="titulo"><?= $linha->endereco_part;?></p>
                <p><?= $linha->cidade_nome." - ".$linha->sigla;?></p>
              </div>
            </div>
            <div class="extra content" style="margin-top: -0.7em">
              <a>
                <i class="user icon"></i>
                <?= $linha->vagas_disp." vagas";?>
              </a>
              <div class="right floated" style="color: black"><?php echo "R$".$linha->valor?></div>
              <a href="<?php $segments = array('ver_detalhes_excursao', $linha->id_excursao);echo site_url($segments); 
              ?>"><div style="width: 100%; margin-top: 0.7em" id="" class="ui blue labeled icon button">
                Ver mais
                <i class="unhide icon"></i>
              </div></a>
            </div>
          </div>
          <?php
        }
      }
      ?>
    </div>
      <table class="ui celled table">
        <tfoot style="">
          <tr><th colspan="">
            <a href="<?php echo base_url('buscar_excursoes'); ?>"><div style="float: right;" id="" class="ui gray labeled icon tiny button">
              Ver todas as excursões
              <i class="search icon"></i>
            </div></a>
          </th>
        </tr></tfoot>
      </table>
      <?php
    }
    ?>

  </div>

  <div class="ui segment">
    <h2 class="ui left floated header">Minhas Excursões</h2>
    <div class="ui clearing divider"></div>
    <?php 
    if (isset($sem_me))
    {
      ?>
      <div class="ui icon message">
        <i class="Info Circle icon"></i>
        <div class="content">
          <div class="header">
            Não há excursões
          </div>
          <p>Você ainda não criou nenhuma excursão, caso queira adicionar uma nova excursão <a style="text-decoration: underline;" href="<?php echo site_url('add_excursao');?>"> clique aqui.</a></p>   
        </div>
      </div>
      <?php
    } 
    else
    {
      ?>
      <div class="ui four stackable doubling cards">
        <?php
        if (isset($minhasExcursoes)) 
        {
          foreach ($minhasExcursoes -> result() as $linha)
          {
            $data = new DateTime($linha->data_part);
            $data = $data -> format("d/m/Y");
            ?>
            <div class="ui card" style="">
              <div class="content">
               <a href="<?php $segments = array('ver_detalhes_excursao', $linha->id_exc);echo site_url($segments); 
               ?>" class="header" style="font-size: 1.2em" id="titulo"><?= $linha->nome?></a>
             </div>
             <div class="image" id="img_exc" onclick="">
              <img 
              src="<?php 
              if(isset($linha->url_foto) && file_exists($linha->url_foto))
              {
                echo base_url($linha->url_foto);
              }
              else
              {
                echo base_url('assets/img/excursoes/excursao_padrao.png');
              }?>">
              <input type="hidden" id="id_exc" value="<?php echo $linha->id_exc ?>">
            </div>
            <div class="content" style="margin-top: -0.5em">
              <span style="color: black; font-size: 1em; font-weight: bold;">Saindo: </span>
              <div class="meta">
                <span class="date"><?= $data." - ".$linha->horario_part;?></span>
              </div>
              <div class="description">
                <p id="titulo"><?= $linha->endereco_part;?></p>
                <p><?= $linha->cidade_nome." - ".$linha->sigla;?></p>
              </div>
            </div>
            <div class="extra content" style="margin-top: -0.7em">
              <a>
                <i class="user icon"></i>
                <?= $linha->vagas_disp." vagas";?>
              </a>
              <div class="right floated" style="color: black"><?php echo "R$".$linha->valor?></div>
              <a href="<?php $segments = array('ver_detalhes_excursao', $linha->id_exc);echo site_url($segments); 
              ?>"><div style="width: 100%; margin-top: 0.7em" id="" class="ui blue labeled icon button">
                Ver mais
                <i class="unhide icon"></i>
              </div></a>
            </div>
          </div>
        <?php
      }
    }
    ?>
    </div>
    <table class="ui celled table">
      <tfoot style="">
        <tr><th colspan="">
          <a href="<?php echo base_url('minhas_excursoes');?>"><div style="float: right;" id="" class="ui gray labeled icon tiny button">
            Ver minhas excursões
            <i class="bus icon"></i>
          </div></a>
        </th>
      </tr></tfoot>
    </table>

<?php
}
?>
</div>



<style type="text/css">
</style>
<div id="modal_home" class="ui modal">   
  <div class="header">
    Complete seu cadastro
  </div>
  <div class="image content">
    <div id="div_img_home" class="ui medium image" style="">
        <img id="label_img_home" src="../../pds/assets/img/usuarios/user.jpg">
      <label style="" id="" for="btn_img_home">
         <div id="" class="ui right gray labeled icon submit button" style="width: 100%; margin-top: 0.2em">
        Selecionar Foto
        <i class="photo icon"></i>
      </div>   
      </label>
    </div>
    <div style="" id="desc_home" class="description">
      <form id="form_home" class="ui form" action="<?php echo site_url('concluir_cadastro'); ?>" enctype="multipart/form-data" method="POST">
        <input name="url_foto" type="file" accept="image/png, image/jpeg, image/jpg" id="btn_img_home" multiple>
        <!-- <input type="hidden" name="usuarios[id_usuario]" value="<?php echo $usuario_logado['id_usuario'];?>"> -->
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
              <input id="telefone" type="text" placeholder="Telefone" name="usuarios[telefone]">
              <i class="phone icon"></i>
            </div>
            <div class="label_home home_top">
              <label class="campo_home">Celular</label>  
            </div>
            <div class="ui left icon input campo_home home_left">
              <input id="celular" type="text" placeholder="Celular" name="usuarios[celular]">
              <i class="mobile icon"></i>
            </div> 
          </div>
        </div>
        <div class="two fields">
          <div class="field">
            <label>Estado</label>
            <select style="" id="estado_select" class="ui fluid dropdown" name="usuarios[id_estado]">
              <option value="" selected>Estado</option>
            </select>
          </div>
          <div class="field">
            <label>Cidade</label>
            <select id="cidade_select" class="ui fluid dropdown" name="usuarios[id_cidade]">
              <option value="" selected>Selecione o estado</option>
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
              <input id="input_data" type="date" placeholder="" name="usuarios[data_nasc]">
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