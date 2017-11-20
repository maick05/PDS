<script type="text/javascript" src="<?php echo base_url('assets/js/valida_perfil.js'); ?>"></script>
<script type="text/javascript">
  $(document).ready(function()
  {
    <?php
    if(isset($usuario_logado['id_estado']))
    {
      ?>      $.post("listar_estados", function(data, status)
      {
        result = $.parseJSON(data);
        result.forEach(function(e, i){
          $('#estado_select').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
        })
        $("#estado_select").val("<?php echo $usuario_logado['id_estado'];?>");  
      });

      

      id_estado = <?php echo $usuario_logado['id_estado'];?>;
      $.post("cidades_por_estado", {id:id_estado}, function(data, status)
      {
        result = $.parseJSON(data);
        $('#cidade_select').empty( );
        result.forEach(function(e, i){
          $('#cidade_select').append('<option value="'+ e.id_cidade + '">'+ e.nome + '</option>')
        }) 
        $("#cidade_select").val("<?php echo $usuario_logado['id_cidade'];?>"); 
      });
      <?php
    }
    else
    {
      ?>
      $.post("listar_estados", function(data, status)
      {
        result = $.parseJSON(data);
        result.forEach(function(e, i){
          $('#estado_select').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
        }) 
      });
      <?php
    }
    ?>    
  });
</script>
<form  id="form_alterar" class="ui form" style="" method="POST" action="<?php echo site_url('alterar_perfil'); ?>" enctype="multipart/form-data"> 
  <div id="div_cont">
    <h2 id="header_perfil" class="ui dividing header" style="">Meu Perfil</h2>
    <div class="image content" id="img_perfil" style="">
      <div id="div_img_home" class="ui massive image" style="float:">
        <label style="" id="">
          <img id="label_img_home" 
          src="<?php 
          if(isset($usuario_logado['url_foto']) && file_exists($usuario_logado['url_foto']))
          {
            echo $usuario_logado['url_foto'];
          }
          else
          {
            echo "assets/img/usuarios/user_leg.jpg";
          }
          ?>">
        </label>
        <label id="" for="btn_img_home">
          <div id="" class="ui right gray labeled icon submit button" style="width: 100%; margin-top: 0.4em">
        Alterar Foto
        <i class="photo icon"></i>
      </div>   
        </label>
        <input name="url_foto" type="file" accept="image/png, image/jpeg, image/jpg" id="btn_img_home">
      </div>
    </div>
    <div style="" id="desc_perfil" class="description">
      <input type="hidden" name="usuarios[id_usuario]" value="<?php echo $usuario_logado['id_usuario'];?>">
      <div class="two fields">
        <div class="field">
          <label>Nome</label>
          <div class="ui left icon input">
            <input autocomplete="off" id="input_nome" type="text" placeholder="Nome" name="usuarios[nome]"
            value="<?php echo $usuario_logado['nome'];?>">
            <i class="user icon"></i>
          </div>
          <div style="" id="msg_nome" class="ui pointing red basic label">
            <span id="texto_nome"></span>
          </div>
        </div>

        <div class="field">
          <label>Email</label>
          <div class="ui left icon input">
            <input autocomplete="off" name="" id="input_email" type="email" placeholder="Email"
            value="<?php echo $usuario_logado['email'];?>" disabled>
            <i class="mail icon"></i>
          </div>
          <div style="" id="msg_email" class="ui pointing red basic label">
            <span id="texto_email"></span>
          </div>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Telefone</label>
          <div class="ui left icon input">
            <input name="usuarios[telefone]" id="telefone" type="text" placeholder="Telefone"
            value="<?php 
            if(isset($usuario_logado['telefone']))
            {
              echo $usuario_logado['telefone'];
            }
            ?>
            ">
            <i class="phone icon"></i>
          </div>
        </div>
        <div class="field">
          <label>Celular</label>
          <div class="ui left icon input">
            <input name="usuarios[celular]" id="celular" type="text" placeholder="Celular"
            value="<?php 
            if(isset($usuario_logado['celular']))
            {
              echo $usuario_logado['celular'];
            }
            ?>
            ">
            <i class="mobile icon"></i>
          </div>
        </div>
      </div>
      <div class="two fields">
        <div class="field">
          <label>Estado</label>
          <select name="usuarios[id_estado]" style="" id="estado_select" class="ui fluid dropdown">
            <option value="" selected>Estado</option>
          </select>
        </div>
        <div class="field">
          <label>Cidade</label>
          <select name="usuarios[id_cidade]" id="cidade_select" class="ui fluid dropdown">
            <option value="" selected>Selecione o estado</option>
          </select>
        </div>
      </div>
      <div class="two fields">
       <div class="field" id="div_date">
        <div class="label_home_desk">
          <div class="">
            <label id="data_label" style="">Data de Nascimento</label>
          </div>
        </div>
        <div class="fields">
          <div id="" style="" class="ui left icon input campo_home">
            <input name="usuarios[data_nasc]" id="input_data" type="date" placeholder=""
            value="<?php 
            if(isset($usuario_logado['data_nasc']))
            {
              echo $usuario_logado['data_nasc'];
            }?>">
            <i class="calendar icon"></i>
          </div>
        </div>
        <center>
          <div style="" id="msg_data" class="ui pointing red basic label">
            <span id="texto_data">Data inválida</span>
          </div>
        </center>
      </div> 
    </div>
    <div class="actions" style="">
      <div style="" id="btn_alterar_perfil" class="ui right orange labeled icon submit button">
        Salvar Alterações
        <i class="edit icon"></i>
      </div>              <div style="" id="btn_rec_senha_perfil" class="ui right blue labeled icon button">
        Recuperar Senha
        <i class="lock icon"></i>
      </div>
    </div> 
    <?php 
    if(isset($msg))
    {
      ?>
      <div style="display: block;" class="ui <?php echo $tipo; ?> success message">
        <div class="header">
         <?php echo $msg; ?>
       </div>
       <p></p>
     </div>
     <?php
   }
   ?>
 </div>
</form>
<div class="ui tiny modal" id="modal_rec">
    <div class="header">Recuperar Senha</div>
    <div class="content">
      <p>Para redefinir sua senha iremos enviar um link para seu email:</p>
      <div class="field">
        <div class="ui left icon input" style="width:100%">
          <i class="mail icon"></i>
          <input id="input_email_rec" type="text" value="<?php echo $usuario_logado['email'];?>" disabled>
        </div>
      </div>
    </div>
    <div class="actions" id="actions_rec" style="">
      <div class="ui cancel button">Cancelar</div>
      <div id="btn_recuperar" class="ui denny green button" style="">Enviar</div>
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
</div>