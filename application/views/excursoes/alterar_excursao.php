
<script type="text/javascript" src="<?php echo base_url('assets/js/valida_alterar_excursao.js'); ?>"></script>   <!-- Valida Formulários -->
<script type="text/javascript" src="<?php echo base_url('assets/js/cidade_estado.js'); ?>"></script> 
<script type="text/javascript">
  $(document).ready(function()
  {
    <?php
    if(isset($excursao['id_estado_part']))
    {
      ?>      $.post("listar_estados", function(data, status)
      {
        result = $.parseJSON(data);
        result.forEach(function(e, i){
          $('#estado_select').append('<option value="'+ e.id_estado + '">'+ e.nome + '</option>')
        })
        $("#estado_select").val("<?php echo $excursao['id_estado_part'];;?>");  
      });



      id_estado = <?php echo $excursao['id_estado_part'];?>;
      $.post("cidades_por_estado", {id:id_estado}, function(data, status)
      {
        result = $.parseJSON(data);
        $('#cidade_select').empty( );
        result.forEach(function(e, i){
          $('#cidade_select').append('<option value="'+ e.id_cidade + '">'+ e.nome + '</option>')
        }) 
        $("#cidade_select").val("<?php echo $excursao['id_cidade_part'];?>"); 
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
    $("#tipo_transporte").val("<?php echo $excursao['tipo_transporte'];?>");  
    $("#categ").val("<?php echo $excursao['categoria'];?>");  
  });
</script>
<form  id="form_alterar" class="ui form" style="" method="POST" action="<?php echo site_url('editar_excursao'); ?>" enctype="multipart/form-data"> 
  <div>
    <h2 id="" class="ui dividing header">Alterar Excursão</h2>
    <input type="hidden" name="excursao[id_excursao]" value="<?php echo $excursao['id_excursao'];?>">
    <div style="" id="" class="">
      <div class="fields">
        <div class="field" style="width: 66.66%">
          <label>Nome da Excursão*</label>
          <div class="ui left icon input">
            <input autocomplete="off" id="input_nome" type="text" placeholder="Ex: Excursão para o Rio de Janeiro" name="excursao[nome]"
            value="<?php echo $excursao['nome'];?>">
            <i class="info icon"></i>
          </div>
          <div style="" id="msg_nome" class="ui pointing red basic label">
            <span id="texto_nome"></span>
          </div>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Tipo de transporte*</label>
          <select name="excursao[tipo_transporte]" style="" id="tipo_transporte" class="ui fluid dropdown">
            <option value="Carro">Carro</option>
            <option value="Ônibus">Ônibus</option>
            <option value="Van">Van</option>
            <option value="Avião">Avião</option>
            <option value="Barco">Barco</option>
          </select>
        </div>
        <div class="field">
          <label>Categoria*</label>
          <select name="excursao[categoria]" style="" id="categ" class="ui fluid dropdown">
            <option value="Música">Música</option>
            <option value="Esportes">Esportes</option>
            <option value="Turismo">Turismo</option>
            <option value="Tecnologia">Tecnologia</option>
            <option value="Tecnologia">Religião</option>
            <option value="Outros">Outros</option>
          </select>
        </div>
      </div>
      <div class="fields">
        <div class="field" style="width: 66.66%">
          <label>Endereço de partida*</label>
          <div class="ui left icon input">
            <input autocomplete="off" id="input_endereco" type="text" placeholder="Ex: Avenida José Bonifácio" name="excursao[endereco_part]"
            value="<?php
            if (isset($excursao['endereco_part']))
            {
              echo $excursao['endereco_part'];
            }?>">
            <i class="point icon"></i>
          </div>
          <div style="" id="msg_endereco" class="ui pointing red basic label">
            <span id="texto_endereco"></span> 
          </div>
        </div>
      </div>
      <div class="three fields">
        <div class="field">
          <label>Estado*</label>
          <select name="excursao[id_estado_part]" style="" id="estado_select" class="ui fluid dropdown">
            <option value="" selected disabled>Estado</option>
          </select>
          <div style="" id="msg_estado" class="ui pointing red basic label">
            <span id="texto_estado"></span>
          </div>
        </div>

        <div class="field">
          <label>Cidade*</label>
          <select name="excursao[id_cidade_part]" id="cidade_select" class="ui fluid dropdown">
            <option value="" selected disabled>Selecione o estado</option>
          </select>
        </div>
      </div>
      <div class="three fields">
        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Data de Partida*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input name="excursao[data_part]" id="input_data" type="date" placeholder=""
              value="<?php echo $excursao['data_part'];?>">
              <i class="calendar icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_data" class="ui pointing red basic label">
              <span id="texto_data"></span>
            </div>
          </center>
        </div>

        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Horário de partida*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input name="excursao[horario_part]" id="input_horario" type="time" placeholder=""
              value="<?php echo $excursao['horario_part']; ?>">
              <i class="clock icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_horario" class="ui pointing red basic label">
              <span id="texto_horario"></span>
            </div>
          </center>
        </div>
      </div>
      <div class="three fields">
        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Vagas Disponíveis*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input name="excursao[vagas_disp]" id="input_vagas" type="number" placeholder=""
              value="<?php echo $excursao['vagas_disp'];?>">
              <i class="users icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_vagas" class="ui pointing red basic label">
              <span id="texto_vagas"></span>
            </div>
          </center>
        </div>

        <div class="field" id="div_date">
          <div class="label_home_desk">
            <div class="">
              <label id="data_label" style="">Valor*</label>
            </div>
          </div>
          <div class="fields">
            <div id="" style="" class="ui left icon input campo_home">
              <input name="excursao[valor]" id="input_valor" placeholder=""
              value="<?php echo $excursao['valor'];?>" type="number" step="0.01" min="0">
              <i class="money icon"></i>
            </div>
          </div>
          <center>
            <div style="" id="msg_valor" class="ui pointing red basic label">
              <span id="texto_valor"></span>
            </div>
          </center>
        </div>
      </div>

      <div class="three fields">
        <div class="field">
          <label>Telefone para Contato</label>
          <div class="ui left icon input">
            <input autocomplete="off" id="celular" type="text" placeholder="Telefone" name="excursao[contato]"
            value="
            <?php
            if (isset($excursao['contato']))
            {
              echo $excursao['contato'];
            }
            ?>
            ">
            <i class="phone icon"></i>
          </div>
        </div>

        <div class="field">
          <label>Email para Contato</label>
          <div class="ui left icon input">
            <input autocomplete="off" type="text" placeholder="Email" name="excursao[contato_email]"
            id="input_email"  value="<?php
            if (isset($excursao['contato_email']))
            {
              echo $excursao['contato_email'];
            }?>">
              <i class="mail icon"></i>
            </div>
            <div style="" id="msg_email" class="ui pointing red basic label">
              <span id="texto_email"></span>
            </div>
          </div>
        </div>

        <div class="field" style="width: 66.66%">
          <div class="field">
            <label>Observações</label>
            <textarea name="excursao[observacoes]" rows="4"><?php
            if (isset($excursao['observacoes']))
            {
              echo $excursao['observacoes'];
            }?></textarea>
        </div>
      </div>
      <div class="actions" style="">
        <div style="" id="btn_alterar" class="ui green labeled icon large button">
          Salvar Alterações
          <i class="check icon"></i>
        </div>
      </div> 
    </div>
  </form> 
</div>

